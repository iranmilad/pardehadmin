<?php

namespace Database\Seeders;

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
        $permissions = [
            ['title' => 'ویرایشگر نوشته', 'name' => 'editor_post'],
            ['title' => 'ویرایشگر نوشته های دیگران', 'name' => 'editor_others_post'],
            ['title' => 'حذف نوشته ها', 'name' => 'delete_post'],
            ['title' => 'انتشار نوشته ها', 'name' => 'publish_post'],
            ['title' => 'ویرایش نوشته های منتشر شده', 'name' => 'edit_published_post'],
            ['title' => 'ویرایشگر برگه', 'name' => 'editor_page'],
            ['title' => 'ویرایشگر برگه های دیگران', 'name' => 'editor_others_page'],
            ['title' => 'حذف برگه ها', 'name' => 'delete_page'],
            ['title' => 'انتشار برگه ها', 'name' => 'publish_page'],
            ['title' => 'ویرایش برگه های منتشر شده', 'name' => 'edit_published_page'],
            ['title' => 'ویرایشگر محصولات', 'name' => 'editor_product'],
            ['title' => 'ویرایشگر محصولات دیگران', 'name' => 'editor_others_product'],
            ['title' => 'حذف محصولات', 'name' => 'delete_product'],
            ['title' => 'انتشار محصولات', 'name' => 'publish_product'],
            ['title' => 'ویرایش محصولات منتشر شده', 'name' => 'edit_published_product'],
            ['title' => 'ویرایش ویژگی ها', 'name' => 'edit_features'],
            ['title' => 'ویرایش دسته بندی ها', 'name' => 'edit_categories'],
            ['title' => 'ویرایش دیدگاه ها', 'name' => 'edit_comments'],
            ['title' => 'ویرایش پیکربندی ها', 'name' => 'edit_configurations'],
            ['title' => 'افزودن تخفیف', 'name' => 'add_discount'],
            ['title' => 'ویرایشگر تخفیف های دیگران', 'name' => 'editor_others_discount'],
            ['title' => 'حذف تخفیف ها', 'name' => 'delete_discount'],
            ['title' => 'انتشار تخفیف ها', 'name' => 'publish_discount'],
            ['title' => 'ویرایش تخفیف های منتشر شده', 'name' => 'edit_published_discount'],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
