<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\Investment;
use App\Models\Transaction;

class InvestmentController extends Controller
{
    public function index()
    {
        $user        = Auth::user();
        $investments = Investment::where('user_id', $user->id)->latest()->paginate(10);
        return view('user.investments.index', compact('investments'));
    }

    public function crypto()
    {
        $packages = Package::where('category', 'crypto')->where('is_active', true)->get();
        return view('user.investments.crypto', compact('packages'));
    }

    public function stocks()
    {
        $packages = Package::where('category', 'stocks')->where('is_active', true)->get();
        return view('user.investments.stocks', compact('packages'));
    }

    public function realestate()
    {
        $packages = Package::where('category', 'realestate')->where('is_active', true)->get();
        return view('user.investments.realestate', compact('packages'));
    }

    public function buy(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'amount'     => 'required|numeric|min:1',
        ]);

        $user    = Auth::user();
        $package = Package::findOrFail($request->package_id);

        // Check amount is within package range
        if ($request->amount < $package->min_amount || $request->amount > $package->max_amount) {
            return back()->with('error', "Amount must be between $" . $package->min_amount . " and $" . $package->max_amount);
        }

        // Check user balance
        if ($user->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance. Please deposit first.');
        }

        // Deduct balance
        $user->decrement('balance', $request->amount);
        $user->increment('total_invested', $request->amount);

        // Create investment
        Investment::create([
            'user_id'      => $user->id,
            'package_id'   => $package->id,
            'category'     => $package->category,
            'amount'       => $request->amount,
            'roi_percent'  => $package->roi_percent,
            'duration_days'=> $package->duration_days,
            'starts_at'    => now(),
            'expires_at'   => now()->addDays($package->duration_days),
            'status'       => 'active',
        ]);

        // Log transaction
        Transaction::create([
            'user_id'        => $user->id,
            'type'           => 'deposit',
            'category'       => $package->category,
            'amount'         => $request->amount,
            'currency'       => 'USD',
            'payment_method' => 'balance',
            'status'         => 'approved',
            'note'           => 'Investment in ' . $package->name,
        ]);

        return back()->with('success', 'Investment in ' . $package->name . ' started successfully!');
    }
}