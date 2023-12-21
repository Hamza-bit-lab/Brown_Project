<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
//use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Color;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function Ramsey\Collection\Map\get;
//use Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin/product_list', compact('products'));
    }

    public function show(){
        return view('admin/add_product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => 'required',
            'slug' => 'required',
            'model' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'technical_specs' => 'required',
            'uses' => 'required',
            'warranty' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_promo' => 'required|in:yes,no',
            'is_featured' => 'required|in:yes,no',
            'is_trending' => 'required|in:yes,no',
            'is_discounted' => 'required|in:yes,no',
            'sku' => 'required',
//            'mrp' => 'required',
            'price' => 'required',
            'size_id' => 'required',
            'color_id' => 'required',
            'qty' => 'required',
            'attr_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->model = $request->model;
        $product->short_desc = $request->short_desc;
        $product->description = $request->description;
        $product->keywords = $request->keywords;
        $product->technical_specs = $request->technical_specs;
        $product->uses = $request->uses;
        $product->warranty = $request->warranty;
        $product->is_promo = $request->input('is_promo');
        $product->is_featured = $request->input('is_featured');
        $product->is_trending = $request->input('is_trending');
        $product->is_discounted = $request->input('is_discounted');
        $product->status = 1;
        $product->lead_time = 1;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
            $product->image = $filename;
        }

        $product->save();
        $productAttribute = new ProductAttribute([
            'sku' => $request->sku,
//            'mrp' => $request->mrp,
            'price' => $request->price,
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'qty' => $request->qty,
        ]);

        if ($request->hasFile('attr_image')) {
            $attrImage = $request->file('attr_image');
            $attrImageName = time() . '_' . $attrImage->getClientOriginalName();
            $attrImage->move(public_path('images'), $attrImageName);
            $productAttribute->attr_image = $attrImageName;
        }

        $product->attributes()->save($productAttribute);

        return redirect()->route('product_index');
    }
    public function edit(Request $request, $id){
        $product = Product::findOrFail($id);
        return view('admin/edit-product', compact('product'));
    }
    public function update(Request $request, $id){
        $request->validate([
           'name' => 'required',
            'slug' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'model' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'technical_specs' => 'required',
            'uses' => 'required',
            'warranty' => 'required',
            'is_promo' => 'required',
            'is_featured' => 'required',
            'is_trending' => 'required',
            'is_discounted' => 'required',

        ]);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->model = $request->model;
        $product->short_desc = $request->short_desc;
        $product->description = $request->description;
        $product->keywords = $request->keywords;
        $product->technical_specs = $request->technical_specs;
        $product->uses = $request->uses;
        $product->warranty = $request->warranty;
        $product->is_promo = $request->is_promo;
        $product->is_featured = $request->is_featured;
        $product->is_trending = $request->is_trending;
        $product->is_discounted = $request->is_discounted;
        $product->save();


//      $color =  Color::findOrFail($id);
//      $color->color = $request->color;
//      $color->save();
//
//      $size = new Size();
//      $size->size = $request->size;
//      $size->save();


      return redirect('admin/product_list')->with('success', 'Product updated successfully!');
  }

    public function delete(Request $request,$id){
        $model=Product::find($id);
        $model->delete();
        $request->session()->flash('message','Product deleted');
        return redirect('admin/product_list');
    }



    public function status(Request $request,$status,$id){
        $model=Product::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Product status updated');
        return redirect('admin/product_list');
    }


}
