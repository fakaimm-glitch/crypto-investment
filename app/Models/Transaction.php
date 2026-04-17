<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'type', 'category', 'amount', 'currency',
        'wallet_address', 'payment_method', 'txn_hash',
        'proof', 'status', 'note',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}