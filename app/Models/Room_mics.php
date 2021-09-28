<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_mics extends Model
{
    use HasFactory;



    
    protected $fillable = [
        'id',
        'mic_number',
        'status',
        'is_locked',
        'room_owner_id',
        'mic_user_id' ,
        'room_id'
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
    
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',

    ];
}
