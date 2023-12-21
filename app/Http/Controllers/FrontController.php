<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\HomeBanner;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductReview;
use App\Notifications\CodOrderPlacedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Termwind\ValueObjects\pr;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $banners = HomeBanner::all();
        $brands = Brand::all();
        $homeFeaturedProduct = Product::where('status', 1)
            ->where('is_featured', 1)
            ->with('productAttributes.size', 'productAttributes.color')
            ->get();

        $homeTrendingProduct = Product::where('status', 1)
            ->where('is_trending', 1)
            ->with('productAttributes.size', 'productAttributes.color')
            ->get();

        $homeDiscountedProduct = Product::where('status', 1)
            ->where('is_discounted', 1)
            ->with('productAttributes.size', 'productAttributes.color')
            ->get();


        return view('front.index', compact('homeFeaturedProduct', 'homeTrendingProduct', 'homeDiscountedProduct', 'banners', 'brands'));
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('attributes.size', 'attributes.color')
            ->firstOrFail();

        $uniqueSizes = $product->productAttributes->unique('size_id')->pluck('size.size');
        $defaultSize = $uniqueSizes->isNotEmpty() ? $uniqueSizes->first() : null;
//        $defaultColor = null;

//        if ($defaultSize) {
//            $defaultColorAttribute = $product->productAttributes->where('size.size', $defaultSize)->first();
////            if ($defaultColorAttribute && $defaultColorAttribute->attr_image) {
//////                $defaultColor = $defaultColorAttribute->color->color;
////            }
//        }

        $relatedProducts = Product::where('status', 1)
            ->where('slug', '!=', $slug)
            ->where('category_id', $product->category_id)
            ->with('productAttributes.size', 'productAttributes.color')
            ->get();






        $relatedProductColors = [];
        foreach ($relatedProducts as $relatedProduct) {
            $relatedProductColors[$relatedProduct->id] = $relatedProduct->productAttributes->unique('color_id')->pluck('color.color');
        }
