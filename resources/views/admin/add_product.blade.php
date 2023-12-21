@extends('admin.layout')
@section('page_title', 'Add Product')
@section('product_select', 'active')


@section('container')
    <h1 class="mb10">Add Product</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Add Product</div>
                        <div class="card-body">
                            <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Name</label>
                                    <input id="name" name="name" type="text" class="form-control">
                                    <span class="text-danger">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Slug</label>
                                    <input id="slug" name="slug" type="text" class="form-control">
                                    <span class="text-danger">
                                        @error('slug')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="brand_id" class="control-label mb-1">Brand</label>
                                            <select class="form-control" name="brand_id" id="brand_id">
                                                <option>Select</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="category_id" class="control-label mb-1">Category</label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option>Select</option>
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1">Model</label>
                                            <input id="model" name="model" type="text"
                                                   class="form-control cc-name valid" data-val="true"
                                                   aria-required="true" aria-invalid="false"
                                                   aria-describedby="cc-name-error">
                                            <span class="text-danger">
                                        @error('model')
                                                {{ $message }}
                                                @enderror
                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="short_desc">Short Description:</label>
                                    <textarea name="short_desc" id="short_desc" rows="10" cols="80"></textarea>
                                    <span class="text-danger">
                                        @error('short_desc')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea name="description" id="description" rows="10" cols="80"></textarea>
                                    <span class="text-danger">
                                        @error('description')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="keywords" class="control-label mb-1">Keywords</label>
                                    <input id="keywords" name="keywords" type="text"
                                           class="form-control cc-name valid" data-val="true"
                                           aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="text-danger">
                                        @error('keywords')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="technical_specs">Technical Specifications:</label>
                                    <textarea name="technical_specs" id="technical_specs" rows="10" cols="80"></textarea>
                                    <span class="text-danger">
                                        @error('technical_specs')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="uses" class="control-label mb-1">Uses</label>
                                    <input id="uses" name="uses" type="text"
                                           class="form-control cc-name valid" data-val="true"
                                           aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="text-danger">
                                        @error('uses')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="warranty" class="control-label mb-1">Warranty</label>
                                    <input id="warranty" name="warranty" type="text"
                                           class="form-control cc-name valid" data-val="true"
                                           aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="text-danger">
                                        @error('warranty')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="image" class="control-label mb-1">Image</label>
                                    <input id="image" name="image" type="file"
                                           class="form-control cc-name valid" data-val="true"
                                           aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="text-danger">
                                        @error('image')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="model" class="control-label mb-1"> IS Promo	</label>
                                            <select id="is_promo" name="is_promo">
                                                <option value="yes">YES</option>
                                                <option value="no">NO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="model" class="control-label mb-1"> IS Featured	</label>
                                            <select id="is_featured" name="is_featured">
                                                <option value="yes">YES</option>
                                                <option value="no">NO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="model" class="control-label mb-1"> IS Trending	</label>
                                            <select name="is_trending" id="is_trending">
                                                <option value="yes">YES</option>
                                                <option value="no">NO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="model" class="control-label mb-1"> IS Discounted	</label>
                                            <select name="is_discounted" id="is_discounted">
                                                <option value="yes">YES</option>
                                                <option value="no">NO</option>
                                            </select>
                                        </div>
                                    </div><br><br>
                                    <h2>Attributes</h2>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="sku" class="control-label mb-1"> SKU</label>
                                            <input id="sku" name="sku" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="mrp" class="control-label mb-1"> MRP</label>
                                            <input id="mrp" name="mrp" type="text" class="form-control" aria-required="true" aria-invalid="false" >
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
                                            <input id="attr_image" name="attr_image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Submit</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        CKEDITOR.replace('description');
        CKEDITOR.replace('short_desc');
        CKEDITOR.replace('technical_specs');
    </script>
@endsection
