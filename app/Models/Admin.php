<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'ma_admin',
        'ho_lot',
        'ten',
        'email',
        'password',
        'so_dien_thoai',
        'gioi_tinh',
        'is_master',
        'id_rule',
        'is_block',
    ];
}
