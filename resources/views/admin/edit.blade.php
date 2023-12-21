@extends('admin.layout')
@section('title', 'Edit Category')



@section('container')
    <h1 class="mb10">Edit Category</h1>
    <div class="row m-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Edit Category</div>
                        <div class="card-body">
                            <form action="{{ route('update-category', [$category->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div class="row">
                                <div class="col-md-4">
                                    <label for="category_name" class="control-label mb-1">Category Name</label>
                                    <input id="category_name" value="{{ $category->category_name }}"
                                           name="category_name" type="text" class="form-control">
                                    <span class="text-danger">
                                        @error('category_name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label for="parent_category_id" class="control-label mb-1">Parent Category</label>
                                    <select id="parent_category_id" name="parent_category_id" class="form-control" required>
                                        <option value="">Select Categories</option>
                                        @foreach($categories as $category)
                                            <option selected value="{{$category->id}}">
                                                {{$category->category_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="category_slug" class="control-label mb-1">Slug</label>
                                    <input id="category_slug" value="{{ $category->category_slug }}"
                                           name="category_slug" type="text"
                                           class="form-control cc-name valid" data-val="true"
                                           aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                    <span class="text-danger">
                                        @error('category_slug')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name"
                                          data-valmsg-replace="true"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="image" class="control-label mb-1"> Image</label>
                                    <input id="category_image" name="category_image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                                    @error('category_image')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror

                                    @if($category->category_image!='')
                                        <a href="{{asset('images/'.$category->category_image)}}" target="_blank"><img width="35px" src="{{asset('images/'.$category->category_image)}}"/></a>
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

