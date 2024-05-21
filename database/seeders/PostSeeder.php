<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $randomUser = User::inRandomOrder()->firstOrFail();

        $content='
        <p class="mt-3">
        برای همه‌ی ما در زندگی پیش می‌آید که روزهای بد و استرس‌زا را تجربه ‌کنیم، و تنها دلمان
        بخواهد در رخت‌‌خوابمان غلت بزنیم و یک فیلم خوب تماشا کنیم، تا در خود غرقمان کند و تمام
        رخوت و سختی آن روز بد را با خود ببرد. خوشبختانه، همیشه برای دور کردن افکار بد و حال خراب
        فیلم‌هایی وجود دارند که این احساس گرم و ساعاتی سرگرم‌کننده را فراهم کنند. فراتر از هر
        اثر سینمایی، از استاپ‌موشن‌های کمپانی آردمن گرفته تا کاتالوگ گسترده‌ی انیمیشن‌های کلاسیک
        پیکسار، چیزی در مورد فیلم‌های انیمیشن وجود دارد که برای این هدف عالی است. در این مطلب ۱۰
        انیمیشن جذاب و تماشایی را نام بردیم که حسابی سرحالتان می‌آورند.
    </p>
    <div class="image_dotter">
        <img src="/images/auth.jpg" />
        <span style="top: 5%;left: 5%;" data-id="1"></span>
        <span style="top: 20%;left: 30%;" data-id="2"></span>
        <span style="top: 50%;left: 50%;" data-id="3"></span>
    </div>
    <p class="mt-4">
        تقریبا برای هر مناسبتی یک فیلم انیمیشن وجود دارد؛ تعطیلات خاص، برای سنین مختلف و
        ماجراهای متنوعی که هر روز در دنیا اتفاق می‌افتد تنها نوک کوه یخی است که از داستان‌های
        جذاب انیمیشنی می‌توانیم انتظار داشته باشیم. برخی از انیمیشن‌ها موضوعات صادقانه و دلپذیری
        را در مورد دنیای واقعی ارائه می‌دهند، در حالی که برخی دیگر به اندازه‌ی کافی همه‌جانبه
        هستند تا شما را به سمت خود جلب کنند و از مشکلاتتان رها کنند. اگر در حال جستجوی چیزی
        هستید تا روز بدتان را در یک چشم به هم زدن در خود حل کند، ادامه‌ی مطلب را از دست ندهید.
    </p>
        ';


        // Sample data for posts
        $posts = [
            [
                'title' => 'برای تولید محتوا چه کاری انجام دهیم',
                'content' => $content,
                'slug' => 'content_1',
                'image' => 'images/blog/1.webp',
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'keywords' => 'محتوا، تولید، وبلاگ',
                'published' => true,
                'post_category_id' => 1, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],
            [
                'title' => 'برای تولید محتوا چه کاری انجام دهیم',
                'content' => $content,
                'slug' => 'content_2',
                'image' => 'images/blog/1.webp',
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'keywords' => 'محتوا، تولید، وبلاگ',
                'published' => true,
                'post_category_id' => 1, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],
            [
                'title' => 'برای تولید محتوا چه کاری انجام دهیم',
                'content' => $content,
                'slug' => 'content_3',
                'image' => 'images/blog/1.webp',
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'keywords' => 'محتوا، تولید، وبلاگ',
                'published' => true,
                'post_category_id' => 1, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],
            [
                'title' => 'برای تولید محتوا چه کاری انجام دهیم',
                'content' => $content,
                'slug' => 'content_4',
                'image' => 'images/blog/1.webp',
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'keywords' => 'محتوا، تولید، وبلاگ',
                'published' => true,
                'post_category_id' => 1, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],

            [
                'title' => 'برای تولید محتوا چه کاری انجام دهیم',
                'content' => $content,
                'slug' => 'content_5',
                'image' => 'images/blog/1.webp',
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'keywords' => 'محتوا، تولید، وبلاگ',
                'published' => true,
                'post_category_id' => 1, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],
            [
                'title' => 'برای تولید محتوا چه کاری انجام دهیم',
                'content' => $content,
                'slug' => 'content_6',
                'image' => 'images/blog/1.webp',
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'keywords' => 'محتوا، تولید، وبلاگ',
                'published' => true,
                'post_category_id' => 1, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],
            [
                'title' => 'برای تولید محتوا چه کاری انجام دهیم',
                'content' => $content,
                'slug' => 'content_7',
                'image' => 'images/blog/1.webp',
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'keywords' => 'محتوا، تولید، وبلاگ',
                'published' => true,
                'post_category_id' => 1, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],

            [
                'title' => 'چگونه پرده ها می توانند یک اتاق خواب دنج ایجاد کنند؟',
                'image' => 'images/auth.jpg',
                'content' => $content,
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'slug' => 'content_8',
                'post_category_id' => 1, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],
            [
                'title' => 'آیا پرده متناسب با رنگ دیوار باید انتخاب شود؟',
                'image' => 'images/auth2.jpg',
                'content' => $content,
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'slug' => 'content_9',
                'post_category_id' => 1, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],
            [
                'title' => 'چرا پرده تیره طرفدار بیشتری برای دکوراسیون مدرن دارد!؟',
                'image' => 'images/auth3.jpg',
                'content' => $content,
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'slug' => 'content_10',
                'post_category_id' => 2, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],
            [
                'title' => 'چرا پرده تیره طرفدار بیشتری برای دکوراسیون مدرن دارد!؟',
                'image' => 'images/auth3.jpg',
                'content' => $content,
                'summary' => 'خلاصه مطلب اینجا قرار می‌گیرد',
                'slug' => 'content_11',
                'post_category_id' => 1, // Replace with the actual category ID
                'user_id' => $randomUser->id,
            ],
            // Add more sample data entries as needed
        ];

        // Insert sample data into the database
        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
