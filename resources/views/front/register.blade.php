@extends('front.layout')
@section('page_title', 'Register')
@section('container')
    <div class="col-md-4 align-items-center" style="margin-bottom: 35px; margin-left: 25rem; margin-top: 18px">
        <div class="aa-myaccount-register">
            <div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <h4 style="font-weight: bold">Register</h4>
            <form action="{{ route('register_process') }}" method="post" class="aa-login-form" id="frmRegister">
                @csrf
                <div class="form-group">
                    <label for="">Name<span>*</span></label>
                    <input type="text" name="name" placeholder="Name">
                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="">Email<span>*</span></label>
                    <input type="text" name="email" placeholder="Email">
                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="">Mobile<span>*</span></label>
                    <input type="text" name="mobile" placeholder="Mobile">
                    <span class="text-danger">@error('mobile'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="">Password<span>*</span></label>
                    <input type="password" name="password" placeholder="Password">
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                </div>
                <button type="submit" id="btnRegister" class="aa-browse-btn">Register</button><br>
                <div id="forgot_msg"></div>

            </form>

        </div>
    </div>
@endsection
