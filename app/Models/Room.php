<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table  = 'rooms';
    protected $fillable = [
        'id_category',
        'name',
        'slug_name',
        'address',
        'id_landlord',
        'is_open',
        'image',
        'price',
        'short_description',
        'detail_description',
    ];
}
