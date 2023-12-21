@extends('admin.layout')
@section('page_title', 'Banner List')
@section('banner_select', 'active')


@section('container')
    <h1 class="mb10">Banner List</h1>
    <a href="{{ route('show_add_banner') }}" type="button" class="btn btn-success mb10">Add Banner</a>
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Button Text</th>
                <th>Button link</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>{{ $banner->btn_text }}</td>
                    <td>{{ $banner->btn_link }}</td>
                    <td><img src="{{ asset('images/'.$banner->image) }}" height="35px" width="35px"> </td>
                    <td><a href="{{ route('banner.edit', ['id' => $banner->id]) }}" class="btn btn-warning">Edit</a>
                        <a href="delete/{{ $banner->id }}" class="btn btn-danger">Delete</a>
                        @if($banner->status == 1)
                            <a href="{{url('admin/banner/status/0')}}/{{$banner->id}}" class="btn btn-primary">Active</a>
                        @elseif($banner->status == 0)
                            <a href="{{url('admin/banner/status/1')}}/{{ $banner->id }}" class="btn btn-secondary">Deactive</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
