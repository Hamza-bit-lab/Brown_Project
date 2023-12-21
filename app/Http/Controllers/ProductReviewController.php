<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{

    public function index()
    {
        $reviews = ProductReview::with(['customer:id,name', 'product:id,name'])
            ->orderBy('added_on', 'desc')
            ->get();

        return view('admin.product_reviews', compact('reviews'));
    }



    public function update_product_review_status(Request $request,$status,$id)
    {
        DB::table('product_reviews')
            ->where(['id'=>$id])
            ->update(['status'=>$status]);
        return redirect('/admin/product_reviews/');
    }
}
