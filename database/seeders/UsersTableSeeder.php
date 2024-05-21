<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->delete();
        User::create([
            'first_name' => 'میلاد',
            'last_name' => 'کاظمی',
            'email' => 'kazemi.milad@gmail.com',
            'mobile' => '09193753006',
            'password' => Hash::make("11111111"),
            'remember_token' => Str::random(10),
            'role_id' => 2
        ]);
    }
}
