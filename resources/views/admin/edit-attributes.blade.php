@extends('admin.layout')
@section('page_title', 'Edit Attributes')
@section('product_select', 'active')
@section('container')
    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <h2 class="mb10">Edit Attributes</h2>
    <form action="{{ route('attribute.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @foreach($attributes as $attribute)
            <div class="col-lg-12" id="product_attr_box">
                <input type="hidden" name="ids[]" value="{{ $attribute->id }}">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="sku" class="control-label mb-1">SKU</label>
                                    <input name="sku[{{ $attribute->id }}]" type="text" value="{{ $attribute->sku }}" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="mrp" class="control-label mb-1">MRP</label>
                                    <input name="mrp[{{ $attribute->id }}]" type="text" value="{{ $attribute->mrp }}" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="price" class="control-label mb-1">Price</label>
                                    <input name="price[{{ $attribute->id }}]" type="text" value="{{ $attribute->price }}" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="size_id" class="control-label mb-1">Size</label>
                                    <select name="size_id[{{ $attribute->id }}]" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach($sizes as $size)
                                            <option value="{{ $size->id }}" {{ $size->id == $attribute->size_id ? 'selected' : '' }}>
                                                {{ $size->size }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="color_id" class="control-label mb-1">Color</label>
                                    <select name="color_id[{{ $attribute->id }}]" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->id }}" {{ $color->id == $attribute->color_id ? 'selected' : '' }}>
                                                {{ $color->color }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="qty" class="control-label mb-1">Qty</label>
                                    <input name="qty[{{ $attribute->id }}]" type="text" value="{{ $attribute->qty }}" class="form-control aa-cart-quantity" data-available-qty="{{ $attribute->available_qty }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="attr_image" class="control-label mb-1">Image</label>
                                    <input name="attr_image[{{ $attribute->id }}]" type="file" class="form-control">
                                    @if($attribute->attr_image)
                                        <img src="{{ asset('images/' . $attribute->attr_image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 100px;">
                                    @endif
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label mb-1">Actions</label>
                                    <a href="{{ url('admin/attribute/delete/' . $attribute->id) }}" class="btn btn-danger delete-btn" @if(count($attributes) === 1) style="display:none;" @endif>Delete</a>
                                </div>
                            </div>
                            <span>
                                @if(count($attributes) === 1)

                                    One attribute is compulsory.
                                @endif
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            <span id="payment-button-amount">Update</span>
        </button>
    </form>
{{--    <script>--}}
{{--        function removeAttribute(button) {--}}
{{--            // Remove the closest '.product_attr_box' ancestor of the button--}}
{{--            var attributeElement = button.closest('.product_attr_box');--}}

{{--            if (attributeElement) {--}}
{{--                // Remove the HTML element--}}
{{--                attributeElement.remove();--}}

{{--                // Update the form data (optional)--}}
{{--                updateFormData();--}}
{{--            } else {--}}
{{--                console.error('Attribute element not found.');--}}
{{--            }--}}
{{--        }--}}

{{--        function updateFormData() {--}}
{{--            // Implement logic to update the form data if needed--}}
{{--            console.log('Form data updated');--}}
{{--        }--}}
{{--    </script>--}}

@endsection
