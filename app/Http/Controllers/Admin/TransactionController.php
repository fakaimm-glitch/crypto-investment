<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('user');

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }

        $transactions = $query->latest()->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function approve($id)
    {
        $transaction = Transaction::with('user')->findOrFail($id);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaction already processed.');
        }

        $transaction->update(['status' => 'approved']);

        // Credit user balance on deposit approval
        if ($transaction->type === 'deposit') {
            $transaction->user->increment('balance', $transaction->amount);
        }

        return back()->with('success', 'Transaction approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $transaction = Transaction::with('user')->findOrFail($id);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaction already processed.');
        }

        $transaction->update([
            'status' => 'rejected',
            'note'   => $request->note ?? 'Rejected by admin',
        ]);

        // Refund balance on withdrawal rejection
        if ($transaction->type === 'withdrawal') {
            $transaction->user->increment('balance', $transaction->amount);
        }

        return back()->with('success', 'Transaction rejected and balance refunded.');
    }
}