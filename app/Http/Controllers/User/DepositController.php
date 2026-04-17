<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Setting;

class DepositController extends Controller
{
    public function index()
    {
        $settings = [
            'min_deposit' => Setting::get('min_deposit', 100),
            'max_deposit' => Setting::get('max_deposit', 100000),
            'btc_wallet'  => Setting::get('btc_wallet', ''),
            'eth_wallet'  => Setting::get('eth_wallet', ''),
            'usdt_wallet' => Setting::get('usdt_wallet', ''),
        ];
        return view('user.deposit', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount'         => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'txn_hash'       => 'nullable|string|max:200',
            'proof'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $minDeposit = Setting::get('min_deposit', 100);
        $maxDeposit = Setting::get('max_deposit', 100000);

        if ($request->amount < $minDeposit || $request->amount > $maxDeposit) {
            return back()->with('error', "Deposit must be between $$minDeposit and $$maxDeposit");
        }

        // Handle proof upload
        $proofPath = null;
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('proofs', 'public');
        }

        Transaction::create([
            'user_id'        => $user->id,
            'type'           => 'deposit',
            'amount'         => $request->amount,
            'currency'       => 'USD',
            'payment_method' => $request->payment_method,
            'txn_hash'       => $request->txn_hash,
            'proof'          => $proofPath,
            'status'         => 'pending',
            'note'           => 'Deposit via ' . $request->payment_method,
        ]);

        return back()->with('success', 'Deposit submitted! Awaiting admin approval.');
    }
}