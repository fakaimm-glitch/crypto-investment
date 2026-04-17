<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Investment;

class AdminDashboardController extends Controller
{
    public function showLogin()
    {
        if (Session::has('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Invalid email or password.');
        }

        if (!$admin->is_active) {
            return back()->with('error', 'Your admin account is disabled.');
        }

        Session::put('admin', [
            'id'    => $admin->id,
            'name'  => $admin->name,
            'email' => $admin->email,
            'role'  => $admin->role,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Session::forget('admin');
        return redirect()->route('admin.login');
    }

    public function index()
    {
        $stats = [
            'total_users'        => User::count(),
            'active_users'       => User::where('status', 'active')->count(),
            'suspended_users'    => User::where('status', 'suspended')->count(),
            'total_deposits'     => Transaction::where('type', 'deposit')
                                        ->where('status', 'approved')->sum('amount'),
            'total_withdrawals'  => Transaction::where('type', 'withdrawal')
                                        ->where('status', 'approved')->sum('amount'),
            'pending_deposits'   => Transaction::where('type', 'deposit')
                                        ->where('status', 'pending')->count(),
            'pending_withdrawals'=> Transaction::where('type', 'withdrawal')
                                        ->where('status', 'pending')->count(),
            'total_investments'  => Investment::where('status', 'active')->sum('amount'),
            'total_profit_paid'  => Investment::sum('profit_earned'),
        ];

        $recentUsers        = User::latest()->take(5)->get();
        $recentTransactions = Transaction::with('user')->latest()->take(10)->get();
        $pendingTransactions= Transaction::with('user')
                                ->where('status', 'pending')
                                ->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentUsers',
            'recentTransactions',
            'pendingTransactions'
        ));
    }
}