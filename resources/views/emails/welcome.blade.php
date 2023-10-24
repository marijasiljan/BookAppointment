@extends('emails.layouts.email')
@section('content')
<div class="container">
<h4>    Thank you for registering with our application. To complete your registration, please use the following verification code:</h4>
    <h2>{{ $verificationCode }}</h2>
  <p>If you did not request this code, you can ignore this email.</p>

    <p>Thank you,
        Your Application Team</p>
</div>
@endsection
