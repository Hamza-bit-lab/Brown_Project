<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('admin/size_list', compact('sizes'));
    }


    public function store(Request $request)
    {
        $request->validate([
           'size' => 'required'
        ]);
        $size = new Size();
        $size->size = $request->size;
        $size->status = 1;
        $size->save();
        return redirect()->route('size_index');
    }
    public function edit(Request $request, $id)
    {
        $size = Size::findOrFail($id);
        return view('admin/edit-size', compact('size'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'size' => 'required',
        ]);
        $coupon = Size::findOrFail($id);
        $coupon->size = $request->size;

        $coupon->save();
        return redirect('admin/size_list')->with('success', 'Size updated successfully!');
    }

    public function show(){
        return view('admin/add_size');
    }

    public function delete(Request $request,$id){
        $model=Size::find($id);
        $model->delete();
        $request->session()->flash('message','Size deleted');
        return redirect('admin/size_list');
    }

    public function status(Request $request,$status,$id){
        $model=Size::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Size status updated');
        return redirect('admin/size_list');
    }

}
