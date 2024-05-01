<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'hotel_id',
        'type_id',
        'description',
        'count',
        'price_per_night',
        'is_available'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'type_id');
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'room_image', 'room_id', 'image_id');
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}
