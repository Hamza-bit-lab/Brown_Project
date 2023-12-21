{{--Click here to change your Password--}}
{{--<a href="{{ url('/forgot_password_change') }}/{{ $rand_id }}"></a>--}}



<div class="verification-container">
    <h2>Reset Password Verification</h2><br>
    Hello {{ $name }}<br>
    <p>Please click the Link below to Change password</p>
    <a href="{{ url('/forgot_password_change/') }}/{{ $rand_id }}"> Click Here </a>to reset password.

</div>
