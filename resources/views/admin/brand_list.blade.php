@extends('admin.layout')
@section('page_title', 'Brand List')
@section('brand_select', 'active')

@section('container')
    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <h1 class="mb10">Brand List</h1>
    <a href="{{ route('show_add_brand') }}" type="button" class="btn btn-success mb10">Add Brand</a>
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Brand Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td><img src="{{ asset('images/'.$brand->image) }}" width="35px" height="35px"></td>
                    <td><a href="{{ route('brand.edit', ['id' => $brand->id]) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ url('admin/brand/delete/' . $brand->id) }}" class="btn btn-danger">Delete</a>
                        @if($brand->status == 1)
                            <a href="{{ route('admin.brand.status', ['status' => 0, 'id' => $brand->id]) }}"
                               class="btn btn-primary">Active</a>
                        @elseif($brand->status == 0)
                            <a href="{{ route('admin.brand.status', ['status' => 1, 'id' => $brand->id]) }}"
                               class="btn btn-secondary">Inactive</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
