@extends('front.layout')
@section('page_title', 'Change Password')
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
            <h4 style="font-weight: bold">Change Password</h4>
            <form action="{{ route('register_process') }}" method="post" class="aa-login-form" id="frmUpdatePassword">
                @csrf
                <div class="form-group">
                    <label for="">Password<span>*</span></label>
                    <input type="password" name="password" placeholder="Password">
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                </div>
                <button type="submit" id="btnUpdatePassword" class="aa-browse-btn">Update</button><br>
            </form>
        </div>
        <div id="thank_you_msg" class="field_erroe"></div>
    </div>
@endsection
