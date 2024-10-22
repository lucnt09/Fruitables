<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'mobile',
        'email',
        'address',
        'city',
        'notes',
        'status',
        'total',
        'payment_method',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function OrderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
