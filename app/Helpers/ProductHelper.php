<?php


// app/Helpers/ProductHelper.php

namespace App\Helpers;

use App\Models\ProductAttribute;

class ProductHelper
{
public static function getProductAttributeId($product_id, $size_id, $color_id)
{
$productAttribute = ProductAttribute::where('product_id', $product_id)
->whereHas('size', function ($query) use ($size_id) {
$query->where('size', $size_id);
})
->whereHas('color', function ($query) use ($color_id) {
$query->where('color', $color_id);
})
->first();

return $productAttribute ? $productAttribute->id : null;
}
}
?>
