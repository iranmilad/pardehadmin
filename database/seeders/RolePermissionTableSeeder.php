<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolePermissions = [
            // برای نقش Admin
            ['role_id' => 1, 'permission_id' => 1, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 2, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 3, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 4, 'access_code' => '2'],
            // بقیه دسترسی‌ها برای نقش Admin
            ['role_id' => 1, 'permission_id' => 5, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 6, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 7, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 8, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 9, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 10, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 11, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 12, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 13, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 14, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 15, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 16, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 17, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 18, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 19, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 20, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 21, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 22, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 23, 'access_code' => '2'],
            ['role_id' => 1, 'permission_id' => 24, 'access_code' => '2'],

            // برای نقش Editor
            ['role_id' => 2, 'permission_id' => 1, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 3, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 4, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 5, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 6, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 8, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 9, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 10, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 11, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 13, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 14, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 15, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 16, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 17, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 18, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 19, 'access_code' => '1'],
            ['role_id' => 2, 'permission_id' => 20, 'access_code' => '1'],

            // برای نقش Author
            ['role_id' => 3, 'permission_id' => 1, 'access_code' => '1'],
            ['role_id' => 3, 'permission_id' => 4, 'access_code' => '1'],
            ['role_id' => 3, 'permission_id' => 6, 'access_code' => '1'],
            ['role_id' => 3, 'permission_id' => 9, 'access_code' => '1'],
            ['role_id' => 3, 'permission_id' => 10, 'access_code' => '1'],
            ['role_id' => 3, 'permission_id' => 11, 'access_code' => '1'],
            ['role_id' => 3, 'permission_id' => 14, 'access_code' => '1'],
            ['role_id' => 3, 'permission_id' => 15, 'access_code' => '1'],
            ['role_id' => 3, 'permission_id' => 16, 'access_code' => '1'],
        ];

        DB::table('role_permission')->insert($rolePermissions);
    }
}
