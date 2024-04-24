<?php

namespace App\Models;

use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'dob',
        'phone',
        'account_type',
        'company_name',
        'country',
        'city',
        'full_address'
    ];

    protected $casts = [
        'account_type' => AccountType::class,
        'dob' => 'date:d-m-Y',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
