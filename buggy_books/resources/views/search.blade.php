@extends('layouts.app')
@section('content')
<style>
.hero {
    background: #f8fafc;
    border-radius: 24px;
    padding: 2.5rem 1rem 3rem 1rem;
    margin-top: 2rem;
    text-align: center;
    box-shadow: 0 2px 16px rgba(0,0,0,0.04);
}
.hero-title {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 1rem;
}
.hero-title .highlight {
    color: #6366f1;
}
.hero-desc {
    color: #64748b;
    font-size: 1.25rem;
    margin-bottom: 2.5rem;
}
.search-bar {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 2rem;
}
.search-input {
    width: 400px;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1.1rem;
    outline: none;
    transition: border 0.2s;
}
.search-input:focus {
    border-color: #6366f1;
}
.search-icon {
    position: absolute;
    left: calc(50% - 200px + 12px);
    z-index: 2;
    color: #64748b;
    pointer-events: none;
}
.cart-btn {
    position: absolute;
    top: 2rem;
    right: 2rem;
    background: #fff;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 0.5rem 0.7rem;
    transition: box-shadow 0.2s;
}
.cart-btn:hover {
    box-shadow: 0 2px 8px rgba(99,102,241,0.12);
}
</style>
<div class="container position-relative">
    <a href="{{ route('cart.index') }}" class="cart-btn" title="View Cart">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
    </a>
    <div class="hero">
        <div style="display:flex;align-items:center;justify-content:center;margin-bottom:1.5rem;">
            <span style="font-size:2rem;font-weight:800;">BuggyBooks</span>
        </div>
        <div class="hero-title">
            Discover Your Next <span class="highlight">Great Read</span>
        </div>
        <div class="hero-desc">
            Explore our beautiful collection of books
        </div>
        <form method="GET" action="{{ route('search') }}" class="search-bar">
            <span class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </span>
            <input type="text" name="q" value="{{ $query ?? '' }}" class="search-input" placeholder="Search for books" required>
            <button type="submit" style="display:none"></button>
        </form>
    </div>
    @if(isset($books) && count($books))
        <div class="mt-5">
            <h2>Results</h2>
            <ul>
                @foreach($books as $book)
                    <li style="margin-bottom:1.5rem;">
                        <strong>{{ $book['volumeInfo']['title'] ?? 'No Title' }}</strong><br>
                        <em>{{ $book['volumeInfo']['authors'][0] ?? 'Unknown Author' }}</em><br>
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book['id'] }}">
                            <input type="hidden" name="title" value="{{ $book['volumeInfo']['title'] ?? '' }}">
                            <input type="hidden" name="author" value="{{ $book['volumeInfo']['authors'][0] ?? '' }}">
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Add to Cart</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    @elseif(isset($query))
        <p class="mt-5">No results found.</p>
    @endif
</div>
@endsection 