<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin/coupon_list', compact('coupons'));
    }


    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
            'code' => 'required',
            'value' => 'required',
            'type' => 'required',
            'min_amount' => 'required',
            'is_one_time' => 'required'
        ]);
        $coupon = new Coupon();
        $coupon->title = $request->title;
        $coupon->code = $request->code;
        $coupon->value = $request->value;
        $coupon->type = $request->type;
        $coupon->min_amount = $request->min_amount;
        $coupon->is_one_time = $request->is_one_time;
        $coupon->status = 1;
        $coupon->save();
        return redirect()->route('coupon_index');
    }

  public function show(){
        return view('admin/add_coupons');
  }
    public function edit(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin/edit-coupon', compact('coupon'));
    }
  public function update(Request $request, $id){
        $request->validate([
           'title' => 'required',
            'code' => 'required',
            'value' => 'required',
            'type' => 'required',
            'min_amount' => 'required',
            'is_one_time' => 'required'
        ]);
        $coupon = Coupon::findOrFail($id);
        $coupon->title = $request->title;
        $coupon->code = $request->code;
        $coupon->value = $request->value;
        $coupon->type = $request->type;
        $coupon->min_amount = $request->min_amount;
        $coupon->is_one_time = $request->is_one_time;
        $coupon->save();
      return redirect('admin/coupon_list')->with('success', 'Coupon updated successfully!');
  }

    public function delete(Request $request,$id){
        $model=Coupon::find($id);
        $model->delete();
        $request->session()->flash('message','Coupon deleted');
        return redirect('admin/coupon_list');
    }

    public function status(Request $request,$status,$id){
        $model=Coupon::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Coupon status updated');
        return redirect('admin/coupon_list');
    }

}
