@extends('admin.layout')
@section('title', 'Edit Category')



@section('container')
    <h1 class="mb10">Edit Size</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Edit Size</div>
                        <div class="card-body">
                            <form action="{{ route('size.update', [$size->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="size" class="control-label mb-1">Size</label>
                                    <input id="size" value="{{ $size->size }}"
                                           name="size" type="text" class="form-control">
                                    <span class="text-danger">
                                        @error('size')
                                        {{ $message }}
                                        @enderror
                                    </span>
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
