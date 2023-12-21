<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

//    public function category()
//    {
//        return $this->belongsTo(Category::class, 'slug', 'category_slug');
//    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
    public function productReviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

}
