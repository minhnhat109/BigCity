<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Landlord extends Authenticatable
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
