@extends('emails.layouts.email')
@section('content')
    <table class="email-wrapper">
        <tr>
            <td>
                <table class="email-content" >
                    <!-- Email content goes here -->
                    <tr>
                        <td class="email-body">
                            <h2>Password Reset Request</h2>
                            <p>We received a request to reset your password. If you didn't make this request, you can ignore this email.</p>
                            <p>If you did make the request, enter this code on your reset password page:</p>
                            <h2>{{ $verificationCode }}</h2>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
