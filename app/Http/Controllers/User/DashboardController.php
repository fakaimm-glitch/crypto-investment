<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;
use App\Models\Investment;
use App\Models\Package;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'balance'        => $user->balance,
            'total_invested' => $user->total_invested,
            'total_profit'   => $user->total_profit,
            'referrals'      => $user->referrals()->count(),
        ];

        $recentTransactions = Transaction::where('user_id', $user->id)
            ->latest()->take(5)->get();

        $activeInvestments = Investment::where('user_id', $user->id)
            ->where('status', 'active')->get();

        return view('user.dashboard', compact('user', 'stats', 'recentTransactions', 'activeInvestments'));
    }

    public function transactions()
    {
        $user         = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->latest()->paginate(15);
        return view('user.transactions', compact('transactions'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $data = [
            'name'    => $request->name,
            'phone'   => $request->phone,
            'country' => $request->country,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6|confirmed',
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return back()->with('success', 'Profile updated successfully.');
    }
}