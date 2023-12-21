@extends('admin.layout')
@section('page_title', 'Coupon List')
@section('coupon_select', 'active')

@section('container')
    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <h1 class="mb10">Coupon List</h1>
    <a href="{{ route('show_add_coupon') }}" type="button" class="btn btn-success mb10">Add Coupon</a>
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Code</th>
                <th>Value</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->title }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->value }}</td>
                    <td><a href="{{ route('coupon.edit', ['id'=> $coupon->id]) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ url('admin/coupon/delete/' . $coupon->id) }}" class="btn btn-danger">Delete</a>
                        @if($coupon->status == 1)
                            <a href="{{ route('admin.coupon.status', ['status' => 0, 'id' => $coupon->id]) }}"
                               class="btn btn-primary">Active</a>
                        @elseif($coupon->status == 0)
                            <a href="{{ route('admin.coupon.status', ['status' => 1, 'id' => $coupon->id]) }}"
                               class="btn btn-secondary">Inactive</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
