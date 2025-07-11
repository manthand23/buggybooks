@extends('layouts.app')
@section('content')
<style>
.cart-card {
    background: #f8fafc;
    border-radius: 24px;
    padding: 2.5rem 2rem 2.5rem 2rem;
    margin: 3rem auto 0 auto;
    max-width: 600px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.04);
    text-align: center;
}
.cart-title {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 2rem;
}
.cart-list {
    list-style: none;
    padding: 0;
    margin-bottom: 2rem;
}
.cart-list li {
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    box-shadow: 0 1px 4px rgba(99,102,241,0.04);
}
.cart-list strong {
    font-weight: 700;
}
.cart-btn {
    background: #6366f1;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 0.4rem 1.1rem;
    font-size: 1rem;
    font-weight: 600;
    transition: background 0.2s;
    margin-left: 1rem;
}
.cart-btn:hover {
    background: #4f46e5;
}
.checkout-btn {
    background: #22c55e;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 0.6rem 2.2rem;
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    margin-top: 1rem;
    transition: background 0.2s;
}
.checkout-btn:hover {
    background: #16a34a;
}
.back-link {
    display: block;
    margin-top: 1.5rem;
    color: #6366f1;
    text-decoration: none;
    font-weight: 600;
}
.back-link:hover {
    text-decoration: underline;
}
</style>
<div class="cart-card">
    <div class="cart-title">Your Cart</div>
    @if(count($cart))
        <ul class="cart-list">
            @foreach($cart as $item)
                <li>
                    <span><strong>{{ $item['title'] }}</strong> by {{ $item['author'] }}</span>
                    <form method="POST" action="{{ route('cart.remove', $item['id']) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cart-btn">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>Your cart is empty.</p>
        <script>
            // Ensure Sentry is loaded before sending the error
            if (window.Sentry) {
                Sentry.captureException(new Error('Cart is empty!'));
            }
            // Optionally, throw an error to show in the console as well:
            // throw new Error('Cart is empty!');
        </script>
    @endif
    <form method="POST" action="{{ route('cart.checkout') }}">
        @csrf
        <button type="submit" class="checkout-btn">Checkout</button>
    </form>
    <a href="{{ route('search') }}" class="back-link">Back to Search</a>
</div>
@endsection 