//         dd($defaultSize);
        return view('front.product', compact('product', 'relatedProducts', 'uniqueSizes', 'defaultSize', 'relatedProductColors'));
    }







    public function add_to_cart(Request $request)
    {
        $uid = $request->session()->has('FRONT_USER_LOGIN')
            ? $request->session()->get('FRONT_USER_ID')
            : getUserTempId();

        $user_type = $request->session()->has('FRONT_USER_LOGIN') ? "Reg" : "Not-Reg";

        $size_id = $request->post('size_id');
        $color_id = $request->post('color_id');
        $pqty = $request->post('pqty');
        $product_id = $request->post('product_id');

//        dd($product_id, $color_id, $size_id);

        $available_qty = getAvailableQty($product_id, $size_id, $color_id);

        if ($available_qty <= 0) {
            return response()->json([
                'msg' => 'This product is Sold Out.',
                'totalItem' => 0,
                'available_qty' => 0,
            ]);
        }

        if ($pqty > $available_qty) {
            return response()->json([
                'msg' => 'Insufficient quantity! Maximum available quantity is ' . $available_qty,
                'totalItem' => 0,
                'available_qty' => $available_qty,
            ]);
        }

        $product_attr_id = ProductHelper::getProductAttributeId($product_id, $size_id, $color_id);

        $existingCartItem = Cart::where('user_id', $uid)
            ->where('user_type', $user_type)
            ->where('product_id', $product_id)
            ->where('product_attr_id', $product_attr_id)
            ->first();

        if ($existingCartItem) {
            $totalItemsAfterAddition = $existingCartItem->qty + $pqty;

            if ($totalItemsAfterAddition > $available_qty) {
                return response()->json([
                    'msg' => 'Insufficient quantity! Maximum available quantity is ' . $available_qty,
                    'totalItem' => 0,
                    'available_qty' => $available_qty,
                ]);
            }

            $existingCartItem->update(['qty' => $totalItemsAfterAddition]);
            $msg = "updated";
        } else {
            $cart = new Cart();
            $cart->user_id = $uid;
            $cart->user_type = $user_type;
            $cart->product_id = $product_id;
            $cart->product_attr_id = $product_attr_id;
            $cart->qty = $pqty;
            $cart->added_on = now();
            $cart->save();

            $msg = "added";
        }

        $result = Cart::with(['product', 'productAttribute.size', 'productAttribute.color'])
            ->where('user_id', $uid)
            ->where('user_type', $user_type)
            ->select('qty', 'product_id', 'product_attr_id')
            ->get();

        return response()->json([
            'msg' => $msg,
            'data' => $result,
            'totalItem' => count($result),
            'available_qty' => $available_qty,
        ]);
    }



    public function cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');
            $user_type = "Reg";
        } else {
            $uid = getUserTempId();
            $user_type = "Not-Reg";
        }

        $cartItems = Cart::with(['product', 'productAttribute.size', 'productAttribute.color'])
            ->where(['user_id' => $uid])
            ->where(['user_type' => $user_type])
            ->get();
        $size_id = $request->post('size_id');
        $color_id = $request->post('color_id');
        $pqty = $request->post('pqty');
        $product_id = $request->post('product_id');
        $available_qty = getAvailableQty($product_id, $size_id, $color_id);

        return view('front.cart', compact('cartItems', 'available_qty'));
    }

    public function search(Request $request, $str)
    {
        $products = Product::with(['category', 'attributes.size', 'attributes.color'])
            ->where('products.status', 1)
            ->where(function ($query) use ($str) {
                $query->where('name', 'like', "%$str%")
                    ->orWhere('model', 'like', "%$str%")
                    ->orWhere('short_desc', 'like', "%$str%")
                    ->orWhere('description', 'like', "%$str%")
                    ->orWhere('keywords', 'like', "%$str%")
                    ->orWhere('technical_specs', 'like', "%$str%");
            })
            ->distinct()
            ->get();

        return view('front.search', compact('products'));
    }

    public function showProductsByCategory($slug)
    {
        $categoriesLeft = Category::where('status', 1)->get();
        $category = Category::where('category_slug', $slug)->firstOrFail();
        if ($category->products()->where('status', 1)->exists()) {
            $products = $category->products()->where('status', 1)->get();
        } else {
            $products = collect();
        }

        return view('front.categorypage', compact('category', 'products', 'categoriesLeft'));
    }

    public function checkout(Request $request)
    {


        $cartItems = cartCount();
        if ($cartItems->isNotEmpty()) {

            if ($request->session()->has('FRONT_USER_ID')) {
                $uid = $request->session()->get('FRONT_USER_ID');
                $customers = DB::table('customers')->where('id', $uid)->get();
            } else {
            }

            return view('front.checkout', compact('cartItems', 'customers'));
        } else {
            return redirect('/');
        }
    }

    public function coupon_code(Request $request)
    {
        $cartCount = cartCount();
        $couponCode = $request->coupon_code;

        $totalPrice = 0;
        foreach ($cartCount as $item) {
            $totalPrice += $item->productAttribute->price * $item->qty;
        }

        $coupon = Coupon::where('code', $couponCode)->first();

        if ($coupon) {
            if ($coupon->expiration_date && now() > $coupon->expiration_date) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Coupon has expired.',
                ]);
            }

            $discountedTotalPrice = $totalPrice - $coupon->value;

            return response()->json([
                'status' => 'success',
                'msg' => 'Coupon applied successfully.',
                'totalPrice' => $discountedTotalPrice,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'Invalid coupon code.',
            ]);
        }
    }


    public function remove_coupon_code(Request $request)
    {
        $totalPrice = 0;
        $result = DB::table('coupons')
            ->where(['code' => $request->coupon_code])
            ->get();
        $cartCount = cartCount();
        foreach ($cartCount as $list) {
            $totalPrice = $totalPrice + ($list->productAttribute->price * $list->qty);
        }

        return response()->json(['status' => 'success', 'msg' => 'Coupon code removed', 'totalPrice' => $totalPrice]);
    }

    public function place_order(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {


            $uid = $request->session()->get('FRONT_USER_ID');
            $totalPrice = 0;
            $cartCount = cartCount();

            foreach ($cartCount as $list) {
                $totalPrice = $totalPrice + ($list->productAttribute->price * $list->qty);
            }

            $placedStatus = OrderStatus::where('order_status', 'Placed')->first();
            $order_status_id = ($placedStatus) ? $placedStatus->id : 1;

            $payment_status = ($request->payment_type == 'COD') ? 'Pending' : 'Paid';

            $order_data = [
                "customers_id" => $uid,
                "name" => $request->name,
                "email" => $request->email,
                "mobile" => $request->mobile,
                "address" => $request->address,
                "city" => $request->city,
                "state" => $request->state,
                "pincode" => $request->zip,
                "payment_type" => $request->payment_type,
                "payment_status" => $payment_status,
                "total_amount" => $totalPrice,
                "order_status" => $order_status_id,
                "added_on" => now(),
            ];
//            dd($order_data);

            $order_id = DB::table('orders')->insertGetId($order_data);

            if ($order_id > 0) {
                foreach ($cartCount as $list) {
                    $productDetailArr = [
                        'product_id' => $list->product_id,
                        'product_attributes_id' => $list->product_attr_id,
                        'price' => $list->productAttribute->price,
                        'qty' => $list->qty,
                        'orders_id' => $order_id,
                    ];

                    DB::table('orders_details')->insert($productDetailArr);
                    decreaseAvailableQty($list->product_id, $list->product_attr_id, $list->qty);
                }

                $request->session()->put('ORDER_ID', $order_id);

                $status = "success";
                $msg = "Redirecting...";

                if ($request->payment_type == 'COD') {
                    $order = Order::find($order_id);
                    $order->notify(new CodOrderPlacedNotification($order));
                } elseif ($request->payment_type == 'Stripe') {
                    return redirect()->route('stripe', ['totalPrice' => $totalPrice, 'order_id' => $order_id]);
                }
            } else {
                $status = "false";
                $msg = "Please try after sometime";
            }
        } else {
            $status = "false";
            $msg = "Please login to place order";
        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }


    public function order_placed(Request $request)
    {

        if ($request->session()->has('ORDER_ID')) {
            return view('front.order_placed');
        } else {
            return redirect('/');
        }
    }

    public function myorders(Request $request)
    {
        $orders = Order::with('orderStatus')
            ->where('customers_id', $request->session()->get('FRONT_USER_ID'))
            ->get();

        return view('front.my_orders', compact('orders'));
    }

    public function myorderdetail(Request $request, $id)
    {
        $result['orders_details'] =
            DB::table('orders_details')
                ->select('orders.*', 'orders_details.price', 'orders_details.qty', 'products.name as pname', 'product_attributes.image', 'sizes.size', 'colors.color', 'orders_status.order_status')
                ->leftJoin('orders', 'orders.id', '=', 'orders_details.orders_id')
                ->leftJoin('product_attributes', 'product_attributes.id', '=', 'orders_details.product_attributes_id')
                ->leftJoin('products', 'products.id', '=', 'product_attributes.product_id')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attributes.size_id')
                ->leftJoin('orders_status', 'orders_status.id', '=', 'orders.order_status')
                ->leftJoin('colors', 'colors.id', '=', 'product_attributes.color_id')
                ->where(['orders.id' => $id])
                ->where(['orders.customers_id' => $request->session()->get('FRONT_USER_ID')])
                ->get();
        if (!isset($result['orders_details'][0])) {
            return redirect('/');
        }
        return view('front.order_detail', $result);
    }

    public function product_review_process(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');

            $product = Product::find($request->product_id);

            if (!$product) {
                return response()->json(['status' => 'error', 'msg' => 'Invalid product']);
            }

            $productReview = $product->productReviews()->create([
                'rating' => $request->rating,
                'review' => $request->review,
                'status' => 1,
                'customer_id' => $uid,
                'added_on' => now(),
            ]);

            $status = "success";
            $msg = "Thank you for providing your review";
        } else {
            $status = "error";
            $msg = "Please login to submit your review";
        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    public function updateCart(Request $request)
    {
        try {
            $productId = $request->input('product_id');
            $quantity = $request->input('qty');
            $attributeId = $request->input('product_attr_id');
            $action = $request->input('action');

            $cartQuery = DB::table('cart')
                ->where('product_id', $productId)
                ->where('product_attr_id', $attributeId);

            if ($action === 'increase') {
                $cartQuery->increment('qty', 1);
            } elseif ($action === 'decrease') {
                $cartQuery->decrement('qty', 1);
            } else {
                $cartQuery->update(['qty' => $quantity]);
            }

            return response()->json(['msg' => 'Cart updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Error updating cart', 'error' => $e->getMessage()], 500);
        }
    }


    public function getMaxQuantity(Request $request)
    {
        $size_id = $request->post('size_id');
        $color_id = $request->post('color_id');
        $pqty = $request->post('pqty');
        $product_id = $request->post('product_id');

//

        $maxQty = getAvailableQty($product_id, $size_id, $color_id, $pqty);
//        dd($product_id, $color_id, $size_id, $maxQty);
        return response()->json(['qty' => $maxQty]);
    }




}
