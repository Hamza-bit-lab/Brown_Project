@extends('admin.layout')
@section('page_title', 'Edit Product')
@section('product_select', 'active')


@section('container')
    <h1 class="mb10">Edit Product</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Edit Product</div>
                        <div class="card-body">
                            <form action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Name</label>
                                    <input id="name" name="name" value="{{ $product->name }}" type="text" class="form-control">
                                    <span class="text-danger">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Slug</label>
                                    <input id="slug" name="slug" value="{{ $product->slug }}" type="text" class="form-control">
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
                                                <option value="">Select</option>
                                                @php
                                                     $selectedBrandId = $product->brand_id;
                                                @endphp
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" @if($brand->id == $selectedBrandId) selected @endif>
                                                        {{ $brand->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="category_id" class="control-label mb-1">Category</label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option value="">Select</option>
                                                @php
                                                    $selectedCategoryId = $product->category_id ?? null;
                                                @endphp
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @if($category->id == $selectedCategoryId) selected @endif>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="model" class="control-label mb-1">Model</label>
                                            <input id="model" name="model" value="{{ $product->model }}" type="text"
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
                                    <textarea name="short_desc" id="short_desc" rows="10" cols="80"> {{ $product->short_desc }} </textarea>
                                    <span class="text-danger">
                                        @error('short_desc')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea name="description" id="description" rows="10" cols="80"> {{ $product->description }} </textarea>
                                    <span class="text-danger">
                                        @error('description')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="keywords" class="control-label mb-1">Keywords</label>
                                    <input id="keywords" name="keywords" value="{{ $product->keywords }}" type="text"
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
                                    <textarea name="technical_specs" id="technical_specs" rows="10" cols="80"> {{ $product->technical_specs }} </textarea>
                                    <span class="text-danger">
                                        @error('technical_specs')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="uses" class="control-label mb-1">Uses</label>
                                    <input id="uses" name="uses" value="{{ $product->uses }}" type="text"
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
                                    <input id="warranty" name="warranty" value="{{ $product->warranty }}" type="text"
                                           class="form-control cc-name valid" data-val="true"
                                           aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="text-danger">
                                        @error('warranty')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="is_promo" class="control-label mb-1"> Is Promo	</label>
                                            <select id="is_promo" name="is_promo" class="form-control" required>
                                                @if($product->is_promo=='yes')
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                @else
                                                    <option value="yes">Yes</option>
                                                    <option value="no" selected>No</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_featured" class="control-label mb-1"> Is Featured	</label>
                                            <select id="is_featured" name="is_featured" class="form-control" required>
                                                @if($product->is_featured=='yes')
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                @else
                                                    <option value="yes">Yes</option>
                                                    <option value="no" selected>No</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_trending" class="control-label mb-1"> Is Trending</label>
                                            <select id="is_trending" name="is_trending" class="form-control" required>
                                                @if($product->is_trending=='yes')
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                @else
                                                    <option value="yes">Yes</option>
                                                    <option value="no" selected>No</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_discounted" class="control-label mb-1"> Is Featured	</label>
                                            <select id="is_discounted" name="is_discounted" class="form-control" required>
                                                @if($product->is_discounted=='yes')
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                @else
                                                    <option value="yes">Yes</option>
                                                    <option value="no" selected>No</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Update</span>
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

@endsection
