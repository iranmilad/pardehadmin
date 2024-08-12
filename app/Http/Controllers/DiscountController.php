<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Product;
use App\Models\Category;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Traits\AuthorizeAccess;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_discounts';
    }

    // نمایش لیست کدهای تخفیف
    public function index(Request $request)
    {
        // ساختن کوئری برای DiscountCode
        $query = DiscountCode::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // دریافت پارامترهای جستجو
        $search = $request->get('s', '');

        // فیلتر کردن بر اساس جستجو
        if (!empty($search)) {
            $query->where('code', 'like', '%' . $search . '%')
                  ->orWhere('discount_amount', 'like', '%' . $search . '%')
                  ->orWhere('usage_type', 'like', '%' . $search . '%');
        }

        // صفحه‌بندی نتایج
        $discounts = $query->paginate(10);

        return view('discounts', compact('discounts', 'search'));
    }

    // نمایش فرم ایجاد کد تخفیف جدید
    public function create()
    {
        return view('discount');
    }

    /**
     * ذخیره داده‌های ورودی از فرم ایجاد تخفیف جدید
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // اعتبارسنجی و اعتباردهی داده‌های ورودی
        $request->validate([
            'title' => 'required|string|max:255|unique:discount_codes,title',
            'code' => 'required|string|max:255|unique:discount_codes,code',
            'discount_type' => 'required|string|in:percentage_cart,percentage_product,fixed_cart,fixed_product',
            'usage_type' => 'required|string|in:single,multiple',
            'discount_amount' => 'required|numeric',
            'status' => 'required|string|in:active,deactivate',
            'discount_expire_start' => 'nullable|date',
            'discount_expire_end' => 'nullable|date|after_or_equal:discount_expire_start',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric',
            'usage_limit' => 'nullable|integer',
            'usage_limit_per_user' => 'nullable|integer',
            // دیگر قوانین اعتبارسنجی بر اساس نیاز شما
        ]);

        // ایجاد نمونه جدید از مدل تخفیف و ذخیره داده‌ها
        $discount = new DiscountCode();
        $discount->title = $request->title;
        $discount->code = $request->code;
        $discount->discount_type = $request->discount_type;
        $discount->usage_type = $request->usage_type;

        $discount->discount_amount = $request->discount_amount;
        $discount->status = $request->status;
        $discount->discount_expire_start = Jalalian::fromFormat('Y-m-d',$request->discount_expire_start)->toCarbon();
        $discount->discount_expire_end =Jalalian::fromFormat('Y-m-d', $request->discount_expire_end)->toCarbon();
        $discount->min_amount = $request->min_amount;
        $discount->max_amount = $request->max_amount;
        $discount->except_special_products = $request->has('except_special_products') ?? 0;
        $discount->allowed_products = $request->allowed_products;

        $discount->allowed_users = $request->allowed_users;
        $discount->allowed_groups = $request->allowed_groups;

        $discount->disallowed_products = $request->disallowed_products;
        $discount->allowed_categories = $request->allowed_categories;
        $discount->disallowed_categories = $request->disallowed_categories;
        $discount->usage_limit = $request->usage_limit;
        $discount->usage_limit_per_user = $request->usage_limit_per_user;
        $discount->save();

        // بازگرداندن به صفحه قبلی با پیام موفقیت آمیز
        return redirect()->back()->with('success', 'تخفیف با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $discount = DiscountCode::findOrFail($id);


        $allowedUsers = $discount->allowedUsers()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'text' => "{$user->first_name} {$user->last_name} ({$user->email})",
            ];
        });

        $allowedGroups = $discount->allowedGroups()->get()->map(function ($group) {
            return [
                'id' => $group->id,
                'text' => "{$group->name})",
            ];
        });

        $allowedProducts = $discount->allowedProducts()->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'text' => "{$product->name} ({$product->code})",
            ];
        });



        $allowedCategories = $discount->allowedCategories()->get()->map(function ($category) {
            return [
                'id' => $category->id,
                'text' => "{$category->name} ({$category->code})",
            ];
        });




        return view('discount', compact('discount', 'allowedUsers', 'allowedProducts', 'allowedCategories','allowedGroups'));
    }




    // متد به روز رسانی تخفیف
    public function update(Request $request, $id)
    {

        $request->validate([
            'code' => 'required|string|unique:discount_codes,code,'.$id,
            'title' => 'required|string|max:255',
            'discount_type' => 'required|string',
            'usage_type' => 'required|string',
            'discount_amount' => 'required|numeric',
            'discount_expire_start' => 'nullable|date',
            'discount_expire_end' => 'nullable|date',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric',
            'except_special_products' => 'nullable|boolean',
            'status' => 'required|string',
            'usage_limit' => 'nullable|numeric',
            'usage_limit_per_user' => 'nullable|numeric',
            'allowed_products' => 'nullable|array',
            'allowed_categories' => 'nullable|array',
            'allowed_users' => 'nullable|array',
            'allowed_groups' => 'nullable|array',
        ]);

        // استخراج اطلاعات تخفیف
        $discountData = [
            'code' => $request->code,
            'title' => $request->title,
            'discount_type' => $request->discount_type,
            'usage_type' => $request->usage_type,
            'discount_amount' => $request->discount_amount,
            'discount_expire_start' => Jalalian::fromFormat('Y-m-d', $request->discount_expire_start)->toCarbon(),
            'discount_expire_end' => Jalalian::fromFormat('Y-m-d', $request->discount_expire_end)->toCarbon(),
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
            'except_special_products' => $request->has('except_special_products') ? 1 : 0,
            'status' => $request->status,
            'usage_limit' => $request->usage_limit,
            'usage_limit_per_user' => $request->usage_limit_per_user,
        ];

        // یافتن تخفیف براساس شناسه
        $discount = DiscountCode::findOrFail($id);

        // به روز رسانی اطلاعات تخفیف
        $discount->update($discountData);

        // به‌روزرسانی محصولات مجاز
        if ($request->has('allowed_products')) {
            $allowedProductsIds = $request->allowed_products;

            // Sync allowed products
            $discount->allowedProducts()->sync($allowedProductsIds);
        } else {
            // No allowed products selected, sync with an empty array to remove existing relationships
            $discount->allowedProducts()->sync([]);
        }

        // به‌روزرسانی دسته‌های مجاز
        if ($request->has('allowed_categories')) {
            $allowedCategoriesIds = $request->allowed_categories;

            // Sync allowed categories
            $discount->allowedCategories()->sync($allowedCategoriesIds);
        }
        else {
            // No allowed categories selected, sync with an empty array to remove existing relationships
            $discount->allowedCategories()->sync([]);
        }

        // ذخیره کاربران مجاز
        if ($request->has('allowed_users')) {
            $allowedUserIds = $request->allowed_users;

            foreach ($allowedUserIds as $userId) {
                // بررسی وجود کاربر
                $user = User::findOrFail($userId);

                // بررسی وجود رابطه بین کاربر و کد تخفیف
                $exists = DB::table('user_discount_code')
                    ->where('user_id', $userId)
                    ->where('discount_code_id', $discount->id)
                    ->exists();

                // اضافه کردن رابطه فقط اگر وجود نداشته باشد
                if (!$exists) {
                    DB::table('user_discount_code')->insert([
                        'user_id' => $userId,
                        'discount_code_id' => $discount->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        if ($request->has('allowed_groups')) {
            $allowedGroupIds = $request->allowed_groups;

            foreach ($allowedGroupIds as $groupId) {
                // بررسی وجود گروه
                $group = Group::findOrFail($groupId);

                // بررسی وجود رابطه بین گروه و کد تخفیف
                $exists = DB::table('discount_group')
                    ->where('group_id', $groupId)
                    ->where('discount_code_id', $discount->id)
                    ->exists();

                // اضافه کردن رابطه فقط اگر وجود نداشته باشد
                if (!$exists) {
                    DB::table('discount_group')->insert([
                        'group_id' => $groupId,
                        'discount_code_id' => $discount->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('discounts.index')->with('success', 'تخفیف با موفقیت به‌روزرسانی شد.');
    }

    // حذف کد تخفیف
    public function delete(Request $request)
    {
        $discount = DiscountCode::findOrFail($request->id);
        $discount->delete();

        return redirect()->route('discounts.index')->with('success', 'کد تخفیف با موفقیت حذف شد');
    }

    // متد عملیات گروهی
    public function bulk_action(Request $request)
    {
        $action = $request->input('bulk_action');
        $ids = $request->input('checked_row');

        if (empty($ids)) {
            return redirect()->route('discounts.index')->with('error', 'هیچ تخفیفی انتخاب نشده است.');
        }

        switch ($action) {
            case 'delete':
                DiscountCode::whereIn('id', $ids)->delete();
                return redirect()->route('discounts.index')->with('success', 'تخفیف‌های انتخاب شده با موفقیت حذف شدند.');
            default:
                return redirect()->route('discounts.index')->with('error', 'عملیات نامعتبر است.');
        }
    }
}
