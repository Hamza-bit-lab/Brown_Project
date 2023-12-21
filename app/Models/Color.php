<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{

    use HasFactory;
    protected $guarded = [];
    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'color_id');
    }
}
