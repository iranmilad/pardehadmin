<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\PostCategory;
use App\Models\ProductImage;
use App\Models\Widget;
use Dotenv\Parser\Value;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\TryCatch;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);

        $this->call(ProductImageSeeder::class);
        $this->call(ArticlesTableSeeder::class);

        $this->call(BannerSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(PostCategorySeeder::class);
        $this->call(PostSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ColorAttributeSeeder::class);
        $this->call(SizeAttributeSeeder::class);
        $this->call(MaterialAttributeSeeder::class);
        $this->call(ModelAttributeSeeder::class);
        $this->call(PriceModelAttributeSeeder::class);
        $this->call(ValueAttributeSeeder::class);
        $this->call(WarrantyAttributeSeeder::class);
        $this->call(WidgetSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(CreditPlanSeeder::class);
        $this->call(CheckSeeder::class);
        $this->call(MemberListTableSeeder::class);
        $this->call(PageSeeder::class);

        // $this->call(CategoriesTableSeeder::class);
        // $this->call(BrandsTableSeeder::class);
        // $this->call(ReviewsTableSeeder::class);
        // $this->call(CommentsTableSeeder::class);
        // $this->call(ProductMenuSeeder::class);
        // $this->call(CategoriesMenuSeeder::class);
        // $this->call(ReviewsTableSeeder::class);
        // $this->call(CommentsTableSeeder::class);
        // $this->call(ProductMenuSeeder::class);
        // $this->call(CategoriesMenuSeeder::class);
        // $this->call(ProductMenuSeeder::class);






        // factory(Product::class, 500)->create();
        // factory(Review::class, 5000)->create();
        // factory(Comment::class, 50)->create();

        // پیدا کردن تمامی فایل‌های موجود در پوشه جاری
        // $files = File::glob(database_path('seeders') . '/*.php');

        // // اضافه کردن هر فایل به Seeder
        // foreach ($files as $file) {
        //     $class = 'Database\\Seeders\\' . pathinfo($file, PATHINFO_FILENAME);

        //     if ($class !== self::class) {
        //         try {
        //             $this->call($class);
        //         }
        //         catch (\Throwable $th) {
        //             continue;
        //         }
        //     }
        // }


    }
}
