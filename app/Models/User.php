<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'country', 'avatar',
        'balance', 'total_invested', 'total_profit',
        'status', 'referral_code', 'referred_by', 'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function investments() {
        return $this->hasMany(Investment::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function kycDocuments() {
        return $this->hasMany(KycDocument::class);
    }

    public function referrer() {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals() {
        return $this->hasMany(User::class, 'referred_by');
    }
}