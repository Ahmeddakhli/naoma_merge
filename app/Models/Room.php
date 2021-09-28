<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'room_name',
        'room_desc',
        'room_owner',
        'room_background'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mics()
    {
        return $this->hasMany(Room_Mics::class);
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',

    ];
}
