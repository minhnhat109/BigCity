<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MomoPayment extends Model
{
    use HasFactory;

    protected $table = "momo_payments";

    protected $fillable = [
        'room_id',
        'user_id',
        'partner_code',
        'order_id',
        'amount',
        'order_info',
        'order_type',
        'trans_id',
        'pay_type',
        'code_cart',
    ];
}
