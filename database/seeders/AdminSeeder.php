<?php

namespace Database\Seeders;

use App\Constant\RoleConstant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'role_id' => RoleConstant::ROLE_ID[RoleConstant::ADMIN_ROLE]
        ];

        User::updateOrCreate(['email' => $user['email']], $user);
    }
}
