
<div class="verification-container">
    <h2>Email Verification</h2><br>
    Hello {{ $name }}<br>
    <p>Thank you for signing up! To complete the registration process, please click the button below to verify your email address.</p>
    <a href="{{ url('/verification/') }}/{{ $rand_id }}"> Click Here </a>to verify Email.

</div>
