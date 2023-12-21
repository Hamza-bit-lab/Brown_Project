@extends('admin.layout')
@section('page_title', 'Size List')
@section('size_select', 'active')


@section('container')
    <h1 class="mb10">Size List</h1>
    <a href="{{ route('show_add_size') }}" type="button" class="btn btn-success mb10">Add Size</a>
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Size</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sizes as $size)
                <tr>
                    <td>{{ $size->id }}</td>
                    <td>{{ $size->size }}</td>
                    <td><a href="{{ route('size.edit', ['id'=> $size->id]) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ url('admin/size/delete/' . $size->id) }}" class="btn btn-danger">Delete</a>
                        @if($size->status == 1)
                            <a href="{{ route('admin.size.status', ['status' => 0, 'id' => $size->id]) }}" class="btn btn-primary">Active</a>
                        @elseif($size->status == 0)
                            <a href="{{ route('admin.size.status', ['status' => 1, 'id' => $size->id]) }}" class="btn btn-secondary">Inactive</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
