<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // If your table name is not 'orders', specify it:
    // protected $table = 'my_orders';

    // Mass assignable fields (for create/update)
    protected $fillable = [
        'user_id',
        'pickup_address',
        'delivery_address',
        'distance',
        'weight',
        'price',
    ];
}
