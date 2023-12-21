@extends('front/layout')
@section('page_title', 'My Orders')
@section('container')

    <!-- Cart view section -->
    <section id="cart-view">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            <form action="">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Payment Status</th>
                                            <th>Payment Type</th>
                                            <th>Order Status</th>
                                            <th>Placed At</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td><a href="{{ url('my_orders_detail') }}/{{ $order->id }}">{{ $order->id }}</a></td>
                                                <td>{{ $order->payment_status }}</td>
                                                <td>{{ $order->payment_type }}</td>
                                                <td>{{ $order->orderStatus->order_status }}</td>
                                                <td>{{ $order->added_on }}</td>
                                                <td>PKR: {{ $order->total_amount }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No orders available.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Cart view section -->
@endsection
