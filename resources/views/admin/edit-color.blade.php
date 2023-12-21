@extends('admin.layout')
@section('title', 'Edit Color')



@section('container')
    <h1 class="mb10">Edit Color</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Edit Color</div>
                        <div class="card-body">
                            <form action="{{ route('color.update', ['id' => $color->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="color" class="control-label mb-1">Color</label>
                                    <input id="color" value="{{ $color->color }}"
                                           name="color" type="text" class="form-control">
                                    <span class="text-danger">
                                        @error('color')
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
