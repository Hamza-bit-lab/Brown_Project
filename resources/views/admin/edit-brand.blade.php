@extends('admin.layout')
@section('page_title', 'Edit Brand')
@section('brand_select', 'active')


@section('container')
    <h1 class="mb10">Edit Brand</h1>
{{--    <a href="{{ route('admin/brand_list') }}" type="button" class="btn btn-success mb10">Back</a>--}}
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            <form action="{{ route('brand.update', ['id' => $brand->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Brand Name</label>
                                    <input id="name" name="name" value="{{ $brand->name }}" type="text" class="form-control"
                                           aria-required="true" aria-invalid="false">
                                    <span class="text-danger">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="image" class="control-label mb-1">Image</label>
                                    <input id="image" name="image" type="file"
                                           class="form-control cc-name valid" data-val="true"
                                           aria-required="true" value="{{ $brand->image }}" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="text-danger">
                                        @error('image')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name"
                                          data-valmsg-replace="true"></span>
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

@endsection
