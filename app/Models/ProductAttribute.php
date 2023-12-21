<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
    public function featuredAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_attr_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_attributes_id', 'id');
    }
}
