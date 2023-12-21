<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Notifications\CodOrderPlacedNotification;
use App\Notifications\StripeOrderPlacedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripe(Request $request)
    {
        // Retrieve form data from the request
        $formData = $request->all();
//        dd($formData);

        // Check if 'totalPrice' key exists in the form data
        if (!isset($formData['totalPrice'])) {
            return back()->withInput()->withErrors(['error' => 'Total price is missing.']);
        }

        // Calculate total price
        $calculatedTotal = 0;
        $cartCount = cartCount();

        foreach ($cartCount as $list) {
            $calculatedTotal += ($list->productAttribute->price * $list->qty);
        }

        // Validate the total price from the form data
        $totalPrice = (float)$formData['totalPrice'];

        // Compare total prices with a small tolerance due to potential floating-point precision issues
        $tolerance = 0.01; // You can adjust this value based on your needs

        if (abs($calculatedTotal - $totalPrice) > $tolerance) {
            return back()->withInput()->withErrors(['error' => 'Invalid total amount.']);
        }

        // Get order details
        $order_id = session('ORDER_ID');
        $order = Order::find($order_id);

        return view('front.stripe', [
            'totalPrice' => $calculatedTotal,
            'order' => $order,
        ]);
    }





    /**
     * Success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $calculatedTotal = 0;
        $cartCount = cartCount();

        foreach ($cartCount as $list) {
            $calculatedTotal += ($list->productAttribute->price * $list->qty);
        }

        $totalPrice = $request->input('totalPrice');
        $stripeAmount = max(1, round($calculatedTotal * 100));

        if ($calculatedTotal != $totalPrice) {
            Session::flash('error', 'Payment failed. Invalid total amount.');
            return back()->withInput();
        }

        try {
            $stripeCharge = Stripe\Charge::create([
                "amount" => $stripeAmount,
                "currency" => "PKR",
                "source" => $request->stripeToken,
                "description" => "Test payment from Laravel."
            ]);

            if ($stripeCharge->status === 'succeeded') {
                $this->place_order($request, 'Stripe');

                Session::flash('success', 'Payment and order placement successful!');
                return redirect()->route('order.placed');
            } else {
                Session::flash('error', 'Payment failed. Please try again.');
                return back()->withInput();
            }
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            \Log::error($e->getMessage());

            Session::flash('error', 'Payment failed. Please try again.');
            return back()->withInput();
        }
    }

    public function place_order(Request $request, $payment_type)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $coupon_value = 0;

            if ($request->coupon_code != '') {
                $arr = coupon_code($request->coupon_code);
                $arr = json_decode($arr, true);

                if ($arr['status'] == 'success') {
                    $coupon_value = $arr['coupon_code_value'];
                } else {
                    // Handle coupon validation failure in the calling controller
                    return response()->json(['status' => 'false', 'msg' => $arr['msg']]);
                }
            }

            $uid = $request->session()->get('FRONT_USER_ID');
            $totalPrice = 0;
            $cartCount = cartCount();

            foreach ($cartCount as $list) {
                $totalPrice = $totalPrice + ($list->productAttribute->price * $list->qty);
            }

            $placedStatus = OrderStatus::where('order_status', 'Placed')->first();
            $order_status_id = ($placedStatus) ? $placedStatus->id : 1;

            $payment_status = ($payment_type == 'Stripe') ? 'Paid' : 'Pending';

            $order_data = [
                "customers_id" => $uid,
                "name" => $request->name,
                "email" => $request->email,
                "mobile" => $request->mobile,
                "address" => $request->address,
                "city" => $request->city,
                "state" => $request->state,
                "pincode" => $request->zip,
                "coupon_code" => $request->coupon_code,
                "coupon_value" => $coupon_value,
                "payment_type" => $payment_type, // Use $payment_type here
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

                // Send notification for Stripe orders
                if ($payment_type == 'Stripe') {
                    $order = Order::find($order_id);
                    $order->notify(new StripeOrderPlacedNotification($order));
                }

                $status = "true";
                $msg = "Order placed successfully!";
            } else {
                $status = "false";
                $msg = "Please try after sometime";
            }
        } else {
            $status = "false";
            $msg = "Please login to place order";
        }

        // Handle the response in the calling controller
        return response()->json(['status' => $status, 'msg' => $msg]);
    }





}
