<?php
namespace Database\Seeders;

use App\Models\Widget;
use App\Models\BlockWidget;
use Illuminate\Database\Seeder;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Widget::query()->delete();
        // Example data


        // Create sample data for WidgetProducts widget
        $data = [
            '{"title":"محصولات جدید","link":"/category/محصولات-جدید","type":"simple","count":"4","hover":true,"data":"new product"}',
            '{"title":"محصولات تخفیف دار","link":"/category/محصولات-تخفیف-دار","type":"series","count":"10","hover":true,"data":"discount product"}',
            '{"title":"برند کوروش","link":"/category/برند-کوروش","type":"special","count":"10","hover":true,"category":"برند-کوروش","data":"category"}',
        ];


        $widget = Widget::create([
            'name' => 'WidgetProducts',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);


        for ($i = 0; $i < 3; $i++) {
            BlockWidget::create([
                'widget_id' => $widget->id,
                'block' => 'block_' . ($i + 1),
                'type' => json_decode($data[$i])->data,
                'settings' => $data[$i]
            ]);
        }
        // end sample data for WidgetProducts widget


        // Create sample data for WidgetPosts widget
        // type : simple | mosaic | list | carousel | slider

        $widget = Widget::create([
            'name' => 'WidgetPosts',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"آخرین مطالب","link":"","type":"simple","count":"6","data":"new post"}',
            '{"title":"","link":"","type":"mosaic","count":"4","data":"new post"}',
            '{"title":"پر بازدیدترین مطالب","link":"","type":"list","count":"10","data":"popular post"}',
            '{"title":"نتایج جستجو","link":"","type":"simple","count":"6","data":"search"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_4' ,
            'type' => json_decode($data[0])->data,
            'settings' => $data[0]
        ]);
        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_14' ,
            'type' => json_decode($data[1])->data,
            'settings' => $data[1]
        ]);
        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_16' ,
            'type' => json_decode($data[2])->data,
            'settings' => $data[2]
        ]);
        // end sample data for WidgetPosts widget

        // Create sample data for PostsList widget
        $widget = Widget::create([
            'name' => 'WidgetPostsList',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);
        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_15' ,
            'type' => json_decode($data[0])->data,
            'settings' => $data[0]
        ]);
        // end sample data for PostsList widget

        // Create sample data for WidgetPostsList widget
        $widget = Widget::create([
            'name' => 'WidgetPostsList',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);
        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_35' ,
            'type' => json_decode($data[3])->data,
            'settings' => $data[3]
        ]);
        // End sample data for Posts widget

        // Create sample data for Banners widget
        $widget = Widget::create([
            'name' => 'WidgetBanners',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"","name":"Banner 1","link":"","type":"template2","count":"6","data":"selection","images":[1,2]}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_5' ,
            'type' => json_decode($data[0])->data,
            'settings' => $data[0]
        ]);
        // end sample data for Banners widget

        // Create sample data for Sliders widget
        $widget = Widget::create([
            'name' => 'WidgetSliders',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"","name":"Slider 1","link":"","type":"template1","count":"2","data":"selection","images":[1,2]}',
            '{"title":"","name":"Slider 2","link":"","type":"template1","count":"4","data":"selection","images":[1,2,3,4]}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_6' ,
            'type' => json_decode($data[0])->data,
            'settings' => $data[0]
        ]);
        // end sample data for Sliders widget


        // Create sample data for menu widget
        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_9' ,
            'type' => json_decode($data[1])->data,
            'settings' => $data[1]
        ]);
        $widget = Widget::create([
            'name' => 'WidgetMenus',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"دسته بندی","name":"","link":"","type":"portfolio","count":"2","alias":"categories_home_page"}',
            '{"title":"ویژگی","name":"","link":"","type":"features_menu","count":"4","alias":"features_menu"}',
            '{"title":"","name":"","link":"","type":"menu_category","count":"10"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_7' ,
            'type' => 'category',
            'settings' => $data[0]
        ]);
        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_8' ,
            'type' => 'simple',
            'settings' => $data[1]
        ]);
        // Create sample data
        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_49' ,
            'type' => 'menu_category',
            'settings' => $data[2]
        ]);


        // end sample data for menu widget

        // Create sample data for WidgetPostsSearch widget
        $widget = Widget::create([
            'name' => 'WidgetPostsSearch',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"جستجو","name":"","link":"","type":"simple"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_17' ,
            'type' => 'category',
            'settings' => $data[0]
        ]);
        // end sample data for WidgetPostsSearch widget

        // Create sample data for WidgetPostTitle widget
        $widget = Widget::create([
            'name' => 'WidgetPostTitle',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"جستجو","name":"","link":"","type":"simple"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_18' ,
            'type' => 'single post',
            'settings' => $data[0]
        ]);
        // end sample data for WidgetPostTitle widget

        // Create sample data for WidgetPostInfo widget
        $widget = Widget::create([
            'name' => 'WidgetPostInfo',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"","name":"","link":"","type":"simple"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_19' ,
            'type' => 'single post',
            'settings' => $data[0]
        ]);


        // end sample data for WidgetPostInfo widget


        // Create sample data for WidgetPostFeaturedImage widget
        $widget = Widget::create([
            'name' => 'WidgetPostFeaturedImage',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"","name":"","link":"","type":"simple"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_20' ,
            'type' => 'single post',
            'settings' => $data[0]
        ]);

        // end sample data for WidgetPostFeaturedImage widget

        // Create sample data for WidgetPostContent widget
        $widget = Widget::create([
            'name' => 'WidgetPostContent',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"","name":"","link":"","type":"simple"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_21' ,
            'type' => 'single post',
            'settings' => $data[0]
        ]);

        // end sample data for WidgetPostContent widget


        // Create sample data for WidgetPostTags widget
        $widget = Widget::create([
            'name' => 'WidgetPostTags',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"","name":"","link":"","type":"simple"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_22' ,
            'type' => 'single post',
            'settings' => $data[0]
        ]);

        // end sample data for WidgetPostTags widget


        // Create sample data for WidgetPostComments widget
        $widget = Widget::create([
            'name' => 'WidgetPostComments',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"","name":"","link":"","type":"simple"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_23' ,
            'type' => 'single post',
            'settings' => $data[0]
        ]);

        // end sample data for WidgetPostComments widget

        // Create sample data for WidgetPostCategory widget
        $widget = Widget::create([
            'name' => 'WidgetPostCategory',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"","name":"","link":"","type":"simple"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_24' ,
            'type' => 'posts category',
            'settings' => $data[0]
        ]);

        // end sample data for WidgetPostCategory widget


        // Create sample data for WidgetProductsList widget
        $widget = Widget::create([
            'name' => 'WidgetProductsList',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"","name":"","link":"","type":"list"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_44' ,
            'type' => 'category',
            'settings' => $data[0]
        ]);

        // end sample data for WidgetProductsList widget


        // Create sample data for Landing widget
        $widget = Widget::create([
            'name' => 'WidgetLanding',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"20% تخفیف بهار تابستان","name":"Landing 1","link":"","description":"با کد تخفیف بیشتر در فروش زمستانی ما صرفه جویی کنید  + ارسال رایگان برای تمام سفارشات بالای 50 تومان","btnLink1":"/link1","cap1":"اکنون کشف کنید!","btnLink2":"","cap2":"","style":"template1","type":"image","image":"/images/content/fc-img1.jpg","video":"/"}',
            '{"title":"","name":"Landing 1","link":"","description":"","btnLink1":"/","cap1":"/","btnLink2":"/","cap2":"/","","style":"template1","type":"image","image":"/link","video":"/"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_10' ,
            'type' => json_decode($data[0])->type,
            'settings' => $data[0]
        ]);
        // end sample data for Landing widget



        // Create sample data for WidgetContactForm
        $widget = Widget::create([
            'name' => 'WidgetContactForm',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"بیایید با ما تماس بگیریم!","description":"شما می توانید به هر طریقی که برای شما مناسب است با ما تماس بگیرید. ما 24/7 از طریق فکس یا ایمیل در دسترس هستیم. همچنین می توانید از فرم تماس سریع زیر استفاده کنید یا شخصاً به دفتر ما مراجعه کنید. خوشحال می شویم به سوالات شما پاسخ دهیم.","style":"template1","type":"simple"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_25' ,
            'type' => json_decode($data[0])->type,
            'settings' => $data[0]
        ]);
        // end sample data for WidgetContactForm



        // Create sample data for WidgetContactInfo
        $widget = Widget::create([
            'name' => 'WidgetContactInfo',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            [
                "title" => "اطلاعات ذخیره",
                "description" => "",
                "style" => "template1",
                "type" => "simple",
                "address" => "123، نام شرکت، نام شهر خیابان خیابان، نام ایالت و کد پستی.",
                "phone" => "(+40) 123 456 7890",
                "email" => "contact@example.com",
                "working_hours" => [
                    "شنبه - دوشنبه" => "9:30 صبح تا 6:30 عصر",
                    "یکشنبه" => "11:00 صبح تا 5:00 بعد از ظهر"
                ]
            ]
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_26' ,
            'type' => $data[0]['type'],
            'settings' => json_encode($data[0])
        ]);
        // end sample data for WidgetContactInfo

        // Create sample data for WidgetGooglemap
        $widget = Widget::create([
            'name' => 'WidgetGooglemap',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            [
                "title" => "فروشگاه ما",
                "description" => "",
                "style" => "template1",
                "type" => "simple",
                "address" => "23455",
                "working_hours" => [
                    "شنبه - دوشنبه" => "9:30 صبح تا 6:30 عصر",
                    "یکشنبه" => "11:00 صبح تا 5:00 بعد از ظهر"
                ]
            ]
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_27' ,
            'type' => $data[0]['type'],
            'settings' => json_encode($data[0])
        ]);
        // end sample data for WidgetGooglemap




        // Create sample data for WidgetPageContent widget
            $widget = Widget::create([
                'name' => 'WidgetPageContent',
                'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
            ]);

            $data = [
                '{"title":"","name":"","link":"","type":"simple"}',
            ];

            BlockWidget::create([
                'widget_id' => $widget->id,
                'block' => 'block_50' ,
                'type' => 'single page',
                'settings' => $data[0]
            ]);

        // end sample data for WidgetPageContent widget


        // Create sample data for WidgetPageTitle widget
            $widget = Widget::create([
                'name' => 'WidgetPageTitle',
                'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
            ]);

            $data = [
                '{"title":"","name":"","link":"","type":"simple"}',
            ];

            BlockWidget::create([
                'widget_id' => $widget->id,
                'block' => 'block_51' ,
                'type' => 'single page',
                'settings' => $data[0]
            ]);

        // end sample data for WidgetPageTitle widget

        // Create sample data for WidgetPageContent widget
            $widget = Widget::create([
                'name' => 'WidgetPageContent',
                'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
            ]);

            $data = [
                '{"title":"","name":"","link":"/contact-us","type":"simple"}',
            ];

            BlockWidget::create([
                'widget_id' => $widget->id,
                'block' => 'block_52' ,
                'type' => 'single page',
                'settings' => $data[0]
            ]);

        // end sample data for WidgetPageContent widget


        // Create sample data for WidgetPageTitle widget
            $widget = Widget::create([
                'name' => 'WidgetPageTitle',
                'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
            ]);

            $data = [
                '{"title":"","name":"","link":"/contact-us","type":"simple"}',
            ];

            BlockWidget::create([
                'widget_id' => $widget->id,
                'block' => 'block_53' ,
                'type' => 'single page',
                'settings' => $data[0]
            ]);

        // end sample data for WidgetPageTitle widget


        // Create sample data for WidgetPageContent widget
            $widget = Widget::create([
                'name' => 'WidgetPageContent',
                'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
            ]);

            $data = [
                '{"title":"","name":"","link":"/terms","type":"simple"}',
            ];

            BlockWidget::create([
                'widget_id' => $widget->id,
                'block' => 'block_54' ,
                'type' => 'single page',
                'settings' => $data[0]
            ]);

        // end sample data for WidgetPageContent widget


        // Create sample data for WidgetPageTitle widget
            $widget = Widget::create([
                'name' => 'WidgetPageTitle',
                'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
            ]);

            $data = [
                '{"title":"","name":"","link":"/terms","type":"simple"}',
            ];

            BlockWidget::create([
                'widget_id' => $widget->id,
                'block' => 'block_55' ,
                'type' => 'single page',
                'settings' => $data[0]
            ]);

        // end sample data for WidgetPageTitle widget


        // Create sample data for WidgetReviewComments widget
        $widget = Widget::create([
            'name' => 'WidgetReviewComments',
            'setup' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
        ]);

        $data = [
            '{"title":"","name":"","link":"","type":"simple"}',
        ];

        BlockWidget::create([
            'widget_id' => $widget->id,
            'block' => 'block_56' ,
            'type' => 'template1',
            'settings' => $data[0]
        ]);

    // end sample data for WidgetReviewComments widget




    }
}
