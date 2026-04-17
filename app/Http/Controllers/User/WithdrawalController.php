<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\WithdrawalMethod;
use App\Models\Setting;

class WithdrawalController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $methods = WithdrawalMethod::where('is_active', true)->get();
        $minWithdrawal = Setting::get('min_withdrawal', 50);
        $maxWithdrawal = Setting::get('max_withdrawal', 50000);
        return view('user.withdrawal', compact('user', 'methods', 'minWithdrawal', 'maxWithdrawal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount'         => 'required|numeric|min:1',
            'method_id'      => 'required|exists:withdrawal_methods,id',
            'wallet_address' => 'required|string|max:200',
        ]);

        $user   = Auth::user();
        $method = WithdrawalMethod::findOrFail($request->method_id);

        // Check limits
        if ($request->amount < $method->min_amount || $request->amount > $method->max_amount) {
            return back()->with('error', "Amount must be between $" . $method->min_amount . " and $" . $method->max_amount);
        }

        // Check balance
        if ($user->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance.');
        }

        // Calculate fee
        $fee    = ($request->amount * $method->fee_percent) / 100;
        $net    = $request->amount - $fee;

        // Deduct balance immediately (hold)
        $user->decrement('balance', $request->amount);

        Transaction::create([
            'user_id'        => $user->id,
            'type'           => 'withdrawal',
            'amount'         => $request->amount,
            'currency'       => 'USD',
            'wallet_address' => $request->wallet_address,
            'payment_method' => $method->name,
            'status'         => 'pending',
            'note'           => 'Withdrawal via ' . $method->name . ' | Fee: $' . $fee . ' | Net: $' . $net,
        ]);

        return back()->with('success', 'Withdrawal request submitted! Processing within 24 hours.');
    }
}