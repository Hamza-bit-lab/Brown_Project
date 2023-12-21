@extends('admin/layout')
@section('page_title','Product List')
@section('product_select','active')
@section('container')
    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <h1 class="mb10">Product</h1>
    <a href="{{ route('show_add_product') }}">
        <button type="button" class="btn btn-success">
            Add Product
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->slug}}</td>
                            <td>
                                @if($product->image!='')
                                    <img width="100px" src="{{asset('images/'.$product->image)}}"/>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('product.edit', ['id' => $product->id]) }}"
                                   class="btn-sm btn-warning">Edit</a>
                                <a href="{{ route('edit.attribute', ['id' => $product->id]) }}"
                                   class="btn-sm btn-warning">Edit At</a>
                                <a href="{{ route('add.attribute', ['id' => $product->id]) }}"
                                   class="btn-sm btn-warning">ADD At</a>

                                @if($product->status == 1)
                                    <a href="{{ route('admin.product.status', ['status' => 0, 'id' => $product->id]) }}"
                                       class="btn btn-sm btn-primary">Active</a>
                                @elseif($product->status == 0)
                                    <a href="{{ route('admin.product.status', ['status' => 1, 'id' => $product->id]) }}"
                                       class="btn btn-sm btn-secondary">Inactive</a>
                                @endif

                                <a href="{{ url('admin/product/delete/' . $product->id) }}"
                                   class="btn btn-sm btn-danger">Delete</a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection
