<?php

namespace App\Http\Controllers;

use App\Events\OrderStatusChanged;
use App\Models\Customer;
use App\Models\Order;
use App\Notifications\OrderStatusChangedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::with('orderStatus')
            ->get();
        return view('admin.orders', compact('orders'));
    }

    public function order_detail(Request $request ,$id){
        $result['orders_details']=
            DB::table('orders_details')
                ->select('orders.*','orders_details.price','orders_details.qty','products.name as pname','product_attributes.attr_image','sizes.size','colors.color','orders_status.order_status')
                ->leftJoin('orders','orders.id','=','orders_details.orders_id')
                ->leftJoin('product_attributes','product_attributes.id','=','orders_details.product_attributes_id')
                ->leftJoin('products','products.id','=','product_attributes.product_id')
                ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
                ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
                ->leftJoin('colors','colors.id','=','product_attributes.color_id')
                ->where(['orders.id'=>$id])
                ->get();
        $result['order_status']=DB::table('orders_status')->get();
        $result['payment_status'] = ['Pending', 'Success', 'Fail'];
        return view('admin.order_details',$result);
    }

    public function update_payment_status(Request $request, $status, $id)
    {
        DB::table('orders')->where(['id' => $id])->update(['payment_status' => $status]);

        $order = Order::find($id);
        return redirect('/admin/order_detail/'.$id);
    }

    public function update_order_status(Request $request, $status, $id)
    {DB::table('orders')->where(['id' => $id])->update(['order_status' => $status]);

        $order = DB::table('orders')->find($id);
        $customer = Customer::find($order->customers_id);
        $customer->notify(new OrderStatusChangedNotification($order));
        return redirect('/admin/order_detail/' . $id);
    }

    public function update_track_detail(Request $request,$id)
    {
        $track_details=$request->post('track_details');
        DB::table('orders')
            ->where(['id'=>$id])
            ->update(['track_details'=>$track_details]);
        return redirect('/admin/order_detail/'.$id);
    }

    public function reviews(Request $request, $id){
        return view('admin.reviews');
    }

}
