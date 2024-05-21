<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\MemberList;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ایجاد دسته‌ها
        $categories = [
            'خیاطان' => 'توضیحات دسته خیاطان',
            'طراحان' => 'توضیحات دسته طراحان',
            'نصابان' => 'توضیحات دسته نصابان',
            'تامین کننده' => 'توضیحات دسته تامین کننده',
            'مدیریت' => 'توضیحات دسته مدیریت',
            'خدمات بعد از فروش' => 'توضیحات دسته خدمات بعد از فروش',
        ];

        foreach ($categories as $title => $description) {
            // ایجاد دسته
            $memberList = MemberList::create([
                'title' => $title,
                'description' => $description,
            ]);

            // یک یوزر تصادفی را انتخاب کنید
            $randomUser = User::inRandomOrder()->first();

            // اضافه کردن یک یوزر به هر دسته
            $memberList->users()->attach($randomUser);
        }
    }
}
