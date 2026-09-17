<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$header_backup_path = $base_dir . 'resources/views/frontend/layouts/header_backup.blade.php';
$header_path = $base_dir . 'resources/views/frontend/layouts/header.blade.php';

$header = file_get_contents($header_backup_path);

// Find the Cart HTML safely by extracting between the known start and end
$cart_start = strpos($header, '<div class="sinlge-bar shopping"');
// we want the second one (Cart), not Wishlist
$cart_start = strpos($header, '<div class="sinlge-bar shopping"', $cart_start + 10);
$cart_end = strpos($header, '<!-- Mobile nav container');
// The cart block ends right before the div closing the right-bar
$cart_html = substr($header, $cart_start, $cart_end - $cart_start);
// Remove any stray closing divs that belong to right-bar
$cart_html = preg_replace('/<\/div>\s*<\/div>\s*$/', '</div>', $cart_html); // Just in case

// Hide old headers
$header = str_replace('<div class="custom-top-header"', '<div class="custom-top-header" style="display:none !important;"', $header);
$header = str_replace('<div class="header-inner">', '<div class="header-inner" style="display:none !important;">', $header);

// Build new modern header
$new_top_header = <<<'HTML'
<div class="modern-top-header" style="min-height: 90px; align-items: center; display: flex; justify-content: space-between; padding: 0 5%; background: #fff; box-shadow: 0 2px 15px rgba(0,0,0,0.04); border-bottom: 1px solid #f5f5f5; width: 100%;">
    
    <!-- Left: Logo & Simple Location -->
    <div class="top-header-left" style="display: flex; align-items: center; gap: 30px;">
        <a href="{{route('home')}}" style="display: block; margin-top: 5px;">
            <img src="{{asset('images/footer_logo.jpg')}}" alt="Shoukat Nimco Center Logo" style="width: 75px; height: 75px; object-fit: cover; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        </a>
        <div onclick="$('#locationModal').modal('show');" style="cursor: pointer; display: flex; align-items: center; gap: 8px; color: #444; font-size: 15px; font-weight: 600; background: #f9f9f9; padding: 8px 15px; border-radius: 30px; border: 1px solid #eee; transition: all 0.3s;">
            <i class="fa fa-map-marker" style="color: var(--primary-color); font-size: 18px;"></i>
            <span id="display-selected-location">Select Location</span>
            <i class="fa fa-angle-down" style="font-size: 14px; margin-left: 2px; color: #999;"></i>
        </div>
    </div>

    <!-- Right: Phone, Complaint, Cart, Hamburger -->
    <div class="top-header-right" style="display: flex; align-items: center;">
        @php $settings = DB::table('settings')->first(); @endphp
        
        <!-- Simple Phone Text -->
        <div style="display: flex; flex-direction: column; text-align: right; margin-right: 25px;">
            <span style="font-size: 11px; color: #999; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Call Us Now</span>
            <a href="tel:{{ $settings->phone }}" style="font-size: 18px; color: var(--primary-color); font-weight: 800; text-decoration: none;">{{ $settings->phone }}</a>
        </div>
        
        <!-- Modern Complaint & Toggle Box -->
        <div class="modern-nav-actions" style="display: flex; align-items: center; gap: 15px; background: #fff; padding: 6px 6px 6px 25px; border-radius: 50px; border: 1px solid #eaeaea; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            
            <a href="{{route('contact')}}" class="complaint-btn" style="text-decoration: none; display: flex; flex-direction: column; justify-content: center;">
                <span style="font-weight: 800; color: #111; font-size: 15px; line-height: 1.2;">Submit Your Complaint</span>
                <span style="font-size: 12px; color: #888; font-weight: 500;">From Complaint to Care.</span>
            </a>

            <!-- Border separator -->
            <div style="width: 1px; height: 35px; background: #eee; margin: 0 5px;"></div>
            
HTML;
$new_top_header .= "\n            " . $cart_html; // already has closing tags
$new_top_header .= <<<'HTML'
            
            <!-- Hamburger -->
            <button id="modern-toggle-btn" class="hamburger-btn" style="background: #ffeaea; color: #ff3b30; border: none; width: 48px; height: 48px; border-radius: 50%; display: flex; flex-direction: column; justify-content: center; align-items: center; cursor: pointer; gap: 4px; margin-left: 5px; transition: all 0.3s;">
                <span style="display: block; width: 22px; height: 2px; background: #ff3b30; border-radius: 2px;"></span>
                <span style="display: block; width: 22px; height: 2px; background: #ff3b30; border-radius: 2px;"></span>
                <span style="display: block; width: 22px; height: 2px; background: #ff3b30; border-radius: 2px;"></span>
            </button>
        </div>
    </div>
</div>
HTML;

$header = str_replace('<div class="custom-top-header"', $new_top_header . "\n" . '<div class="custom-top-header"', $header);

