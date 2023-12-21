<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use Notifiable;

    use HasFactory;
    protected $fillable = ['name', 'email', 'mobile', 'password'];

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class, 'customer_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'customers_id');
    }
}
