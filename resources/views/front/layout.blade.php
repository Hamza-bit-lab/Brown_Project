<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">

    <link href="{{asset('front-assets/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('front-assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('front-assets/css/jquery.smartmenus.bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/jquery.simpleLens.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/nouislider.css')}}">
    <link id="switcher" href="{{asset('front-assets/css/theme-color/default-theme.css')}}" rel="stylesheet">
    <link href="{{asset('front-assets/css/sequence-theme.modern-slide-in.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('front-assets/css/style.css')}}" rel="stylesheet">


    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <![endif]-->

    <script>
        var PRODUCT_IMAGE="{{ asset('images/') }}";
    </script>
</head>
<body class="productPage">

<a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
@if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
<!-- Start header section -->
<header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-header-top-area">
                        <!-- start header top left -->
                        <div class="aa-header-top-left">

                            <!-- start cellphone -->
                            <div class="cellphone hidden-xs">
                                <p><span class="fa fa-phone"></span>+92 301 2424249</p>
                            </div>
                            <!-- / cellphone -->
                        </div>
                        <!-- / header top left -->
                        <div class="aa-header-top-right">
                            <ul class="aa-head-top-nav-right">


                                <li class="hidden-xs"><a href="{{ url('/cart') }}">My Cart</a></li>
                                @if(session()->has('FRONT_USER_LOGIN')!=null)
                                    <li><a href="{{ url('/my_orders') }}">My Orders</a></li>
                                    <li><a style="color: #ff6666" href="{{url('/logout')}}">Logout</a></li>
                                @else
                                    <li>
                                        <a style="color: #ff6666" href="" data-toggle="modal" data-target="#login-modal">Login</a>
                                    </li>
                                    @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-header-bottom-area">
                        <!-- logo  -->
                        <div class="aa-logo">
                            <!-- Text based logo -->
                            <a href="{{url('/')}}">
                                <span class="fa fa-shopping-cart"></span>
                                <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                            </a>
                            <!-- img based logo -->
                            <!-- <a href="javascript:void(0)"><img src="img/logo.jpg" alt="logo img"></a> -->
                        </div>
                        <!-- / logo  -->
                        <!-- cart box -->
                        @php
                            $cartCount=cartCount();
                            $totalCartItem=count($cartCount);
                            $totalPrice=0;
                        @endphp
                        <div class="aa-cartbox">
{{--                            <a class="aa-cart-link" href="#" id="cartBox">--}}
{{--                                <span class="fa fa-shopping-basket"></span>--}}
{{--                                <span class="aa-cart-title text-success">SHOPPING CART</span>--}}
{{--                                <span class="aa-cart-notify">{{$totalCartItem}}</span>--}}
                            </a>

                        </div>
                        <!-- / cart box -->
                        <!-- search box -->
                        <div class="aa-search-box">
                            <form action="">
                                <input type="text" name="" id="search_str" placeholder="Search here ex. 'man' ">
                                <button type="button" onclick="funSearch()"><span class="fa fa-search"></span></button>
                            </form>
                        </div>
                        <!-- / search box -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / header bottom  -->
</header>
<!-- / header section -->
<!-- menu -->
<section id="menu">
    <div class="container">
        <div class="menu-area">
            <!-- Navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="navbar-collapse collapse">
                    <!-- Left nav -->
                    {!! getTopNavCat() !!}
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
</section>
<!-- / menu -->
<!-- Start slider -->

@section('container')
@show


