<?php
namespace App\Http\Controllers\API;
use App\Models\Menu;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\Widget;
use App\Models\Setting;
use App\Models\Category;
use App\Models\BlockWidget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    /**
     * بازگشت تنظیمات و منوهای اصلی سایت
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function bootstrap(): \Illuminate\Http\JsonResponse
    {
        // دریافت تنظیمات گروه 'general' از دیتابیس
        $setting = Setting::where('group', 'general')->first();

        // اگر تنظیمات موجود نبود، مقداردهی پیش‌فرض
        $siteSettings = $setting ? $setting->settings : [
            'site_title' => 'فروشگاه اینترنتی مدکالا',
            'logo' => '',
            'banner' => '',
            'footer_about' => 'متن درباره‌ی سایت',
            'maintenance_mode' => false,
        ];

        // دریافت منوهای اصلی
        $menus = Menu::mainMenu();
        $otherMenus = Menu::where(["alias"=>"quick_access"])->whereNull('menu_id')->with(['childMenus' => function($query) {
            $query->orderBy('title');
        }])->get();

        $footerMenus = Menu::where(["alias"=>"categories_footer"])->whereNull('menu_id')->with(['childMenus' => function($query) {
            $query->orderBy('title');
        }])->get();


        $social_menus = Menu::where(["alias"=>"social_media_menu"])->whereNull('menu_id')->with(['childMenus' => function($query) {
            $query->orderBy('title');
        }])->get();

        // فرمت‌دهی منوها
        $formattedMenus = $menus->map(function ($menu) {
            return [
                'id' => (string) $menu->id,
                'label' => $menu->title,
                'icon' => $menu->icon,
                'mega' => (bool)$menu->show_title ,
                'url' => $menu->link,
                'links' => $this->getChildMenus($menu->childMenus),
            ];
        });

        $formattedOtherMenus = $otherMenus->map(function ($menu) {
            return [
                'id' => (string) $menu->id,
                'label' => $menu->title,
                'icon' => $menu->icon,
                'mega' => (bool)$menu->show_title ,
                'url' => $menu->link,
                'links' => $this->getChildMenus($menu->childMenus),
            ];
        });
        $formattedFooterMenus = $footerMenus->map(function ($menu) {
            return [
                'id' => (string) $menu->id,
                'label' => $menu->title,
                'icon' => $menu->icon,
                'mega' => (bool)$menu->show_title ,
                'url' => $menu->link,
                'links' => $this->getChildMenus($menu->childMenus),
            ];
        });

        // فرمت‌دهی منوهای اجتماعی
        $formattedSocialMenus = $social_menus->map(function ($menu) {
            return [
                'id' => (string) $menu->id,
                'label' => $menu->title,
                'icon' => $menu->icon,
                'mega' => (bool)$menu->show_title ,
                'url' => $menu->link,
                'links' => $this->getChildMenus($menu->childMenus),
            ];
        });

        // ساختار داده نهایی برای پاسخ
        $data = [
            "siteTitle" => $siteSettings['site_title'] ?? "فروشگاه اینترنتی مدکالا",
            "logo" => $siteSettings['logo'] ?? "",
            "banner" => [
                "link" => $siteSettings['site_url'], // لینک بنر می‌تواند از تنظیمات هم گرفته شود
                "src" => $siteSettings['banner'] ?? "" // آدرس تصویر بنر
            ],
            "menu" => [
                //array combine
                "main" => array_merge( $formattedMenus->toArray(),$formattedOtherMenus->toArray()),
                "footer" => $formattedFooterMenus->toArray(),
                "social" => $formattedSocialMenus->toArray(),
            ],
            "footerAbout" => $siteSettings['footer_about'] ?? "متن درباره‌ی سایت",
        ];


        $response=[
            "message"=> "ok",
            "data"=> $data
        ];
        return response()->json($response, 200);

    }

    /**
     * دریافت منوهای فرزند برای هر منو
     */
    private function getChildMenus($childMenus)
    {
        return $childMenus->map(function ($childMenu) {
            return [
                'id'  => (string) $childMenu->id,
                'label' => $childMenu->title,
                'icon' => $childMenu->icon,
                'mega' => false,
                'url' => $childMenu->link,
                'links' => $childMenu->childMenus->isNotEmpty() ? $this->getChildMenus($childMenu->childMenus) : [], // دریافت فرزندان در تمام سطوح
            ];
        })->toArray();
    }

    /**
     * دریافت نوع شبکه اجتماعی از نام منو
     */
    private function getSocialMediaType($menuLabel)
    {
        $socialMediaTypes = [
            'instagram' => 'instagram',
            'telegram' => 'telegram',
            'x' => 'x',
            'facebook' => 'facebook',
            'linkedin' => 'linkedin',
            'youtube' => 'youtube',
            'twitter' => 'twitter',
            'pinterest' => 'pinterest',
            'snapchat' => 'snapchat',
            'whatsapp' => 'whatsapp',
        ];

        return $socialMediaTypes[strtolower($menuLabel)] ?? 'unknown';
    }


    public function home(){

        $widget = Widget::where("name", 'WidgetProducts')->first();
        $widgetProducts = BlockWidget::where(["widget_id" => $widget->id])->get();

        $widget = Widget::where("name", 'WidgetMenus')->first();
        $widgetMenus = BlockWidget::where(["widget_id" => $widget->id])->get();

        $widget = Widget::where("name", 'WidgetBanners')->first();
        $widgetBanners = BlockWidget::where(["widget_id" => $widget->id])->get();


        $widget = Widget::where("name", 'WidgetSliders')->first();
        $widgetSliders = BlockWidget::where(["widget_id" => $widget->id])->get();


        $responseData = [
            "message" => "ok",
            "data" => [
                "featured_promo" => [],
                "categories" => [],
                "banners" => [],
                "trendProducts" => [],
                "productGrid" => [],
                "brands" => [],
                "featured_products" => [],
            ]
        ];
        $responseData['data']['featured_promo']['type']="featured_promo";
        $responseData['data']['categories']['type']="categories";
        $responseData['data']['banners']['type']="banners";
        $responseData['data']['trendProducts']['type']="trendProducts";
        $responseData['data']['productGrid']['type']="productGrid";
        $responseData['data']['brands']['type']="brands";
        $responseData['data']['featured_products']['type']="featured_products";

        foreach ($widgetProducts as $blockWidget) {

            $options = $blockWidget->settings;


            if (isset($options->category) and $options->category === "برند-کوروش") {
                $count = $options->count ?? 4;
                $category = Category::where('alias', $options->category)->first();
                if ($category) {
                    $products = $category->products()->inRandomOrder()->take($count)->get();
                    foreach ($products as $product) {
                        $responseData['data']['featured_promo']['data'][] = [
                            "id" => $product->id,
                            "title" => $product->title,
                            "slug" => $product->id,
                            "regularPrice" => $product->price,
                            "discountedPrice" => $product->sale_price,
                            "discountPercent" => $product->discount_percentage,
                            "image" => $product->img,
                        ];
                    }
                }
            }
            elseif (isset($options->category) and $options->category === "محصولات-ویژه") {
                $count = $options->count ?? 4;
                $category = Category::where('alias', $options->category)->first();
                if ($category) {
                    $products = $category->products()->inRandomOrder()->take($count)->get();
                    foreach ($products as $product) {
                        $responseData['data']['featured_products']['data'][] = [
                            "id" => $product->id,
                            "title" => $product->title,
                            "slug" => $product->id,
                            "regularPrice" => $product->price,
                            "discountedPrice" => $product->sale_price,
                            "discountPercent" => $product->discount_percentage,
                            "image" => $product->img,
                        ];
                    }
                }
            }
        }

        foreach ($widgetMenus as $blockWidget) {

            $options = $blockWidget->settings;


            if (isset($options->alias) and $options->alias=="categories_home") {
                $count = $options->count ?? 4;
                if ($options->alias) {
                    $menus = Menu::where(['alias'=>$options->alias,])->first();

                    foreach ($menus->childMenus as $menu) {
                        $responseData['data']['categories']['data'][] = [
                            "image"=>$menu->icon,
                            "title"=>$menu->title,
                            "url"=>$menu->link,
                        ];
                    }
                }
            }
            elseif (isset($options->alias) and $options->alias=="trendProducts") {
                $count = $options->count ?? 4;
                if ($options->alias) {
                    $menus = Menu::where(['alias'=>$options->alias,])->first();

                    foreach ($menus->childMenus as $menu) {
                        $responseData['data']['trendProducts']['data'][0][] = [
                            "image"=>$menu->icon,
                            "title"=>$menu->title,
                            "url"=>$menu->link,
                        ];
                        $responseData['data']['trendProducts']['data'][1][] = [
                            "image"=>$menu->icon,
                            "title"=>$menu->title,
                            "url"=>$menu->link,
                        ];
                        $responseData['data']['trendProducts']['data'][2][] = [
                            "image"=>$menu->icon,
                            "title"=>$menu->title,
                            "url"=>$menu->link,
                        ];
                    }
                }
            }
            elseif (isset($options->alias) and $options->alias=="brands") {
                $count = $options->count ?? 4;
                if ($options->alias) {
                    $menus = Menu::where(['alias'=>$options->alias,])->first();
                    $list=[];

                    foreach ($menus->childMenus as $menu) {
                        $list[] = [
                            "image"=>$menu->icon,
                            "title"=>$menu->title,
                            "url"=>$menu->link,
                        ];
                    }
                    $responseData['data']['brands']['data']=["title"=>$options->title,"children"=>$list];

                }
            }
            elseif (isset($options->alias) and $options->alias=="productGrid") {
                $count = $options->count ?? 4;
                if ($options->alias) {
                    $menus = Menu::where(['alias'=>$options->alias,])->first();
                    $list=[];

                    foreach ($menus->childMenus as $menu) {
                        $list[] = [
                            "image"=>$menu->icon,
                            "title"=>$menu->title,
                            "url"=>$menu->link,
                        ];
                    }
                    $responseData['data']['productGrid']['data'][]=["title"=>$options->title,"children"=>$list];
                    $responseData['data']['productGrid']['data'][]=["title"=>$options->title,"children"=>$list];
                    $responseData['data']['productGrid']['data'][]=["title"=>$options->title,"children"=>$list];
                    $responseData['data']['productGrid']['data'][]=["title"=>$options->title,"children"=>$list];

                }
            }
        }

        foreach ($widgetBanners as $blockWidget) {

                $options = $blockWidget->settings;

                $bannerName = $options->name ?? null;
                $imageIds = $options->images ?? [];

                if(count($imageIds)>0){
                    $banners = Banner::where('name', $bannerName)->get();

                    if(isset($banners)){
                        foreach ($banners as $banner) {

                            foreach ($banner->images as $banner) {
                                $responseData['data']['banners']['data'][] = [
                                    "image"=>$banner->image,
                                    "url"=>$banner->link,
                                ];
                            }

                        }

                    }

                }
        }


        foreach ($widgetSliders as $blockWidget) {

            $options = $blockWidget->settings;

            $sliderName = $options->name ?? null;
            $imageIds = $options->images ?? [];

            if(count($imageIds)>0 and $sliderName=="Slider 1"){
                $sliders = Slider::where('name', $sliderName)->get();

                if(isset($sliders)){
                    foreach ($sliders as $slider) {

                        foreach ($slider->images as $slider) {
                            $responseData['data']['sliders']['data'][] = [
                                "image"=>$slider->image,
                                "url"=>$slider->link,
                            ];
                        }

                    }

                }

            }
        }

        $responseData["data"]= array_values($responseData["data"]);
        return response()->json($responseData);


    }

}
