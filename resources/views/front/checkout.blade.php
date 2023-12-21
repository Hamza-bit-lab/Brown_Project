@extends('front/layout')
@section('page_title','Checkout')
@section('container')

    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <div class="aa-catg-head-banner-area">
            <div class="container">

            </div>
        </div>
    </section>
    <!-- / catg header banner section -->


    <section id="checkout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="checkout-area">
                        <form id="frmPlaceOrder" action="{{ route('stripe') }}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="checkout-left">
                                        <div class="panel-group" id="accordion">
                                            @if(session()->has('FRONT_USER_LOGIN')==null)
                                                <input type="button" value="Login" class="aa-browse-btn"
                                                       data-toggle="modal" data-target="#login-modal">
                                            <p>You need to login before you checkout</p>
                                                <br/><br/>
                                                OR
                                                <br/><br/>
                                        @endif
                                        <!-- Shipping Address -->
                                            <div class="panel panel-default aa-checkout-billaddress">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion">
                                                            User Details Address
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFour" class="panel-collapse collapse in">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="text" placeholder=" Name*" value="{{ isset($customers[0]) ? $customers[0]->name : '' }}" name="name" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="email" placeholder="Email Address*" value="{{ isset($customers[0]) ? $customers[0]->email : '' }}" name="email" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="tel" placeholder="Phone*" value="{{ isset($customers[0]) ? $customers[0]->mobile : '' }}" name="mobile" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="aa-checkout-single-bill">
                                                                    <textarea cols="8" rows="3" name="address" required>{!! isset($customers[0]) ? $customers[0]->address : '' !!}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="text" placeholder="City / Town*" value="{{ isset($customers[0]) ? $customers[0]->city : '' }}" name="city" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="text" placeholder="State*" value="{{ isset($customers[0]) ? $customers[0]->state : '' }}" name="state" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="text" placeholder="Postcode / ZIP*" value="{{ isset($customers[0]) ? $customers[0]->zip : '' }}" name="zip" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkout-right">
                                        <h4>Order Summary</h4>
                                        <div class="aa-order-summary-area">
                                            <table class="table table-responsive">
                                                <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $totalPrice=0;
                                                @endphp
                                                @foreach($cartItems as $data)
                                                    @php
                                                        $totalPrice = $totalPrice+($data->productAttribute->price*$data->qty)
                                                    @endphp
                                                    <tr>
                                                        <td>{{$data->product->name}} <strong> x {{$data->qty}}</strong>
                                                        </td>
                                                        <td>{{$data->productAttribute->price*$data->qty}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr class="hide show_coupon_box">
                                                    <th>Coupon Code <a class="text-danger" href="javascript: void (0) "
                                                                       onclick="remove_coupon_code()">Remove</a></th>
                                                    <td id="coupon_code_str"></td>
                                                </tr>
                                                <tr>

                                                    <th>Total</th>
                                                    <td id="total_price"> PKR: {{ $totalPrice }}</td>
                                                    <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">

                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <h4>Coupon Code</h4>
                                        <div class="aa-payment-method coupon_code">
                                            <input type="text" placeholder="Coupon Code" name="coupon_code" id="coupon_code" class="aa-coupon-code apply_coupon_code_box">
                                            <input type="button" value="Apply Coupon" class="aa-browse-btn apply_coupon_code_box" onclick="applyCouponCode()">
                                            <div id="coupon_code_msg"></div>
                                            <div id="order_place_msg"></div>
                                        </div>

                                        <br/>
                                        <div class="aa-payment-method">
                                            <label for="cod"><input type="radio" id="cod" name="payment_type" value="COD" checked> Cash on Delivery </label>
                                            <label for="stripe"><input type="radio" id="stripe" name="payment_type" value="Stripe"> Stripe </label>
                                            <input type="submit" value="Place Order" class="aa-browse-btn" id="btnPlaceOrder">
                                        </div>
                                        <div id="placed_msg"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>s
    </section>
    <script>
        $(document).ready(function () {
            $('#btnPlaceOrder').on('click', function (e) {
                e.preventDefault();

                console.log('Button clicked');
                var selectedPaymentMethod = $('input[name="payment_type"]:checked').val();
                console.log('Selected Payment Method: ' + selectedPaymentMethod);

                if (selectedPaymentMethod === 'stripe') {
                    console.log('Redirecting to Stripe');
                    var formData = $('#frmPlaceOrder').serialize();
                    var totalPrice = $('#total_price').text();

                    window.location.href = '/stripe?' + formData + '&totalPrice=' + totalPrice;
                } else if (selectedPaymentMethod === 'COD') {
                    window.location.href = 'order_placed.html';
                }
            });
        });
    </script>



@endsection
