<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Investment;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user        = User::findOrFail($id);
        $transactions= Transaction::where('user_id', $id)->latest()->paginate(10);
        $investments = Investment::where('user_id', $id)->latest()->get();

        $stats = [
            'total_deposited'   => Transaction::where('user_id', $id)
                                        ->where('type', 'deposit')
                                        ->where('status', 'approved')
                                        ->sum('amount'),
            'total_withdrawn'   => Transaction::where('user_id', $id)
                                        ->where('type', 'withdrawal')
                                        ->where('status', 'approved')
                                        ->sum('amount'),
            'active_investments'=> Investment::where('user_id', $id)
                                        ->where('status', 'active')
                                        ->count(),
        ];

        return view('admin.users.show', compact('user', 'transactions', 'investments', 'stats'));
    }

    public function suspend($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'suspended']);
        return back()->with('success', 'User suspended successfully.');
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'active']);
        return back()->with('success', 'User activated successfully.');
    }

    public function adjustBalance(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'type'   => 'required|in:add,deduct',
            'note'   => 'nullable|string|max:200',
        ]);

        $user = User::findOrFail($id);

        if ($request->type === 'add') {
            $user->increment('balance', $request->amount);
            $txnType = 'profit';
        } else {
            if ($user->balance < $request->amount) {
                return back()->with('error', 'User does not have sufficient balance.');
            }
            $user->decrement('balance', $request->amount);
            $txnType = 'withdrawal';
        }

        Transaction::create([
            'user_id' => $user->id,
            'type'    => $txnType,
            'amount'  => $request->amount,
            'currency'=> 'USD',
            'status'  => 'approved',
            'note'    => $request->note ?? 'Admin balance adjustment',
        ]);

        return back()->with('success', 'Balance adjusted successfully.');
    }
}