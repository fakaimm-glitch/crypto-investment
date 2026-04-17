<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone'    => 'nullable|string|max:20',
            'country'  => 'nullable|string|max:100',
        ]);

        $referralCode = strtoupper(Str::random(8));
        $referredBy   = null;

        if ($request->referral_code) {
            $referrer   = User::where('referral_code', $request->referral_code)->first();
            $referredBy = $referrer ? $referrer->id : null;
        }

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'phone'         => $request->phone,
            'country'       => $request->country,
            'referral_code' => $referralCode,
            'referred_by'   => $referredBy,
            'balance'       => 0,
        ]);

        Auth::login($user);
        return redirect()->route('user.dashboard');
    }
}