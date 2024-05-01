<?php

namespace App\Models;

use App\Enums\RoleType;
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
        'company_name', // if in users table role == 'owner'
        'country',
        'city',
    ];

    protected $casts = [
        'dob' => 'date:d-m-Y',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
