<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Inksiders – ATK Store')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    @stack('styles')
</head>
<body>

<header class="header">
    <div class="container header-inner">
        <div class="logo">
            <a href="{{ route('home') }}">Inksiders</a>
        </div>

        <nav class="nav">
            <ul>
                <li><a href="{{ route('shop.index') }}" @if(request()->routeIs('shop.*')) aria-current="page" @endif>Shop</a></li>
                <li><a href="{{ route('shop.collections') }}" @if(request()->routeIs('shop.collections')) aria-current="page" @endif>Collections</a></li>
                <li><a href="{{ route('shop.bundles') }}" @if(request()->routeIs('shop.bundles')) aria-current="page" @endif>Bundles</a></li>
                <li><a href="{{ route('shop.limited') }}" @if(request()->routeIs('shop.limited')) aria-current="page" @endif>Limited Editions</a></li>
                <li><a href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif>About</a></li>
            </ul>
        </nav>

        <div class="actions">
            <a href="{{ route('cart.index') }}" class="cart-link" @if(request()->routeIs('cart.*')) aria-current="page" @endif>
                🛒 Cart 
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="badge">{{ count(session('cart')) }}</span>
                @endif
            </a>
            
            @auth
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="login-btn">Login</a>
        @endauth
        </div>
    </div>
</header>

<!-- Flash Messages (Hidden, will be shown as popup) -->
    @if(session('success'))
        <div data-success-message="{{ session('success') }}" style="display: none;"></div>
    @endif

    @if(session('error'))
        <div data-error-message="{{ session('error') }}" style="display: none;"></div>
    @endif

    @if(session('warning'))
        <div data-warning-message="{{ session('warning') }}" style="display: none;"></div>
    @endif

    @if(session('info'))
        <div data-info-message="{{ session('info') }}" style="display: none;"></div>
    @endif


@yield('hero')

<main class="container">
    @yield('content')
</main>

<footer class="footer">
    <div class="container">
        <div class="cols">
            <div>
                <h4>Inksiders</h4>
                <p class="muted">ATK premium untuk produktivitas harian.</p>
            </div>
            <div>
                <h4>Bantuan</h4>
                <p><a href="{{ route('faq') }}">FAQ</a></p>
                <p><a href="{{ route('contact') }}">Contact</a></p>
                <p><a href="{{ route('sustainability') }}">Sustainability</a></p>
            </div>
            <div>
                <h4>Sosial</h4>
                <p><a href="#">Instagram</a></p>
                <p><a href="#">TikTok</a></p>
                <p><a href="#">LinkedIn</a></p>
            </div>
        </div>
        <p class="copyright">&copy; {{ date('Y') }} Inksiders. All rights reserved.</p>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('javascript/main.js') }}"></script>
<script src="{{ asset('js/notification.js') }}"></script>
@stack('scripts')

</body>
</html>