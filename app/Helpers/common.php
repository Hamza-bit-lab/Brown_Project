<?php

use App\Models\Cart;
use App\Models\ProductAttribute;
use http\Client\Request;
use Illuminate\Support\Facades\DB;

function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
}

function getTopNavCat()
{
    $result = DB::table('categories')
        ->where(['status' => 1])
        ->get();
    $arr = [];
    foreach ($result as $row) {
        $arr[$row->id]['category_name'] = $row->category_name;
        $arr[$row->id]['parent_id'] = $row->parent_category_id;
        $arr[$row->id]['category_slug'] = $row->category_slug;
    }
    $str = buildTreeView($arr, 0);
    return $str;
}

$html = '';
function buildTreeView($arr, $parent, $level = 0, $prelevel = -1)
{
    global $html;
    foreach ($arr as $id => $data) {
        if ($parent == $data['parent_id']) {
            if ($level > $prelevel) {
                if ($html == '') {
                    $html .= '<ul class="nav navbar-nav">';
                } else {
                    $html .= '<ul class="dropdown-menu">';
                }

            }
            if ($level == $prelevel) {
                $html .= '</li>';
            }
            $html .= '<li><a href="' . url('categories/' . $data['category_slug']) . '">' . $data['category_name'] . '<span class="caret"></span></a>';
            if ($level > $prelevel) {
                $prelevel = $level;
            }
            $level++;
            buildTreeView($arr, $id, $level, $prelevel);
            $level--;
        }
    }
    if ($level == $prelevel) {
        $html .= '</li></ul>';
    }
    return $html;
}

function getUserTempId()
{
    if (!session()->has('USER_TEMP_ID')) {
        $rand = rand(111111111, 999999999);
        session()->put('USER_TEMP_ID', $rand);
        return $rand;
    } else {
        return session()->get('USER_TEMP_ID');
    }
}

    function cartCount()
{
    if (session()->has('FRONT_USER_LOGIN')) {
        $uid = session()->get('FRONT_USER_ID');
        $user_type = "Reg";
    } else {
        $uid = getUserTempId();
        $user_type = "Not-Reg";
    }

    $cartItems = Cart::with(['product.productAttributes.size', 'product.productAttributes.color'])
        ->where('user_id', $uid)
        ->where('user_type', $user_type)
        ->get(['qty', 'product_id', 'product_attr_id']);

//    $cartItems = cartCount();
//    prx($cartItems);
//    die();
    return $cartItems;
}
function coupon_code($coupon_code){
    $totalPrice = 0;

    $result = DB::table('coupons')
        ->where(['code' => $coupon_code])
        ->get();

    if (isset($result[0])) {
        $value = $result[0]->value;
        $type = $result[0]->type;
        $cartCount = cartCount();

        foreach ($cartCount as $list) {
            $totalPrice = $totalPrice+($list->productAttribute->price*$list->qty);
        }

        if ($result[0]->status == 1) {
            if ($result[0]->is_one_time == 1) {
                $status = "error";
                $msg = "Coupon code already used";
            } else {
                $min_amount = $result[0]->min_amount;

                if ($min_amount > 0) {
                    if ($min_amount < $totalPrice) {
                        $status = "success";
                        $msg = "Coupon code applied";
                    } else {
                        $status = "error";
                        $msg = "Cart amount must be greater than $min_amount";
                    }
                } else {
                    $status = "success";
                    $msg = "Coupon code applied";
                }
            }
        } else {
            $status = "error";
            $msg = "Coupon code deactivated";
        }
    } else {
        $status = "error";
        $msg = "Please enter a valid coupon code";
    }

    $coupon_code_value = 0;
    if ($status == 'success') {
        if ($type == 'Value') {
            $coupon_code_value=$value;
            $totalPrice -= $value;
        } elseif ($type == 'Per') {
            $discount = ($value / 100) * $totalPrice;
            $totalPrice -= round($discount);
            $coupon_code_value=$discount;

        }
        return json_encode(['status' => $status, 'msg' => $msg, 'totalPrice' => $totalPrice, 'coupon_code_value' =>$coupon_code_value]);

    }
}


function getAvailableQty($product_id, $size_id, $color_id)
{
    $productAttribute = ProductAttribute::where('product_id', $product_id)
        ->whereHas('size', function ($query) use ($size_id) {
            $query->where('size', $size_id);
        })
        ->whereHas('color', function ($query) use ($color_id) {
            $query->where('color', $color_id);
        })
        ->first();

//    dd($productAttribute);

    return $productAttribute ? $productAttribute->qty : 0;
}

function decreaseAvailableQty($product_id, $product_attr_id, $quantity)
{
    $productAttr = ProductAttribute::find($product_attr_id);

    if ($productAttr) {
        $productAttr->update([
            'qty' => max(0, $productAttr->qty - $quantity),
        ]);
    }
}
  function getProductAttributeId($product_id, $size_id, $color_id)
    {
        // Implement logic to fetch product attribute ID based on size and color
        // You may need to query your database or another source to get this information
        // Replace the following line with your actual logic
        $productAttr = ProductAttribute::where('product_id', $product_id)
            ->where('size_id', $size_id)
            ->where('color_id', $color_id)
            ->first();

        return $productAttr ? $productAttr->id : null;
    }
?>


