@extends('admin.layout')
@section('page_title', 'Add Size')
@section('size_select', 'active')


@section('container')
    <h1 class="mb10">Add Size</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form action="{{ route('store_size') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="size" class="control-label mb-1">Size</label>
                                    <input id="size" name="size" type="text" class="form-control"
                                           aria-required="true" aria-invalid="false">
                                    <span class="text-danger">
                                        @error('size')
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
