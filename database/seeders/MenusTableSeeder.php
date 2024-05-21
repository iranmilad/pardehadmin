<?php
namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::query()->delete();
        // Insert main menu record
        $mainMenuId = DB::table('menus')->insertGetId([
            'title' => 'ویژگی‌ها',
            'alias' => 'features_menu',
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Define menu items
        $menuItems = [
            [
                "id" => 1,
                "title" => "تحویل اکسپرس",
                "icon" => "/images/logo/brandlogo1.png",
            ],
            [
                "id" => 2,
                "title" => "خرید آنلاین مطمئن",
                "icon" => "/images/logo/brandlogo1.png",
            ],
            [
                "id" => 3,
                "title" => " تضمین اصالت کالا",
                "icon" => "/images/logo/brandlogo1.png",
            ],
            [
                "id" => 4,
                "title" => "مشاور رایگان خرید",
                "icon" => "/images/logo/brandlogo1.png",
            ],
            [
                "id" => 5,
                "title" => "ضمانت بازگشت",
                "icon" => "/images/logo/brandlogo1.png",
            ],
        ];

        // Insert menu items
        foreach ($menuItems as $item) {
            $alias = 'features_menu_' . $item['id'];
            DB::table('menus')->insert([
                'title' => $item['title'],
                'icon' => $item['icon'],
                'link' => '#', // مسیر اینجا باید به شیوه‌ای مناسب تعیین شود
                'alias' => $alias,
                'menu_id' => $mainMenuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // Insert main menu record
        $mainMenuId = DB::table('menus')->insertGetId([
            'title' => 'دسته بندی فرعی',
            'alias' => 'برند-کوروش',
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $menuItems = [
            [
                "id" => 1,
                "title"=> "پرده آشپزخانه",
                "icon"=> "/images/categories/1.jpg",
                "link"=> "/category/"
            ],
            [
                "id" => 2,
                "title"=> "پرده پانچی",
                "icon"=> "/images/categories/2.jpg",
                "link"=> "/category/"
            ],
            [
                "id" => 3,
                "title"=> "پرده تور کتان",
                "icon"=> "/images/categories/3.jpg",
                "link"=> "/category/"
            ],
            [
                "id" => 4,
                "title"=> "پرده مخمل",
                "icon"=> "/images/categories/4.jpg",
                "link"=> "/category/"
            ],
            [
                "id" => 5,
                "title"=> "پرده هتلی",
                "icon"=> "/images/categories/5.jpg",
                "link"=> "/category/"
            ],
            [
                "id" => 6,
                "title"=> "پرده کرکره ای",
                "icon"=> "/images/categories/6.jpg",
                "link"=> "/category/"
            ],
            [
                "id" => 7,
                "title"=> "پرده زبرا",
                "icon"=> "/images/categories/7.jpg",
                "link"=> "/category/"
            ],
            [
                "id" => 8,
                "title"=> "پرده رومن",
                "icon"=> "/images/categories/8.jpg",
                "link"=> "/category/"
            ],
            [
                "id" => 9,
                "title"=> "آستر پرده",
                "icon"=> "/images/categories/9.jpg",
                "link"=> "/category/"
            ],
            [
                "id" => 10,
                "title"=> "پرده طرح دار",
                "icon"=> "/images/categories/10.jpg",
                "link"=> "/category/"
            ],
            [
                "id" => 11,
                "title"=> "پرده حریر",
                "icon"=> "/images/categories/11.jpg",
                "link"=> "/category/"
            ]
        ];
        // Insert menu items
        foreach ($menuItems as $item) {
            $alias = 'برند-کوروش_' . $item['id'];
            DB::table('menus')->insert([
                'title' => $item['title'],
                'icon' => $item['icon'],
                'link' => '#', // مسیر اینجا باید به شیوه‌ای مناسب تعیین شود
                'alias' => $alias,
                'menu_id' => $mainMenuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // Insert menu record
        $mainMenuId = DB::table('menus')->insertGetId([
            'title' => 'منوی اصلی',
            'alias' => 'main_menu',
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Define menu items
        DB::table('menus')->insertGetId([
            'title' => 'خانه',
            'show_title' => false,
            "link"=> "/",
            'icon' => '<i class="fa-regular fa-house"></i>',
            'alias' => 'home',
            'menu_id' => $mainMenuId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);





        // Insert menu record
        $menuId = DB::table('menus')->insertGetId([
            'title' => 'محصولات',
            'alias' => 'product',
            'menu_id' => $mainMenuId,
            'show_title' => false,
            'icon' => '<i class="fa-regular fa-grid-2"></i>',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Define menu items
        $menuItems = [
            [
              "id" => 1,
              "title"=> "پرده ی اماده ی تورکان",
              "icon"=> "<svg viewBox=\"0 0 50 54\" xmlns=\"http=>//www.w3.org/2000/svg\"><title>shutter icon</title><g stroke=\"#42145f\" stroke-linejoin=\"round\" stroke-miterlimit=\"10\"><path d=\"m.7.7h48.6v52.6h-48.6z\" fill=\"#fff\" stroke-width=\"1.001\"></path><path d=\"m5.8 7.7h17.4v38.3h-17.4z\" fill=\"none\" stroke-width=\"1.024\"></path><path d=\"m5.7 16.8h17.5m-17.5 10.3h17.5m-17.5 10.4h17.5\" fill=\"#fff\" stroke-width=\"1.1875\"></path><path d=\"m26.8 7.7h17.4v38.3h-17.4z\" fill=\"none\" stroke-width=\"1.024\"></path><path d=\"m26.8 16.8h17.4m-17.4 10.3h17.4m-17.4 10.4h17.4\" fill=\"#fff\" stroke-width=\"1.1875\"></path></g></svg>",
              "link"=> "/category"
            ],
            [
              "id" => 2,
              "title"=> "پرده آستر",
              "icon"=> "<svg viewBox=\"8 -10 50 55\" xmlns=\"http=>//www.w3.org/2000/svg\"><title>vertical blinds icon</title><g stroke=\"#3f245d\" stroke-miterlimit=\"10\"><path d=\"m11.7-7.3v49.1h40.8v-49.1\" fill=\"#fff\" stroke-width=\"1.47\"></path><path d=\"m17.4 41.8v-49.1m6 49.1v-49.1m5.7 49.1v-49.1m6 49.1v-49.1m5.7 49.1v-49.1m6 49.1v-49.1\" fill=\"none\" stroke-width=\"1.47\"></path><path d=\"m55.1-6.7v32.9\" fill=\"none\" stroke-width=\".735\"></path></g><path d=\"m54.1 25.3h2.2v4.8h-2.2z\" fill=\"#3f245d\"></path><path d=\"m9-7.1h48.5\" fill=\"none\" stroke=\"#3f245d\" stroke-miterlimit=\"10\" stroke-width=\"2.205\"></path></svg>",
              "link"=> "/category"
            ],
            [
              "id" => 3,
              "title"=> "پرده ی زبرا",
              "icon"=> "<svg viewBox=\"0 0 50 49\" xmlns=\"http=>//www.w3.org/2000/svg\"><title>wooden blinds icon</title><g stroke-miterlimit=\"10\"><path d=\"m30.9 3v2.1m0 10.5v2.2m0 10.4v2.2\" fill=\"none\" stroke=\"#575756\"></path><path d=\"m11.2 22.9 37.6-13.8-9.4-6.8-38.3 12.9zm0 12.6 37.6-13.7-9.4-6.9-38.3 13zm0 12.6 37.6-13.7-9.4-6.9-38.3 13z\" fill=\"#fff\" stroke=\"#42145f\"></path><path d=\"m41 7.3v32.1m-10-10s5.6 1.9 9.9 7.1m-10.2-19.5s6 2.1 10.3 7.3m-10.3-20.2s6 2.2 10.4 7.5\" fill=\"none\" stroke=\"#575756\"></path></g></svg>",
              "link"=> "/category"
            ],
            [
              "id" => 4,
              "title"=> "پرده ی مخمل",
              "icon"=> "<svg viewBox=\"0 0 50 54\" xmlns=\"http=>//www.w3.org/2000/svg\"><title>shutter icon</title><g stroke=\"#42145f\" stroke-linejoin=\"round\" stroke-miterlimit=\"10\"><path d=\"m.7.7h48.6v52.6h-48.6z\" fill=\"#fff\" stroke-width=\"1.001\"></path><path d=\"m5.8 7.7h17.4v38.3h-17.4z\" fill=\"none\" stroke-width=\"1.024\"></path><path d=\"m5.7 16.8h17.5m-17.5 10.3h17.5m-17.5 10.4h17.5\" fill=\"#fff\" stroke-width=\"1.1875\"></path><path d=\"m26.8 7.7h17.4v38.3h-17.4z\" fill=\"none\" stroke-width=\"1.024\"></path><path d=\"m26.8 16.8h17.4m-17.4 10.3h17.4m-17.4 10.4h17.4\" fill=\"#fff\" stroke-width=\"1.1875\"></path></g></svg>",
              "link"=> "/category"
            ],
            [
              "id" => 5,
              "title"=> "پرده ی حریر",
              "icon"=> "<svg xmlns=\"http=>//www.w3.org/2000/svg\" viewBox=\"8 -10 50 54\"><title>blackout blinds icon</title><g fill=\"#fff\" stroke=\"#42145f\" stroke-miterlimit=\"10\" stroke-width=\"1.0331\"><path d=\"m56.9 31-4.4-.6-2.1-4-1.9 4.1-4.5.6 3.3 3.2-.7 4.4 3.9-2.1 4 2-.8-4.4zm-6.5-20.7-8.5-1.1-3.9-7.7-3.7 7.8-8.5 1.3 6.2 5.9-1.3 8.5 7.5-4.1 7.7 3.9-1.6-8.4z\"></path><path d=\"m20.7 17c0-12.3 8.6-22.5 20-25.2-1.9-.4-3.8-.7-5.8-.7-14.2.1-25.8 11.6-25.8 25.9s11.6 25.8 25.8 25.8c2 0 3.9-.2 5.8-.7-11.5-2.6-20-12.8-20-25.1z\"></path></g></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 6,
              "title"=> "پرده ی پانچی",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"8 -5 50 45\" xmlns=\"http=>//www.w3.org/2000/svg\"><title>velux blinds icon</title><style>.st0,.st1[fill=>#fff;stroke=>#42145f;stroke-width=>1.0351;stroke-linejoin=>round;stroke-miterlimit=>10].st1[fill=>none]</style><path class=\"st0\" d=\"M54.2 39.4l2.9-2.7L40.4-4 37.6-.9M8.5.5l2.6-3.4 29.3-1.3-2.8 3.3\"></path><path class=\"st0\" d=\"M8.5.5L37.6-.9l16.5 40.3-28.3-.6z\"></path><path class=\"st1\" d=\"M23.4 22.4l5.4 12.3 21.2.2\"></path><path shape-rendering=\"crispEdges\" d=\"M45.3 22.6L22 23 13 3.2l23.8-.8z\" fill=\"#42145f\"></path><path class=\"st1\" d=\"M11.9 3.2l24.9-.9 14.6 35.2-24.4-.4z\"></path></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 7,
              "title"=> "قرمز",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#ef4444\"></circle></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 8,
              "title"=> "زرد",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#eab308\"></circle></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 9,
              "title"=> "لیمویی",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#84cc16\"></circle></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 10,
              "title"=> "آبی آسمانی",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#06b6d4\"></circle></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 11,
              "title"=> "بنفش",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#8b5cf6\"></circle></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 12,
              "title"=> "صورتی",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#ec4899\"></circle></svg>",
              "link"=> "/category"
            ]
        ];

        // Insert menu items
        foreach ($menuItems as $item) {
            DB::table('menus')->insert([
                'title' => $item['title'],
                'icon' => $item['icon'],
                'link' => $item['link'],
                'alias' => 'product_'.$item['id'],
                'menu_id' => $menuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // Insert menu record
        $menuId = DB::table('menus')->insertGetId([
            'title' => 'پرده',
            'alias' => 'curtain',
            'menu_id' => $mainMenuId,
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Define menu items
        $menuItems = [
            [
              "id" => 1,
              "title"=> "پرده ی اماده ی تورکان",
              "icon"=> "<svg viewBox=\"0 0 50 54\" xmlns=\"http=>//www.w3.org/2000/svg\"><title>shutter icon</title><g stroke=\"#42145f\" stroke-linejoin=\"round\" stroke-miterlimit=\"10\"><path d=\"m.7.7h48.6v52.6h-48.6z\" fill=\"#fff\" stroke-width=\"1.001\"></path><path d=\"m5.8 7.7h17.4v38.3h-17.4z\" fill=\"none\" stroke-width=\"1.024\"></path><path d=\"m5.7 16.8h17.5m-17.5 10.3h17.5m-17.5 10.4h17.5\" fill=\"#fff\" stroke-width=\"1.1875\"></path><path d=\"m26.8 7.7h17.4v38.3h-17.4z\" fill=\"none\" stroke-width=\"1.024\"></path><path d=\"m26.8 16.8h17.4m-17.4 10.3h17.4m-17.4 10.4h17.4\" fill=\"#fff\" stroke-width=\"1.1875\"></path></g></svg>",
              "link"=> "/category"
            ],
            [
              "id" => 2,
              "title"=> "پرده آستر",
              "icon"=> "<svg viewBox=\"8 -10 50 55\" xmlns=\"http=>//www.w3.org/2000/svg\"><title>vertical blinds icon</title><g stroke=\"#3f245d\" stroke-miterlimit=\"10\"><path d=\"m11.7-7.3v49.1h40.8v-49.1\" fill=\"#fff\" stroke-width=\"1.47\"></path><path d=\"m17.4 41.8v-49.1m6 49.1v-49.1m5.7 49.1v-49.1m6 49.1v-49.1m5.7 49.1v-49.1m6 49.1v-49.1\" fill=\"none\" stroke-width=\"1.47\"></path><path d=\"m55.1-6.7v32.9\" fill=\"none\" stroke-width=\".735\"></path></g><path d=\"m54.1 25.3h2.2v4.8h-2.2z\" fill=\"#3f245d\"></path><path d=\"m9-7.1h48.5\" fill=\"none\" stroke=\"#3f245d\" stroke-miterlimit=\"10\" stroke-width=\"2.205\"></path></svg>",
              "link"=> "/category"
            ],
            [
              "id" => 3,
              "title"=> "پرده ی زبرا",
              "icon"=> "<svg viewBox=\"0 0 50 49\" xmlns=\"http=>//www.w3.org/2000/svg\"><title>wooden blinds icon</title><g stroke-miterlimit=\"10\"><path d=\"m30.9 3v2.1m0 10.5v2.2m0 10.4v2.2\" fill=\"none\" stroke=\"#575756\"></path><path d=\"m11.2 22.9 37.6-13.8-9.4-6.8-38.3 12.9zm0 12.6 37.6-13.7-9.4-6.9-38.3 13zm0 12.6 37.6-13.7-9.4-6.9-38.3 13z\" fill=\"#fff\" stroke=\"#42145f\"></path><path d=\"m41 7.3v32.1m-10-10s5.6 1.9 9.9 7.1m-10.2-19.5s6 2.1 10.3 7.3m-10.3-20.2s6 2.2 10.4 7.5\" fill=\"none\" stroke=\"#575756\"></path></g></svg>",
              "link"=> "/category"
            ],
            [
              "id" => 4,
              "title"=> "پرده ی مخمل",
              "icon"=> "<svg viewBox=\"0 0 50 54\" xmlns=\"http=>//www.w3.org/2000/svg\"><title>shutter icon</title><g stroke=\"#42145f\" stroke-linejoin=\"round\" stroke-miterlimit=\"10\"><path d=\"m.7.7h48.6v52.6h-48.6z\" fill=\"#fff\" stroke-width=\"1.001\"></path><path d=\"m5.8 7.7h17.4v38.3h-17.4z\" fill=\"none\" stroke-width=\"1.024\"></path><path d=\"m5.7 16.8h17.5m-17.5 10.3h17.5m-17.5 10.4h17.5\" fill=\"#fff\" stroke-width=\"1.1875\"></path><path d=\"m26.8 7.7h17.4v38.3h-17.4z\" fill=\"none\" stroke-width=\"1.024\"></path><path d=\"m26.8 16.8h17.4m-17.4 10.3h17.4m-17.4 10.4h17.4\" fill=\"#fff\" stroke-width=\"1.1875\"></path></g></svg>",
              "link"=> "/category"
            ],
            [
              "id" => 5,
              "title"=> "پرده ی حریر",
              "icon"=> "<svg xmlns=\"http=>//www.w3.org/2000/svg\" viewBox=\"8 -10 50 54\"><title>blackout blinds icon</title><g fill=\"#fff\" stroke=\"#42145f\" stroke-miterlimit=\"10\" stroke-width=\"1.0331\"><path d=\"m56.9 31-4.4-.6-2.1-4-1.9 4.1-4.5.6 3.3 3.2-.7 4.4 3.9-2.1 4 2-.8-4.4zm-6.5-20.7-8.5-1.1-3.9-7.7-3.7 7.8-8.5 1.3 6.2 5.9-1.3 8.5 7.5-4.1 7.7 3.9-1.6-8.4z\"></path><path d=\"m20.7 17c0-12.3 8.6-22.5 20-25.2-1.9-.4-3.8-.7-5.8-.7-14.2.1-25.8 11.6-25.8 25.9s11.6 25.8 25.8 25.8c2 0 3.9-.2 5.8-.7-11.5-2.6-20-12.8-20-25.1z\"></path></g></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 6,
              "title"=> "پرده ی پانچی",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"8 -5 50 45\" xmlns=\"http=>//www.w3.org/2000/svg\"><title>velux blinds icon</title><style>.st0,.st1[fill=>#fff;stroke=>#42145f;stroke-width=>1.0351;stroke-linejoin=>round;stroke-miterlimit=>10].st1[fill=>none]</style><path class=\"st0\" d=\"M54.2 39.4l2.9-2.7L40.4-4 37.6-.9M8.5.5l2.6-3.4 29.3-1.3-2.8 3.3\"></path><path class=\"st0\" d=\"M8.5.5L37.6-.9l16.5 40.3-28.3-.6z\"></path><path class=\"st1\" d=\"M23.4 22.4l5.4 12.3 21.2.2\"></path><path shape-rendering=\"crispEdges\" d=\"M45.3 22.6L22 23 13 3.2l23.8-.8z\" fill=\"#42145f\"></path><path class=\"st1\" d=\"M11.9 3.2l24.9-.9 14.6 35.2-24.4-.4z\"></path></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 7,
              "title"=> "قرمز",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#ef4444\"></circle></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 8,
              "title"=> "زرد",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#eab308\"></circle></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 9,
              "title"=> "لیمویی",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#84cc16\"></circle></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 10,
              "title"=> "آبی آسمانی",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#06b6d4\"></circle></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 11,
              "title"=> "بنفش",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#8b5cf6\"></circle></svg>",
              "link"=> "/category"
            ],
            [
                "id" => 12,
              "title"=> "صورتی",
              "icon"=> "<svg width=\"35\" height=\"35\" viewBox=\"0 0 100 100\" xmlns=\"http=>//www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" fill=\"#ec4899\"></circle></svg>",
              "link"=> "/category"
            ]
        ];

        // Insert menu items
        foreach ($menuItems as $item) {
            DB::table('menus')->insert([
                'title' => $item['title'],
                'icon' => $item['icon'],
                'link' => $item['link'],
                'alias' => 'curtain_'.$item['id'],
                'menu_id' => $menuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert menu record
        $menuId = DB::table('menus')->insertGetId([
            'title' => 'روتختی',
            'alias' => 'bedspread',
            'menu_id' => $mainMenuId,
            "link"=> "/category/bedspread",
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Insert menu record
        $menuId = DB::table('menus')->insertGetId([
            'title' => 'تجهیزات جانبی پرده',
            'alias' => 'curtain_tools',
            'menu_id' => $mainMenuId,
            "link"=> "/category/curtain_tools",
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert menu record
        $menuId = DB::table('menus')->insertGetId([
            'title' => 'وبلاگ',
            'alias' => 'blog',
            "link"=> "/blog",
            'menu_id' => $mainMenuId,
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Insert menu record
        $mainMenuId = DB::table('menus')->insertGetId([
            'title' => 'دسته بندی',
            'alias' => 'categories_home_page',
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Define menu items
        $menuItems = [
            [
                "id" => 1,
                "title"=> "خانه و آشپرخانه",
                "icon"=> "images/categories/1.jpg",
                "link"=> "/category"
            ],
            [
                "id" => 2,
                "title"=>"اسباب بازی",
                "icon"=> "images/categories/2.jpg",
                "link"=> "/category"
            ],
            [
                "id" => 3,
                "title"=> "شخصی",
                "icon"=> "images/categories/3.jpg",
                "link"=> "/category"
            ],
            [
                "id" => 4,
                "title"=> "ورزش",
                "icon"=> "images/categories/4.jpg",
                "link"=> "/category"
            ],
            [
                "id" => 5,
                "title"=> "ورزش",
                "icon"=> "images/categories/5.jpg",
                "link"=> "/category"
            ],
            [
                "id" => 6,
                "title"=> "خانه و آشپرخانه",
                "icon"=> "images/categories/6.jpg",
                "link"=> "/category"
            ],
            [
                "id" => 7,
                "title"=> "اسباب بازی",
                "icon"=> "images/categories/7.jpg",
                "link"=> "/category"
            ],
            [
                "id" => 8,
                "title"=> "شخصی",
                "icon"=> "images/categories/8.jpg",
                "link"=> "/category"
            ],
            [
                "id" => 9,
                "title"=> "ورزش",
                "icon"=> "images/categories/9.jpg",
                "link"=> "/category"
            ],
            [
                "id" => 10,
                "title"=> "ورزش",
                "icon"=> "images/categories/4.jpg",
                "link"=> "/category"
            ]
        ];

        // Insert menu items
        foreach ($menuItems as $item) {
            DB::table('menus')->insert([
                'title' => $item['title'],
                'icon' => $item['icon'],
                'link' => $item['link'],
                'alias' => 'categories_home_page_'.$item['id'],
                'menu_id' => $mainMenuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ایجاد منو اصلی برای دسته بندی ها
        $mainMenuId = DB::table('menus')->insertGetId([
            'title' => 'دسته بندی ها',
            'alias' => 'categories_footer',
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // تعریف آیتم‌های منو
        $menuItems = [
            'پرده',
            'رو تختی',
            'کاغذ دیواری',
            'موکت',
            'فرش',
            'کوسن و روبالشی',
            'لوستر و آباژور',
            'قالیچه و پادری',
            'مبلمان',
            'آینه',
        ];

        // درج آیتم‌های منو
        foreach ($menuItems as $index => $title) {
            DB::table('menus')->insert([
                'title' => $title,
                'link' => '#',
                'alias' => 'categories_footer_' . ($index + 1),
                'menu_id' => $mainMenuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ایجاد منو اصلی برای تماس با ما
        $mainMenuId = DB::table('menus')->insertGetId([
            'title' => 'تماس باما',
            'alias' => 'footer_contact_us',
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // تعریف آیتم‌های منو
        $menuItems = [
            [
                'title' => 'آدرس: ',
                'description' => 'فارس - شیراز - خیابان ارم - کوچه 8',
            ],
            [
                'title' => 'دفتر شیراز: ',
                'description' => '071236234',
            ],
            [
                'title' => 'پشتیبانی 1: ',
                'description' => '02134623',
            ],
        ];

        // درج آیتم‌های منو
        foreach ($menuItems as $index => $item) {
            DB::table('menus')->insert([
                'title' => $item['title']. $item['description'],

                'alias' => 'footer_contact_us_' . ($index + 1),
                'menu_id' => $mainMenuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ایجاد منو اصلی برای نمادها
        $mainMenuId = DB::table('menus')->insertGetId([
            'title' => 'نمادها',
            'alias' => 'namad_menu',
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // تعریف آیتم‌های منو
        $menuItems = [
            [
                'title' => 'enamad',
                'image' => '/images/enamad.png',
                'link' => '#'
            ],
            [
                'title' => 'rezi',
                'image' => '/images/rezi.webp',
                'link' => '#'
            ],
        ];

        // درج آیتم‌های منو
        foreach ($menuItems as $item) {
            DB::table('menus')->insert([
                'title' => $item['title'],
                'icon' => $item['image'],
                'link' => $item['link'],
                'alias' => 'namad_menu_' . strtolower($item['title']),
                'menu_id' => $mainMenuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert menu record
        $mainMenuId = DB::table('menus')->insertGetId([
            'title' => 'دسترسی سریع',
            'alias' => 'quick_access',
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Define menu items
        $menuItems = [
            [
                'title' => 'صفحه ی خانه',
                'link' => '/',
            ],
            [
                'title' => 'ورود/ثبت نام',
                'link' => '/',
            ],
            [
                'title' => 'راهنمای اندازه گیزی',
                'link' => '/',
            ],
            [
                'title' => 'علاقه مندی ها',
                'link' => '/',
            ],
            [
                'title' => 'درباره ما',
                'link' => '/about-us',
            ],
            [
                'title' => 'تماس باما',
                'link' => '/contact-us',
            ],
            [
                'title' => 'وبلاگ',
                'link' => '/blog',
            ],
        ];

        // Insert menu items
        foreach ($menuItems as $index => $item) {
            DB::table('menus')->insert([
                'title' => $item['title'],
                'link' => $item['link'],
                'alias' => 'quick_access_' . ($index + 1),
                'menu_id' => $mainMenuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // ایجاد منو اصلی برای شبکه‌های اجتماعی
        $mainMenuId = DB::table('menus')->insertGetId([
            'title' => 'شبکه‌های اجتماعی',
            'alias' => 'social_media_menu',
            'show_title' => false,
            'icon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // تعریف آیتم‌های منو
        $menuItems = [
            [
                'title' => 'Instagram',
                'icon' => '/images/instagram.png',
                'link' => 'https://www.instagram.com/',
            ],
            [
                'title' => 'Twitter',
                'icon' => '/images/twitter.png',
                'link' => 'https://twitter.com/',
            ],
            [
                'title' => 'LinkedIn',
                'icon' => '/images/linkedin.png',
                'link' => 'https://www.linkedin.com/',
            ],
            [
                'title' => 'WhatsApp',
                'icon' => '/images/whatsapp.png',
                'link' => 'https://web.whatsapp.com/',
            ],
            [
                'title' => 'Telegram',
                'icon' => '/images/telegram.png',
                'link' => 'https://telegram.org/',
            ],
        ];

        // درج آیتم‌های منو
        foreach ($menuItems as $item) {
            DB::table('menus')->insert([
                'title' => $item['title'],
                'icon' => $item['icon'],
                'link' => $item['link'],
                'alias' => 'social_media_menu_' . strtolower($item['title']),
                'menu_id' => $mainMenuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
