<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name'     => 'Super Admin',
            'email'    => 'admin@cryptoinvest.com',
            'password' => bcrypt('admin123456'),
            'role'     => 'superadmin',
            'is_active' => true,
        ]);
    }
}