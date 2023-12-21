<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'orders';

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'orders_id', 'id');
    }
}
