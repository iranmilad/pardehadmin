<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Widget;
use App\Models\Category;
use App\Models\BlockWidget;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class MenuController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_menus';
    }

    public function index()
    {
        // ساختن کوئری برای Menu
        $query = Menu::whereNull('menu_id');

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // صفحه‌بندی نتایج
        $menus = $query->paginate(10);

        return view('menus', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::get();

        return view('menuCreate', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|url|max:255', // کنترل اینکه لینک باید یک URL معتبر باشد
            'icon' => 'nullable|string',
            'alias' => 'required|string|max:50|unique:menus,alias',
            'show_title' => 'required|boolean',
            'menu_id' => 'nullable|exists:menus,id',
            'type' => 'required|string|in:menu_category,features_menu,portfolio', // بررسی نوع
        ]);

        // بازیابی ویجت
        $widget = Widget::where('name', 'WidgetMenus')->first();
        if (!$widget) {
            return redirect()->back()->withErrors(['widget' => 'WidgetMenus not found.'])->withInput();
        }

        $widgetId = $widget->id;
        $blockName = "منو " . $validatedData['title']; // تغییر استفاده از title به جای name

        // آماده‌سازی تنظیمات
        $settings = [
            'title' => $validatedData['title'],
            'name' => $blockName,
            'link' => $validatedData['link'],
            'alias' => $validatedData['alias'],
            'type' => $validatedData['type']
        ];

        // اجرای عملیات در تراکنش
        try {
            \DB::transaction(function () use ($widgetId, $blockName, $settings, &$validatedData) {
                $block = BlockWidget::create([
                    'widget_id' => $widgetId,
                    'block' => $blockName,
                    'type' => "simple", // ذخیره نوع صحیح
                    'settings' => $settings,
                ]);

                $validatedData['block_widget_id'] = $block->id;

                Menu::create($validatedData);
            });

            return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the menu.'])->withInput();
        }
    }


    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $parentMenus = Menu::get();
        $categories = Category::all();

        $childMenus = $menu->childMenus;
        return view('menu', compact('menu', 'parentMenus', 'childMenus','categories'));
    }

    public function update(Request $request, $id)
    {
        // پیدا کردن منو با استفاده از آیدی
        $menu = Menu::findOrFail($id);

        // اعتبارسنجی داده‌های دریافتی
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|url|max:255', // کنترل اینکه لینک باید یک URL معتبر باشد
            'icon' => 'nullable|string',
            'alias' => 'required|string|max:50|unique:menus,alias,' . $menu->id,
            'show_title' => 'required|boolean',
            'menu_id' => 'nullable|exists:menus,id|not_in:' . $menu->id, // جلوگیری از چرخه منوها
            'type' => 'required|string|in:menu_category,features_menu,portfolio',
        ]);

        // به‌روزرسانی اطلاعات اصلی منو
        $menu->update([
            'menu_id' => $validatedData['menu_id'],
            'title' => $validatedData['title'],
            'link' => $validatedData['link'],
            'alias' => $validatedData['alias'],
            'icon' => $validatedData['icon'],
            'show_title' => $validatedData['show_title'],
        ]);

        // بازیابی یا ایجاد یک BlockWidget جدید مرتبط با این منو
        $blockWidget = $menu->blockWidget ?: new BlockWidget();

        // به‌روزرسانی اطلاعات BlockWidget
        $blockWidget->widget_id = $blockWidget->widget_id ?? Widget::where('name', 'WidgetMenus')->firstOrFail()->id;
        $blockWidget->block = "منو " . $validatedData['title'];
        $blockWidget->type = $validatedData['type'];
        $blockWidget->settings = [
            'title' => $validatedData['title'],
            'link' => $validatedData['link'],
            'alias' => $validatedData['alias'],
            'type' => $validatedData['type'],
        ];
        $blockWidget->save();

        // ارتباط BlockWidget با منو
        $menu->block_widget_id = $blockWidget->id;
        $menu->save();

        // دریافت لیست آیدی‌های منوهای فرزند ارسال‌شده در درخواست
        $childMenuIds = collect($request->menu)->pluck('id')->filter()->toArray();

        // حذف منوهایی که در درخواست جدید وجود ندارند
        $menu->childMenus()->whereNotIn('id', $childMenuIds)->delete();

        // افزودن یا به‌روزرسانی منوهای فرزند
        if ($request->has('menu')) {
            foreach ($request->menu as $childMenuData) {
                if (isset($childMenuData['id'])) {
                    // اگر منو موجود است، آن را به‌روزرسانی کن
                    $childMenu = $menu->childMenus()->find($childMenuData['id']);
                    if ($childMenu) {
                        $childMenu->update([
                            'title' => $childMenuData['title'],
                            'link' => $childMenuData['link'],
                            'alias' => $childMenuData['alias'],
                            'icon' => $childMenuData['icon'],
                            'show_title' => $childMenuData['show_title'],
                        ]);
                    }
                } else {
                    // اگر منو جدید است، آن را ایجاد کن
                    $menu->childMenus()->create([
                        'title' => $childMenuData['title'],
                        'link' => $childMenuData['link'],
                        'alias' => $childMenuData['alias'],
                        'icon' => $childMenuData['icon'],
                        'show_title' => $childMenuData['show_title'],
                        'menu_id' => $menu->id,
                    ]);
                }
            }
        }


        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }


    public function delete(Request $request)
    {
        $menu = Menu::findOrFail($request->id);
        $blockWidget = $menu->blockWidget();
        $menu->delete();
        $blockWidget->delete();

        return redirect()->route('menu.index')->with('success', 'Menu deleted successfully.');
    }

    public function bulk_action(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('checked_rows', []);

        if ($action == 'delete') {
            Menu::whereIn('id', $ids)->delete();
            return redirect()->route('menu.index')->with('success', 'Selected menus deleted successfully.');
        }

        return redirect()->route('menu.index')->with('error', 'Invalid action selected.');
    }
}
