@extends('admin.layout')
@section('page_title', 'Add Banner')
@section('banner_select', 'active')


@section('container')
    <h1 class="mb10">Add Banner</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Add Banner</div>
                        <div class="card-body">
                            <form action="{{ route('store_banner') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="btn_text" class="control-label mb-1">Button Text</label>
                                            <input id="btn_text" name="btn_text" type="text" class="form-control"
                                                   aria-required="true" aria-invalid="false">
                                            <span class="text-danger">
                                        @error('btn_text')
                                                {{ $message }}
                                                @enderror
                                    </span>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="btn_link" class="control-label mb-1">Button Link</label>
                                            <input id="btn_link" name="btn_link" type="text"
                                                   class="form-control cc-name valid" data-val="true"
                                                   aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                            <span class="text-danger">
                                        @error('btn_link')
                                                {{ $message }}
                                                @enderror
                                    </span>
                                        </div>
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
