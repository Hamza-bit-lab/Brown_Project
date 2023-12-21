@extends('admin.layout')
@section('page_title', 'Orders')
@section('orders_select', 'active')


@section('container')
    <h1 class="mb10">Orders List</h1>
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Details</th>
                <th>Amount</th>
                <th>Order Status</th>
                <th>Payment Type</th>
                <th>Payment Status</th>
                <th>Order Placed</th>
{{--                <th>Action</th>--}}
            </tr>
            </thead>
            <tbody>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td><a href="{{ url('admin/order_detail') }}/{{ $order->id }}">{{ $order->id }}</a></td>
                    <td>
                        {{ $order->name }}
                        {{ $order->email }}
                        {{ $order->mobile }}<br>
                        {{ $order->address }}
                    </td>
                    <td>PKR: {{ $order->total_amount }}</td>
                    <td>
                        @if ($order->orderStatus)
                            {{ $order->orderStatus->order_status }}
                        @else
                            Order Status Not Available
                        @endif
                    </td>
                    <td>{{ $order->payment_type }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->added_on }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No orders available.</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

@endsection
