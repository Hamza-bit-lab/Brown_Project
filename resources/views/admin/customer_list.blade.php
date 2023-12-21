@extends('admin.layout')
@section('title', 'Customers List')
@section('customer_select', 'active')


@section('container')
    <h1 class="mb10">Customers List</h1>
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>City</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->mobile }}</td>
                    <td>{{ $customer->city }}</td>
                    <td>{{ $customer->address }}</td>
{{--                    pro-edit/{{ $product->id }}--}}
                    <td><a href="customer-view/{{$customer->id}}" class="btn btn-warning">View</a>
                        @if($customer->status == 1)
                            <a href="{{ url('admin/customer-status/0') }}/{{ $customer->id }}" class="btn btn-primary">Active</a>
                        @elseif($customer->status == 0)
                            <a href="{{ url('admin/customer-status/1') }}/{{ $customer->id }}" class="btn btn-secondary">Deactive</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
