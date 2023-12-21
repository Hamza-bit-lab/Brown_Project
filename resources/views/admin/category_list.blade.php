@extends('admin.layout')
@section('title', 'Category List')
@section('category_select', 'active')


@section('container')
    <h1 class="mb10">Category List</h1>
    <a href="{{ route('add/category') }}" type="button" class="btn btn-success mb10">Add Category</a>
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->category_slug }}</td>
                <td><img src="{{ asset('images/'.$category->category_image) }}" height="35px" width="35px"> </td>
                <td><a href="cat-edit/{{ $category->id }}" class="btn btn-warning">Edit</a>
                    <a href="delete/{{ $category->id }}" class="btn btn-danger">Delete</a>
                    @if($category->status == 1)
                    <a href="{{ url('admin/status/0') }}/{{ $category->id }}" class="btn btn-primary">Active</a>
                    @elseif($category->status == 0)
                        <a href="{{ url('admin/status/1') }}/{{ $category->id }}" class="btn btn-secondary">Deactive</a>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
