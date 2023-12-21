@extends('front/layout')
@section('page_title', 'My Cart')
@section('container')

    <!-- Cart view section -->
    <div id="cartmessage" style="float: right"></div>
    <section id="cart-view">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            <form action="">
                                @csrf
                                @if(isset($cartItems[0]))
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cartItems as $data)
                                                <tr id="cart_box{{ $data->productAttribute->id }}">
                                                    <td>
                                                        <a class="remove" href="javascript:void(0)" onclick="deleteCartProduct('{{ $data->product_id }}','{{ $data->productAttribute->size->size }}','{{ $data->productAttribute->color->color }}','{{ $data->productAttribute->id }}')">
                                                            <fa class="fa fa-close"></fa>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#"><img src="{{ asset('images/'.$data->product->image) }}" alt="img"></a>
                                                    </td>
                                                    <td>
                                                        <a class="aa-cart-title" href="{{ url('product/'.$data->product->slug) }}">
                                                            {{ $data->product->name }}<br>
                                                        </a>
                                                        @if($data->productAttribute->size != '')
                                                            SIZE: {{ $data->productAttribute->size->size }}<br>
                                                        @endif
                                                        @if($data->productAttribute->color != '')
                                                            COLOR: {{ $data->productAttribute->color->color }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $data->productAttribute->price }}</td>
                                                    <div id="warningMessage" style="color: red;"></div>

                                                    <td>
                                                        <button onclick="event.preventDefault(); updateQty('{{ $data->product_id }}','{{ $data->productAttribute->size->size }}','{{ $data->productAttribute->color->color }}','{{ $data->productAttribute->id }}','{{ $data->productAttribute->price }}', 'increase')">+</button>
                                                        <input id="qty{{ $data->productAttribute->id }}" class="aa-cart-quantity" type="" value="{{ $data->qty }}" onchange="updateQty('{{ $data->product_id }}','{{ $data->productAttribute->size->size }}','{{ $data->productAttribute->color->color }}','{{ $data->productAttribute->id }}','{{ $data->productAttribute->price }}')">

                                                        <button onclick="event.preventDefault(); updateQty('{{ $data->product_id }}','{{ $data->productAttribute->size->size }}','{{ $data->productAttribute->color->color }}','{{ $data->productAttribute->id }}','{{ $data->productAttribute->price }}', 'decrease')">-</button>
                                                    </td>



                                                    <td id="total_price_{{ $data->productAttribute->id }}">RS: {{ $data->productAttribute->price * $data->qty }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="6" class="aa-cart-view-bottom">
                                                    @if(session()->has('FRONT_USER_LOGIN'))
                                                        <a class="aa-cartbox-checkout aa-primary-btn" href="{{ url('/checkout') }}">
                                                            <input class="aa-cart-view-btn" type="button" value="Checkout">
                                                        </a>
                                                    @else
                                                        <p>Please login to checkout</p>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <h3>Cart is empty</h3>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Cart view section -->
    <input type="hidden" id="qty" value="1"/>
    <form id="frmAddToCart">
        <input type="hidden" id="size_id" name="size_id"/>
        <input type="hidden" id="color_id" name="color_id"/>
        <input type="hidden" id="pqty" name="pqty"/>
        <input type="hidden" id="product_id" name="product_id"/>
        @csrf
    </form>
@endsection
