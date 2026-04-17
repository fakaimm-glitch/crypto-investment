<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name', 'category', 'description', 'min_amount',
        'max_amount', 'roi_percent', 'duration_days',
        'icon', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function investments() {
        return $this->hasMany(Investment::class);
    }
}