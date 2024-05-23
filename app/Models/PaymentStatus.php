<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentStatus extends Model
{
    use HasFactory;

    protected $table = 'payment_statuses';

    protected $fillable = [
        'name'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'payment_status_id');
    }
}
