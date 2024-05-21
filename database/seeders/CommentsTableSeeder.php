<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ایجاد چند نظر نمونه
        $comment1 =Comment::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'user_id' => 1,
            'post_id' => 13,
            'text' => 'این یک نظر تستی است.',
        ]);



        $comment2 =Comment::create([
            'name' => 'Alice Smith',
            'email' => 'alice@example.com',
            'user_id' => 1,
            'post_id' => 14,
            'text' => 'نظر سوم برای پست دوم.',
        ]);

        if ($comment1) {
            $comment2->parent_comment_id = $comment1->id;
            $comment2->save();
        }

        Comment::create([
            'name' => 'Alice Smith',
            'email' => 'alice@example.com',
            'user_id' => 1, // اطمینان حاصل کنید که کاربر معتبر وجود دارد
            'post_id' => 14, // اطمینان حاصل کنید که پست معتبر وجود دارد
            'text' => 'نظر سوم برای پست دوم.',
        ]);

    }
}
