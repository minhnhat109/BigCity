<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;

    protected $table  = 'room_categories';
    protected $fillable = [
        'name_room_category',
        'slug_room_category',
        'is_open',
    ];
}
