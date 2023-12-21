<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use function PHPUnit\Runner\validate;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::all();
        return view('admin/color_list', compact('colors'));
    }


    public function store(Request $request){
        $request->validate([
            'color' => 'required'
        ]);
        $color = new Color();
        $color->color = $request->color;
        $color->status = 1;
        $color->save();
        return redirect()->route('color_index');
    }
    public function show(){
        return view('admin/add_color');
    }
    public function edit(Request $request, $id){
        $color = Color::findOrFail($id);
        return view('admin/edit-color', compact('color'));
    }
    public function update(Request $request, $id){
        $request->validate([
           'color' => 'required'
        ]);
        $color = Color::findOrFail($id);
        $color->color = $request->color;
        $color->save();
        return redirect('admin/color_list')->with('success', 'Color is updated');
    }
    public function delete(Request $request,$id){
        $model=color::find($id);
        $model->delete();
        $request->session()->flash('message','Color deleted');
        return redirect('admin/color_list');
    }

    public function status(Request $request,$status,$id){
        $model=Color::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Color status updated');
        return redirect('admin/color_list');
    }
}
