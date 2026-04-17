<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            // Crypto Packages
            ['name' => 'Crypto Starter', 'category' => 'crypto', 'min_amount' => 100, 'max_amount' => 999, 'roi_percent' => 5, 'duration_days' => 30, 'description' => 'Entry level crypto investment plan'],
            ['name' => 'Crypto Pro', 'category' => 'crypto', 'min_amount' => 1000, 'max_amount' => 4999, 'roi_percent' => 10, 'duration_days' => 60, 'description' => 'Professional crypto investment plan'],
            ['name' => 'Crypto Elite', 'category' => 'crypto', 'min_amount' => 5000, 'max_amount' => 50000, 'roi_percent' => 15, 'duration_days' => 90, 'description' => 'Elite crypto investment plan'],

            // Stocks Packages
            ['name' => 'Stocks Starter', 'category' => 'stocks', 'min_amount' => 200, 'max_amount' => 1999, 'roi_percent' => 6, 'duration_days' => 30, 'description' => 'Entry level stocks investment plan'],
            ['name' => 'Stocks Pro', 'category' => 'stocks', 'min_amount' => 2000, 'max_amount' => 9999, 'roi_percent' => 12, 'duration_days' => 60, 'description' => 'Professional stocks investment plan'],
            ['name' => 'Stocks Elite', 'category' => 'stocks', 'min_amount' => 10000, 'max_amount' => 100000, 'roi_percent' => 18, 'duration_days' => 90, 'description' => 'Elite stocks investment plan'],

            // Real Estate Packages
            ['name' => 'Realty Starter', 'category' => 'realestate', 'min_amount' => 500, 'max_amount' => 4999, 'roi_percent' => 8, 'duration_days' => 60, 'description' => 'Entry level real estate investment plan'],
            ['name' => 'Realty Pro', 'category' => 'realestate', 'min_amount' => 5000, 'max_amount' => 24999, 'roi_percent' => 14, 'duration_days' => 90, 'description' => 'Professional real estate investment plan'],
            ['name' => 'Realty Elite', 'category' => 'realestate', 'min_amount' => 25000, 'max_amount' => 500000, 'roi_percent' => 20, 'duration_days' => 180, 'description' => 'Elite real estate investment plan'],
        ];

        foreach ($packages as $package) {
            Package::create(array_merge($package, ['is_active' => true]));
        }
    }
}