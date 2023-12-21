<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeBannerController extends Controller
{
    public function index()
    {
        $banners = HomeBanner::all();
        return view('admin/banner_list', compact('banners'));

    }

    public function store(Request $request){
        $request->validate([
            'image'=>'required|mimes:jpeg,jpg,png',
            'btn_text' => 'required',
            'btn_link' => 'required'
        ]);
        $banner = new HomeBanner();
        $banner->btn_text = $request->btn_text;
        $banner->btn_link = $request->btn_link;
        $banner->status = 1;
        if ($request->has('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
            $banner->image = $request->file('image')->getClientOriginalName();
        }
        $banner->save();
        return redirect()->route('banner_index');
    }

    public function show(){
        return view('admin/add_banner');
    }

    public function edit(Request $request, $id){
        $banner = HomeBanner::findOrFail($id);
        return view('admin/edit-banner', compact('banner'));
    }

    public function update(Request $request, $id)
    {
         $request->validate([
            'btn_text' => 'required',
            'btn_link' => 'required',
        ]);
        $banner = HomeBanner::findOrFail($id);
        $banner->btn_text = $request->btn_text;
        $banner->btn_link = $request->btn_link;
        $banner->save();
        return redirect('admin/banner_list')->with('success', 'Banner updated successfully!');
    }

    public function delete(Request $request,$id){
        $model=HomeBanner::find($id);
        $model->delete();
        $request->session()->flash('message','Banner deleted');
        return redirect('admin/banner_list');
    }

    public function status(Request $request,$status,$id){
        $model=HomeBanner::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Banner status updated');
        return redirect('admin/banner_list');
    }
}
