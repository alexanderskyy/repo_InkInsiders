<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - InkSiders')</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }
        
        /* Admin Navbar */
        .admin-navbar {
            background: linear-gradient(135deg, #0052a3 0%, #0068cc 100%);
            color: white;
            padding: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .admin-nav-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }
        
        .admin-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px 0;
        }
        
        .admin-brand h1 {
            font-size: 24px;
            font-weight: 700;
        }
        
        .admin-badge {
            background: rgba(255,255,255,0.2);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .admin-nav-menu {
            display: flex;
            gap: 5px;
        }
        
        .admin-nav-link {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .admin-nav-link:hover {
            background: rgba(255,255,255,0.15);
        }
        
        .admin-nav-link.active {
            background: rgba(255,255,255,0.25);
        }
        
        .admin-nav-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background: rgba(255,255,255,0.15);
            border-radius: 20px;
        }
        
        .admin-user-icon {
            width: 32px;
            height: 32px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        
        .btn-logout {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .btn-logout:hover {
            background: rgba(255,255,255,0.3);
        }
        
        .btn-visit-site {
            background: white;
            color: #0052a3;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-visit-site:hover {
            background: #f0f7ff;
            transform: translateY(-1px);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .admin-nav-content {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }
            
            .admin-nav-menu {
                flex-direction: column;
                width: 100%;
            }
            
            .admin-nav-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Admin Navigation -->
    <nav class="admin-navbar">
        <div class="admin-nav-content">
            <div class="admin-brand">
                <h1>InkSiders</h1>
                <span class="admin-badge">ADMIN</span>
            </div>
            
            <div class="admin-nav-actions">
                <a href="{{ route('home') }}" class="btn-visit-site" target="_blank">
                    🌐 Visit Site
                </a>
                
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </nav>

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

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/notification.js') }}"></script>
    
    @stack('scripts')
</body>
</html>