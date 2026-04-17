<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\WithdrawalMethod;
use App\Models\Package;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        $withdrawalMethods = WithdrawalMethod::all();
        $packages = Package::all();
        return view('admin.settings.index', compact('settings', 'withdrawalMethods', 'packages'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'       => 'required|string|max:100',
            'site_email'      => 'required|email',
            'site_phone'      => 'nullable|string|max:20',
            'min_deposit'     => 'required|numeric|min:1',
            'max_deposit'     => 'required|numeric|min:1',
            'min_withdrawal'  => 'required|numeric|min:1',
            'max_withdrawal'  => 'required|numeric|min:1',
            'referral_bonus'  => 'required|numeric|min:0',
            'withdrawal_fee'  => 'required|numeric|min:0',
            'btc_wallet'      => 'nullable|string|max:200',
            'eth_wallet'      => 'nullable|string|max:200',
            'usdt_wallet'     => 'nullable|string|max:200',
        ]);

        $keys = [
            'site_name', 'site_email', 'site_phone',
            'min_deposit', 'max_deposit',
            'min_withdrawal', 'max_withdrawal',
            'referral_bonus', 'withdrawal_fee',
            'btc_wallet', 'eth_wallet', 'usdt_wallet',
        ];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key));
        }

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $path);
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}