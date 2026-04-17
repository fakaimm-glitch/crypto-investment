<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WithdrawalMethod;

class WithdrawalMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            ['name' => 'Bitcoin (BTC)',   'min_amount' => 50,  'max_amount' => 50000, 'fee_percent' => 1],
            ['name' => 'Ethereum (ETH)',  'min_amount' => 50,  'max_amount' => 50000, 'fee_percent' => 1],
            ['name' => 'USDT (TRC20)',    'min_amount' => 50,  'max_amount' => 50000, 'fee_percent' => 1],
            ['name' => 'USDT (ERC20)',    'min_amount' => 50,  'max_amount' => 50000, 'fee_percent' => 2],
            ['name' => 'Bank Transfer',  'min_amount' => 100, 'max_amount' => 50000, 'fee_percent' => 3],
            ['name' => 'PayPal',         'min_amount' => 50,  'max_amount' => 10000, 'fee_percent' => 2],
        ];

        foreach ($methods as $method) {
            WithdrawalMethod::create(array_merge($method, ['is_active' => true]));
        }
    }
}