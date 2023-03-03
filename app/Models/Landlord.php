<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    use HasFactory;
    protected $table = 'landlords';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'password',
        'phone_number',
        'is_open',
    ];
}
