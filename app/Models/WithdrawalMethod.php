<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawalMethod extends Model
{
    protected $fillable = [
        'name', 'icon', 'min_amount',
        'max_amount', 'fee_percent', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}