<!-- footer -->
<footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-footer-top-area">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="aa-footer-widget">
                                    <h3>Main Menu</h3>
                                    <ul class="aa-footer-nav">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">Our Services</a></li>
                                        <li><a href="#">Our Products</a></li>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="aa-footer-widget">
                                    <div class="aa-footer-widget">
                                        <h3>Knowledge Base</h3>
                                        <ul class="aa-footer-nav">
                                            <li><a href="#">Delivery</a></li>
                                            <li><a href="#">Returns</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#">Discount</a></li>
                                            <li><a href="#">Special Offer</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="aa-footer-widget">
                                    <div class="aa-footer-widget">
                                        <h3>Useful Links</h3>
                                        <ul class="aa-footer-nav">
                                            <li><a href="#">Site Map</a></li>
                                            <li><a href="#">Search</a></li>
                                            <li><a href="#">Advanced Search</a></li>
                                            <li><a href="#">Suppliers</a></li>
                                            <li><a href="#">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="aa-footer-widget">
                                    <div class="aa-footer-widget">
                                        <address>
                                            <p>Lahore</p>
                                            <p><span class="fa fa-phone"></span>+92 301 2424249</p>
                                            <p><span class="fa fa-envelope"></span>hamzantenious@gmail.com</p>
                                        </address>
                                        <div class="aa-footer-social">
                                            <a href="#"><span class="fa fa-facebook"></span></a>
                                            <a href="#"><span class="fa fa-twitter"></span></a>
                                            <a href="#"><span class="fa fa-google-plus"></span></a>
                                            <a href="#"><span class="fa fa-youtube"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-footer-bottom-area">
                        <p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>
                        <div class="aa-footer-payment">
                            <span class="fa fa-cc-mastercard"></span>
                            <span class="fa fa-cc-visa"></span>
                            <span class="fa fa-paypal"></span>
                            <span class="fa fa-cc-discover"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- / footer -->
@php
if (isset($_COOKIE['login_email']) && isset($_COOKIE['login_pwd'])){
    $login_email = $_COOKIE['login_email'];
    $login_pwd = $_COOKIE['login_pwd'];
    $is_remember = "checked='checked'";
}
else{
    $login_email = '';
    $login_pwd = '';
    $is_remember = "";
}
@endphp


<!-- Button trigger modal -->
<!-- Login Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div id="popup_login">
                    <h4>Login or Register</h4>
                    <form class="aa-login-form" id="frmLogin" method="post">
                        <label for="">Email address<span>*</span></label>
                        <input type="email" placeholder="Email" name="str_login_email" value="{{ $login_email }}" required>
                        <label for="">Password<span>*</span></label>
                        <input type="password" placeholder="Password" name="str_login_password" value="{{ $login_pwd }}" required>
                        <button class="aa-browse-btn" type="submit" id="btnLogin">Login</button>
                        <label for="rememberme" class="rememberme"><input type="checkbox" {{ $is_remember }} name="rememberme" id="rememberme"> Remember me </label>
                        <p class="aa-lost-password"><a href="javascript: void (0)" onclick="forgot_password()">Lost your password?</a></p>
                        <div id="login_msg"></div>
                        <div class="aa-register-now">
                            Don't have an account?<a href="{{ route('register') }}">Register now!</a>
                        </div>
                        @csrf
                    </form>
                </div>
                <div id="popup_forgot" style="display: none">
                    <h4>Forgot Password</h4>
                    <form class="aa-login-form" id="frmForgot">
                        <label for="">Email address<span>*</span></label>
                        <input type="email" placeholder="Email" name="str_forgot_email"  required>
                        <button class="aa-browse-btn buttonload" type="submit" id="btnForgot">Submit</button>
                        <br><br><br><br>
                        <div id="forgot_msg"></div>
                        @csrf
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('front-assets/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/jquery.smartmenus.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/jquery.smartmenus.bootstrap.js')}}"></script>
<script src="{{asset('front-assets/js/sequence.js')}}"></script>
<script src="{{asset('front-assets/js/sequence-theme.modern-slide-in.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/jquery.simpleGallery.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/jquery.simpleLens.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/slick.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/nouislider.js')}}"></script>

@yield('js')
<script src="{{asset('front-assets/js/custom.js')}}"></script>


<script>
    $(document).ready(function() {
        console.log("Document ready!");

        setTimeout(function() {
            $('#wpf-loader-two').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000);
    });
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6585854007843602b804c459/1hi8p11qg';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
</body>

</html>
