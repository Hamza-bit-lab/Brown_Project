@extends('front/layout')
@section('page_title','Order Placed')
@section('container')

    <div class="container" style="margin-top: 15px">
        <div class="row" style="text-align: center;">
            <h2>Your order has been Placed.</h2>
            <h2>Order ID:- {{session()->get('ORDER_ID')}}</h2>
            <br>
            <a class="btn btn-primary" href="{{ url('/') }}">Back To Home</a>
            <br><br>
        </div>
    </div>

@endsection
