<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name',          'value' => 'CryptoInvest'],
            ['key' => 'site_email',         'value' => 'support@cryptoinvest.com'],
            ['key' => 'site_phone',         'value' => '+1 234 567 8900'],
            ['key' => 'site_currency',      'value' => 'USD'],
            ['key' => 'site_currency_symbol', 'value' => '$'],
            ['key' => 'min_deposit',        'value' => '100'],
            ['key' => 'max_deposit',        'value' => '100000'],
            ['key' => 'min_withdrawal',     'value' => '50'],
            ['key' => 'max_withdrawal',     'value' => '50000'],
            ['key' => 'withdrawal_fee',     'value' => '2'],
            ['key' => 'referral_bonus',     'value' => '5'],
            ['key' => 'site_logo',          'value' => ''],
            ['key' => 'site_favicon',       'value' => ''],
            ['key' => 'maintenance_mode',   'value' => '0'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}