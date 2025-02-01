<?php

namespace App\Http\Controllers;

use App\Models\Widget;
use App\Models\Category;
use App\Models\BlockWidget;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class ProductsLoopController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_products_loop';
    }

    public function index(Request $request)
    {
        // دریافت ویجت با نام 'WidgetProducts'
        $widget = Widget::where("name", 'WidgetProducts')->first();
    
        // بررسی اینکه آیا ویجت وجود دارد
        if (!$widget) {
            return redirect()->back()->withErrors('ویجت پیدا نشد.');
        }
    
        // دریافت کوئری برای BlockWidget های مرتبط با ویجت
        $query = BlockWidget::where("widget_id", $widget->id)->get();
        $blockWidgets =$query;
        // اعمال فیلتر دسترسی کاربر
        //$query = $this->applyAccessControl($query);
    
        // صفحه‌بندی داده‌ها
        //$blockWidgets = $query->paginate(10);
        //dd($blockWidgets);
        // بازگشت به ویو به همراه داده‌های مورد نیاز
        return view('products-loops', compact('blockWidgets'));
    }
    

    public function create()
    {
        $widget = Widget::where("name",'WidgetProducts')->first();
        return view('products-loop',compact('widget'));
    }

    public function store(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'count' => 'required|integer|min:1',
            'link' => 'nullable|string',
            'type' => 'required|in:discount product,new product,category',
            'theme_type' => 'nullable|in:simple,series,special',
            'sort_order' => 'required|in:asc,desc,random',
            'products' => 'nullable|array',
            'date_range' => 'nullable|string',
            'show_timer' => 'nullable|boolean',
        ]);
    
        // دریافت ID ویجت
        $widgetId = $request->input('widget_id');
        $blockName = "حلقه محصولات " . $validatedData['title'];
    
        // تنظیمات جدید
        $settings = [
            'title' => $validatedData['title'],
            'count' => $validatedData['count'],
            'link' => $validatedData['link'] ?? '',
            'type' => $validatedData['theme_type'],
            'sort_order' => $validatedData['sort_order'],
            'show_timer' => $request->has('show_timer'), // بررسی فعال بودن تایمر
            'date_range' => $validatedData['date_range'] ?? '',
            'data' => $validatedData['type']
        ];
    
        // اگر شناسه دسته‌بندی وجود دارد، دسته‌بندی را پیدا کرده و در تنظیمات ذخیره کنیم
        if(isset($validatedData['category_id'])){
            $category = Category::find($validatedData['category_id']);
            $settings['category'] = $category->alias;
        }
    
        // اگر نوع نمایش "فروش ویژه" باشد، محصولات و بازه زمانی را نیز اضافه کنیم
        if ($validatedData['theme_type'] === 'onsale') {
            $settings['products'] = $validatedData['products'] ?? [];
            $settings['date_range'] = $validatedData['date_range'] ?? '';
        }
    
        // ذخیره ویجت جدید با تنظیمات JSON
        BlockWidget::create([
            'widget_id' => $widgetId,
            'block' => $blockName,
            'type' => $validatedData['type'],
            'settings' => json_encode($settings),
        ]);
    
        // بازگشت به صفحه فهرست حلقه‌ها با پیام موفقیت
        return redirect()->route('products-loop.index')->with('success', 'حلقه محصول با موفقیت ایجاد شد.');
    }
    
    public function edit($id)
    {
        // یافتن ویجت بر اساس شناسه
        $blockWidget = BlockWidget::findOrFail($id);
    
        // استخراج تنظیمات و تبدیل JSON به شیء
        $setting = $blockWidget->settings;
    
        // بررسی اینکه آیا تنظیمات وجود دارد و شامل 'category' است
        $category = null;
        if (isset($setting->category)) {
            $alias = $setting->category;
            // یافتن دسته‌بندی بر اساس 'alias'
            $category = Category::where('alias', $alias)->first();
        }
        
        // ارسال تنظیمات به ویو به عنوان یک شیء
        return view('products-loop', compact('blockWidget', 'category', 'setting'));
    }
    
    


    public function update(Request $request, $id)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'count' => 'required|integer|min:1',
            'link' => 'nullable|string',
            'type' => 'required|in:discount product,new product,category',
            'theme_type' => 'nullable|in:simple,series,special',
            'sort_order' => 'required|in:asc,desc,random',
            'products' => 'nullable|array',
            'date_range' => 'nullable|string',
            'show_timer' => 'nullable|boolean',
        ]);
    
        // یافتن ویجت مورد نظر
        $blockWidget = BlockWidget::findOrFail($id);
    
        // تنظیمات جدید
        $settings = [
            'title' => $validatedData['title'],
            'count' => $validatedData['count'],
            'link' => $validatedData['link'] ?? '',
            'type' => $validatedData['theme_type'],
            'sort_order' => $validatedData['sort_order'],
            'show_timer' => $request->has('show_timer'), // بررسی فعال بودن تایمر
            'date_range' => $validatedData['date_range'] ?? '',
            'data' => $validatedData['type']
        ];

        if(isset($validatedData['category_id'])){
            $category=Category::find($validatedData['category_id']);
            $settings['category'] = $category->alias;
        }

        // اگر نوع نمایش "فروش ویژه" باشد، محصولات و بازه زمانی را نیز اضافه کنیم
        if ($validatedData['theme_type'] === 'onsale') {
            $settings['products'] = $validatedData['products'] ?? [];
            $settings['date_range'] = $validatedData['date_range'] ?? '';
        }
    
        // به‌روزرسانی ویجت
        $blockWidget->update([
            'block' => "حلقه محصولات " . $validatedData['title'],
            'type' => $validatedData['type'],
            'settings' => json_encode($settings),
        ]);
    
        // بازگشت به صفحه فهرست با پیام موفقیت
        return redirect()->route('products-loop.index')->with('success', 'حلقه محصول با موفقیت به‌روزرسانی شد.');
    }
    
    public function delete($id)
    {

        $block = BlockWidget::find($id);
        //$this->authorizeAction($block);
        
        $block->delete();

        return redirect()->route('products-loop.index')->with('success', 'حلقه محصول با موفقیت حذف شد.');
    }
    public function bulk_action(Request $request)
    {

    }
}
