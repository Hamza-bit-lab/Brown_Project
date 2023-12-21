@extends('admin.layout')
@section('page_title', 'Edit Banner')



@section('container')
    <h1 class="mb10">Edit Banner</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Edit Banner</div>
                        <div class="card-body">
                            <form action="{{ route('banner.update', ['id' => $banner->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="btn_text" class="control-label mb-1">Button Text</label>
                                            <input id="btn_text" value="{{ $banner->btn_text }}"
                                                   name="btn_text" type="text" class="form-control">
                                            <span class="text-danger">
                                        @error('btn_text')
                                                {{ $message }}
                                                @enderror
                                    </span>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="btn_link" class="control-label mb-1">Button Link</label>
                                            <input id="btn_link" value="{{ $banner->btn_link }}"
                                                   name="btn_link" type="text"
                                                   class="form-control cc-name valid" data-val="true"
                                                   aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                            <span class="text-danger">
                                        @error('btn_link')
                                                {{ $message }}
                                                @enderror
                                    </span>
                                            <span class="help-block field-validation-valid" data-valmsg-for="cc-name"
                                                  data-valmsg-replace="true"></span>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="image" class="control-label mb-1"> Image</label>
                                            <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                                            @error('image')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror

                                            @if($banner->image!='')
                                                <a href="{{asset('images/'.$banner->image)}}" target="_blank"><img width="35px" src="{{asset('images/'.$banner->image)}}"/></a>
                                            @endif
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

@endsection