// Add the Sidebar HTML before </header>
$new_sidebar_html = <<<'HTML'
    <!-- Modern Off-Canvas Sidebar -->
    <div id="modern-sidebar" class="modern-sidebar">
        <div class="sidebar-header" style="background: var(--primary-color); color: #fff;">
            <div style="display:flex; align-items:center; gap: 10px;">
                <img src="{{asset('images/footer_logo.jpg')}}" alt="Logo" class="sidebar-logo" style="border: 2px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                <span style="font-weight: 800; font-size: 18px; font-family: 'Orbitron', sans-serif;">SNC</span>
            </div>
            <button id="close-sidebar" class="close-sidebar-btn" style="background: rgba(255,255,255,0.2); color: #fff;"><i class="ti-close"></i></button>
        </div>
        <div class="sidebar-content">
            <!-- Account Section -->
            <div style="padding: 15px 25px; border-bottom: 1px solid #f1f1f1; background: #f9f9f9;">
                @auth
                    <p style="margin-bottom: 10px; font-weight: 600; color: #555;">Hello, {{ Auth::user()->name ?? 'User' }}</p>
                    <div style="display:flex; gap: 10px;">
                        @if(Auth::user()->role=='admin')
                            <a href="{{route('admin')}}" class="btn btn-sm" style="background: var(--primary-color); color:#fff; padding: 5px 10px; border-radius: 4px; font-size: 12px; text-transform:none;"><i class="fa fa-dashboard"></i> Admin</a>
                        @else
                            <a href="{{route('user')}}" class="btn btn-sm" style="background: var(--primary-color); color:#fff; padding: 5px 10px; border-radius: 4px; font-size: 12px; text-transform:none;"><i class="fa fa-user"></i> Account</a>
                        @endif
                        <a href="{{route('user.logout')}}" class="btn btn-sm" style="background: #dc3545; color:#fff; padding: 5px 10px; border-radius: 4px; font-size: 12px; text-transform:none;"><i class="fa fa-sign-out"></i> Logout</a>
                    </div>
                @else
                    <p style="margin-bottom: 10px; font-weight: 600; color: #555;">Welcome to SNC</p>
                    <div style="display:flex; gap: 10px;">
                        <a href="{{route('login.form')}}" class="btn btn-sm" style="background: var(--primary-color); color:#fff; padding: 5px 10px; border-radius: 4px; font-size: 12px; text-transform:none;"><i class="fa fa-sign-in"></i> Login / Register</a>
                    </div>
                @endauth
            </div>

            <ul class="sidebar-menu">
                <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}"><i class="ti-home"></i> Home</a></li>
                <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}"><i class="ti-info-alt"></i> About Us</a></li>
                <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}"><i class="ti-package"></i> Products</a></li>
                <li>
                    <a href="#catSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" style="display:flex; justify-content:space-between; align-items:center;"><span style="display:flex; align-items:center;"><i class="ti-view-grid" style="margin-right:10px;"></i> Categories</span> <i class="fa fa-angle-down"></i></a>
                    <ul class="collapse list-unstyled" id="catSubmenu" style="padding-left: 20px; background: #fafafa; border-left: 3px solid var(--primary-color);">
                        {{Helper::getHeaderCategory()}}
                    </ul>
                </li>
                <li><a href="{{route('home')}}#our-outlets-premium"><i class="ti-location-pin"></i> Our Stores</a></li>
                <li style="border-top: 1px solid #eee; margin-top: 10px; padding-top: 10px;">
                    <a href="{{route('order.track')}}"><i class="ti-truck"></i> Track Order</a>
                </li>
                <li>
                    <a href="{{route('wishlist')}}"><i class="ti-heart"></i> Wishlist 
                        <span style="background: var(--primary-color); color: #fff; padding: 2px 6px; border-radius: 10px; font-size: 10px; float: right;">{{Helper::wishlistCount()}}</span>
                    </a>
                </li>
                <li><a href="{{route('contact')}}"><i class="ti-headphone-alt"></i> Contact Us</a></li>
            </ul>
        </div>
    </div>
    <div id="sidebar-overlay" class="sidebar-overlay"></div>

    <style>
        .modern-sidebar {
            position: fixed;
            top: 0;
            right: -350px;
            width: 320px;
            height: 100vh;
            background: #fff;
            box-shadow: -5px 0 25px rgba(0,0,0,0.1);
            z-index: 99999;
            transition: right 0.4s cubic-bezier(0.77,0.2,0.05,1);
            display: flex;
            flex-direction: column;
        }
        .modern-sidebar.open {
            right: 0;
        }
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 99998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
            backdrop-filter: blur(3px);
        }
        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        .sidebar-header {
            padding: 20px 25px;
            border-bottom: 1px solid #f1f1f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .sidebar-logo {
            width: 50px; height: 50px; border-radius: 50%; object-fit: cover;
        }
        .close-sidebar-btn {
            background: rgba(255,0,0,0.1);
            color: red;
            border: none;
            width: 35px; height: 35px;
            border-radius: 50%;
            display: flex; justify-content: center; align-items: center;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .close-sidebar-btn:hover {
            background: red; color: #fff; transform: rotate(90deg);
        }
        .sidebar-content {
            padding: 20px 0;
            overflow-y: auto;
        }
        .sidebar-menu {
            list-style: none; padding: 0; margin: 0;
        }
        .sidebar-menu > li > a {
            display: block;
            padding: 15px 25px;
            color: #333;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }
        .sidebar-menu > li > a i {
            margin-right: 10px;
            color: #999;
            transition: color 0.3s ease;
        }
        .sidebar-menu > li.active > a, .sidebar-menu > li > a:hover {
            color: var(--primary-color);
            background: rgba(3,107,65,0.05);
            border-left-color: var(--primary-color);
        }
        .sidebar-menu > li.active > a i, .sidebar-menu > li > a:hover i {
            color: var(--primary-color);
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById('modern-toggle-btn');
            const sidebar = document.getElementById('modern-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }

            if(toggleBtn) toggleBtn.addEventListener('click', openSidebar);
            if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if(overlay) overlay.addEventListener('click', closeSidebar);
        });
    </script>
HTML;

$header = str_replace('</header>', $new_sidebar_html . "\n</header>", $header);

file_put_contents($header_path, $header);
echo "Safely rebuilt header without breaking any divs.\n";
