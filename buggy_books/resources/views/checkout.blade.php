@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Checkout</h1>
    @if($success)
        <p>Thank you for your purchase! Your order has been placed.</p>
    @else
        <p style="color:red;">Checkout failed: {{ $error }}</p>
        <script>
        if (window.Sentry) {
            Sentry.captureException(new Error('Checkout failed: {{ addslashes($error) }}'));
        }
        </script>
    @endif
    <a href="{{ route('search') }}">Back to Search</a>
</div>
@endsection 