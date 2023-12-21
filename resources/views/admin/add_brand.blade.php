@extends('admin.layout')
@section('page_title', 'Add Brand')
@section('brand_select', 'active')


@section('container')
    <h1 class="mb10">Add Brand</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Add Brand</div>
                        <div class="card-body">
                            <form action="{{ route('store_brand') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Brand Name</label>
                                    <input id="name" name="name" type="text" class="form-control"
                                           aria-required="true" aria-invalid="false">
                                    <span class="text-danger">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="image" class="control-label mb-1">Image</label>
                                        <input id="image" name="image" type="file" class="form-control cc-name valid">
                                    <span class="text-danger">
                                        @error('image')
                                        {{ $message }}
                                        @enderror
                                    </span>
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

@endsection
