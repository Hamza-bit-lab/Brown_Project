
@extends('front.layout')
@section('page_title', 'User Login')
@section('container')

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

    <div>
        <h4>Login or Register</h4>
                                <form class="aa-login-form" id="frmLogin">
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
{{--    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-body">--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
{{--                    <div id="popup_login">--}}
{{--                        <h4>Login or Register</h4>--}}
{{--                        <form class="aa-login-form" id="frmLogin">--}}
{{--                            <label for="">Email address<span>*</span></label>--}}
{{--                            <input type="email" placeholder="Email" name="str_login_email" value="{{ $login_email }}" required>--}}
{{--                            <label for="">Password<span>*</span></label>--}}
{{--                            <input type="password" placeholder="Password" name="str_login_password" value="{{ $login_pwd }}" required>--}}
{{--                            <button class="aa-browse-btn" type="submit" id="btnLogin">Login</button>--}}
{{--                            <label for="rememberme" class="rememberme"><input type="checkbox" {{ $is_remember }} name="rememberme" id="rememberme"> Remember me </label>--}}
{{--                            <p class="aa-lost-password"><a href="javascript: void (0)" onclick="forgot_password()">Lost your password?</a></p>--}}
{{--                            <div id="login_msg"></div>--}}
{{--                            <div class="aa-register-now">--}}
{{--                                Don't have an account?<a href="{{ route('register') }}">Register now!</a>--}}
{{--                            </div>--}}
{{--                            @csrf--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <div id="popup_forgot" style="display: none">--}}
{{--                        <h4>Forgot Password</h4>--}}
{{--                        <form class="aa-login-form" id="frmForgot">--}}
{{--                            <label for="">Email address<span>*</span></label>--}}
{{--                            <input type="email" placeholder="Email" name="str_forgot_email"  required>--}}
{{--                            <button class="aa-browse-btn buttonload" type="submit" id="btnForgot">Submit</button>--}}
{{--                            <br><br><br><br>--}}
{{--                            <div id="forgot_msg"></div>--}}
{{--                            @csrf--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!-- /.modal-content -->--}}
{{--        </div><!-- /.modal-dialog -->--}}
{{--    </div>--}}
@endsection
