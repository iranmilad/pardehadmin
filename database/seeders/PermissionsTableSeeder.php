<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // حذف داده‌های قبلی از جدول رابطه‌ای
        DB::table('role_permission')->delete();

        // حذف داده‌های قبلی از جدول مجوزها
        DB::table('permissions')->delete();

        // تعریف مجوزها
        $permissions = [
            ['title' => 'مدیریت نشانه‌های تصویر', 'name' => 'manage_image_markers'],
            ['title' => 'مدیریت زمان کار', 'name' => 'manage_worktimes'],
            ['title' => 'مدیریت فایل‌ها', 'name' => 'manage_files'],
            ['title' => 'مدیریت اسناد تسویه', 'name' => 'manage_settlement_documents'],
            ['title' => 'مدیریت گروه‌ها', 'name' => 'manage_groups'],
            ['title' => 'مدیریت گروه‌های امتیازی', 'name' => 'manage_score_groups'],
            ['title' => 'مدیریت پیامک‌ها', 'name' => 'manage_sms'],
            ['title' => 'مدیریت بازدیدهای صفحه', 'name' => 'manage_page_views'],
            ['title' => 'مدیریت منوها', 'name' => 'manage_menus'],
            ['title' => 'مدیریت بلوک‌ها', 'name' => 'manage_blocks'],
            ['title' => 'مدیریت حمل و نقل', 'name' => 'manage_transports'],
            ['title' => 'مدیریت جلسات', 'name' => 'manage_sessions'],
            ['title' => 'مدیریت چک‌ها', 'name' => 'manage_checks'],
            ['title' => 'مدیریت تخفیف‌ها', 'name' => 'manage_discounts'],
            ['title' => 'مدیریت درگاه‌ها', 'name' => 'manage_gateways'],
            ['title' => 'مدیریت سبدهای خرید', 'name' => 'manage_carts'],
            ['title' => 'مدیریت کاربران', 'name' => 'manage_users'],
            ['title' => 'مدیریت نقش‌ها', 'name' => 'manage_roles'],
            ['title' => 'مدیریت پست‌ها', 'name' => 'manage_posts'],
            ['title' => 'مدیریت دسته‌بندی‌های پست', 'name' => 'manage_categories'],
            ['title' => 'مدیریت سفارشات', 'name' => 'manage_orders'],
            ['title' => 'مدیریت برچسب‌ها', 'name' => 'manage_tags'],
            ['title' => 'مدیریت نظرات', 'name' => 'manage_comments'],
            ['title' => 'مدیریت صفحات', 'name' => 'manage_pages'],
            ['title' => 'مدیریت دسته‌بندی‌های محصولات', 'name' => 'manage_product_categories'],
            ['title' => 'مدیریت برچسب‌های محصولات', 'name' => 'manage_product_tags'],
            ['title' => 'مدیریت نظرات محصولات', 'name' => 'manage_reviews'],
            ['title' => 'مدیریت ویژگی‌های محصولات', 'name' => 'manage_attributes'],
            ['title' => 'مدیریت ویژگی‌های محصولات - آیتم‌ها', 'name' => 'manage_attributes_properties'],
            ['title' => 'مدیریت محصولات', 'name' => 'manage_products'],
            ['title' => 'مدیریت اقساط', 'name' => 'manage_installments'],
            ['title' => 'مدیریت اعتبارها', 'name' => 'manage_credits'],
            ['title' => 'مدیریت قطعه کدها', 'name' => 'manage_code_pieces'],
            ['title' => 'مدیریت فرآیندها', 'name' => 'manage_workflows'],
            ['title' => 'مدیریت گزارش فرآیندها', 'name' => 'manage_workflow'],
            ['title' => 'مدیریت سرویس‌های شخص ثالث', 'name' => 'manage_third_party_services'],
            ['title' => 'ویرایش سرویس هلو', 'name' => 'manage_holo_service'],
            ['title' => 'ویرایش سرویس پیامک', 'name' => 'manage_sms_service'],
            ['title' => 'مدیریت گروه‌های مشتریان', 'name' => 'manage_customer_groups'],
            ['title' => 'مدیریت پلن‌های اقساط', 'name' => 'manage_installment_plans'],
            ['title' => 'مدیریت گزارش‌های اقساط', 'name' => 'manage_installment_reports'],
            ['title' => 'مدیریت تنظیمات سایت', 'name' => 'manage_settings'],
            ['title' => 'مدیریت اسلایدرها', 'name' => 'manage_sliders'],
        ];

        // درج مجوزها
        DB::table('permissions')->insert($permissions);

        // ایجاد نقش superAdmin
        $role = Role::create([
            'title' => 'superAdmin',
            'display_name' => 'مدیر کل'
        ]);

        // دریافت تمام شناسه‌های مجوزها
        $permissionIds = DB::table('permissions')->pluck('id');

        // تعریف مجوزها برای نقش superAdmin
        $rolePermissions = $permissionIds->map(function($permissionId) use ($role) {
            return [
                'role_id' => $role->id,
                'permission_id' => $permissionId,
                'read_own' => true,
                'read_same_role' => true,
                'read_all' => true,
                'write_own' => true,
                'write_same_role' => true,
                'write_all' => true,
            ];
        })->toArray();

        // درج مجوزها برای نقش superAdmin
        DB::table('role_permission')->insert($rolePermissions);

        // یافتن اولین کاربر
        $firstUser = User::first();

        if ($firstUser) {
            // انتصاب نقش superAdmin به اولین کاربر
            $firstUser->update([
                'role_id' => $role->id
            ]);
        }
    }
}
