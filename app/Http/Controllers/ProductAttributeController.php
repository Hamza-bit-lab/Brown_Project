<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {$product = Product::find($id);

        if (!$product) {
        }

        $attributes = $product->productAttributes;
        $sizes = Size::all();
        $colors = Color::all();

        return view('admin.edit-attributes', compact('attributes', 'sizes', 'colors'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $ids = $request->input('ids');

        foreach ($ids as $id) {
            $request->validate([
                'sku' => 'required',
                'mrp' => 'required',
                'price' => 'required',
                'size_id' => 'required|exists:sizes,id',
                'color_id' => 'required|exists:colors,id',
                'qty' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $productAttribute = ProductAttribute::find($id);

            if (!$productAttribute) {
                continue;
            }
            $productAttribute->update([
                'sku' => $request->input('sku')[$id],
                'mrp' => $request->input('mrp')[$id],
                'price' => $request->input('price')[$id],
                'size_id' => $request->input('size_id')[$id],
                'color_id' => $request->input('color_id')[$id],
                'qty' => $request->input('qty')[$id],
            ]);
            if ($request->hasFile('attr_image')) {
                $attrImage = $request->file('attr_image');
                $attrImageName = time() . '_' . $attrImage->getClientOriginalName();
                $attrImage->move(public_path('images'), $attrImageName);
                $productAttribute->attr_image = $attrImageName;
            }

            $productAttribute->save();
        }

        return redirect()->route('product_index');
    }



    public function create($id)
    {
        $product = Product::find($id);

        return view('admin.add-attribute', compact('product'));
    }
    public function store(Request $request, $id){
        $request->validate([
            'color_id' => ['required', 'exists:colors,id'],
            'size_id' => ['required', 'exists:sizes,id'],
            'sku' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'mrp' => 'required'
        ]);

        $attribute = new ProductAttribute();
        $attribute->product_id = $id;
        $attribute->color_id = $request->color_id;
        $attribute->size_id = $request->size_id;
        $attribute->sku = $request->sku;
        $attribute->qty = $request->qty;
        $attribute->price = $request->price;
        $attribute->mrp = $request->mrp;

        if ($request->hasFile('attr_image')) {
            $attrImage = $request->file('attr_image');
            $attrImageName = time() . '_' . $attrImage->getClientOriginalName();
            $attrImage->move(public_path('images'), $attrImageName);
            $attribute->attr_image = $attrImageName;
        }

        $attribute->save();

        return redirect()->route('product_index');
    }

    public function delete(Request $request,$id){
        $model=ProductAttribute::find($id);
        $model->delete();
        $request->session()->flash('message','Attribute deleted');
        return redirect()->back();
    }

}
