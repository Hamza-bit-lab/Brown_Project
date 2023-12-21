@extends('admin.layout')
@section('page_title', 'Add Attributes')
@section('coupon_select', 'active')
@section('container')

    <h2 class="mb10">Add Attributes</h2>
    <form action="{{ route('product.attributes.store', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12" id="product_attr_box">
            <input id="paid" type="hidden" name="paid[]">
            <div class="card" >
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="sku" class="control-label mb-1"> SKU</label>
                                <input id="sku" name="sku" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="col-md-2">
                                <label for="mrp" class="control-label mb-1"> MRP</label>
                                <input id="mrp" name="mrp" type="text" class="form-control" aria-required="true" aria-invalid="false"  required>
                            </div>
                            <div class="col-md-2">
                                <label for="price" class="control-label mb-1"> Price</label>
                                <input id="price" name="price" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="col-md-3">
                                <label for="size_id" class="control-label mb-1"> Size</label>
                                <select id="size_id" name="size_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($sizes as $size)
                                        <option
                                            value="{{ $size->id }}">{{ $size->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="color_id" class="control-label mb-1"> Color</label>
                                <select id="color_id" name="color_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($colors as $color)
                                        <option
                                            value="{{ $color->id }}">{{ $color->color }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="qty" class="control-label mb-1"> Qty</label>
                                <input id="qty" name="qty" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="col-md-4">
                                <label for="attr_image" class="control-label mb-1"> Image</label>
                                <input id="attr_image" name="attr_image" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                            </div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Add</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
