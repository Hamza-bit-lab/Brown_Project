<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name', 'category_slug', 'parent_category_id', 'category_image', 'status'];

    public static function latest()
    {
    }

//    public function cate()
//    {
//        $categories = Category::pluck('category_name', 'id');
//
//        return view('admin/edit-product', compact('categories'));
//    }

//    public function productAttributes()
//    {
//        return $this->hasManyThrough(ProductAttribute::class, Product::class);
//    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
