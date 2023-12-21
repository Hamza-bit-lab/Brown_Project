<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin/brand_list' ,compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
            'image'=>'required|mimes:jpeg,jpg,png',
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->status = 1;
        if ($request->has('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
            $brand->image = $request->file('image')->getClientOriginalName();
        }
        $brand->save();

        return redirect()->route('brand_index');
    }
    public function show(){
        return view('admin/add_brand');
    }
    public function edit(Request $request, $id){
        $brand = Brand::findOrFail($id);
        return view('admin/edit-brand', compact('brand'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->save();
        return redirect('admin/brand_list')->with('success', 'Brand updated successfully!');
    }

    public function delete(Request $request,$id){
        $model=brand::find($id);
        $model->delete();
        $request->session()->flash('message','Brand deleted');
        return redirect('admin/brand_list');
    }

    public function status(Request $request,$status,$id){
        $model=Brand::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Brand status updated');
        return redirect('admin/brand_list');
    }
}
