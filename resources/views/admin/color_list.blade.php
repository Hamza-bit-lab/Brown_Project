@extends('admin.layout')
@section('page_title', 'Color List')
@section('color_select', 'active')


@section('container')
    <h1 class="mb10">Color List</h1>
    <a href="{{ route('show_add_color') }}" type="button" class="btn btn-success mb10">Add Color</a>
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Color</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($colors as $color)
                <tr>
                    <td>{{ $color->id }}</td>
                    <td>{{ $color->color }}</td>
                    <td><a href="{{ route('color.edit', ['id'=> $color->id]) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ url('admin/color/delete/' . $color->id) }}" class="btn btn-danger">Delete</a>
                        @if($color->status == 1)
                            <a href="{{ route('admin.color.status', ['status' => 0, 'id' => $color->id]) }}" class="btn btn-primary">Active</a>
                        @elseif($color->status == 0)
                            <a href="{{ route('admin.color.status', ['status' => 1, 'id' => $color->id]) }}" class="btn btn-secondary">Inactive</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
