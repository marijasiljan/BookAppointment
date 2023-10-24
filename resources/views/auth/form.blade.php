@extends('layouts.app') // Use your application's layout

@section('content')
    <form method="post" action="/verify">
        @csrf
        <div class="form-group">
            <label for="verification_code">Verification Code:</label>
            <input type="text" name="verification_code" id="verification_code" required>
        </div>
        <button type="submit">Submit</button>
    </form>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
@endsection

