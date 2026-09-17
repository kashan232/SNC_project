<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$header_path = $base_dir . 'resources/views/frontend/layouts/header.blade.php';
$header = file_get_contents($header_path);

// First, find the Cart Block so we don't lose it
preg_match('/<div class=\"sinlge-bar shopping\"[^>]*>\s*<a href=\"\{\{route\(\'cart\'\)\}\}\".*?<\/div>\s*<\/div>/is', $header, $cart_match);
$cart_html = $cart_match[0] ?? '';

// Build the new custom-top-header
$new_top_header = <<<'HTML'
<div class="custom-top-header" style="min-height: 90px; align-items: center; display: flex; justify-content: space-between; padding: 0 5%; background: #fff; box-shadow: 0 2px 15px rgba(0,0,0,0.04); border-bottom: 1px solid #f5f5f5; width: 100%;">
    
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
$new_top_header .= "\n            " . $cart_html . "\n";
$new_top_header .= <<<'HTML'
            
            <!-- Hamburger -->
            <button id="modern-toggle-btn" class="hamburger-btn" style="background: #ffeaea; color: #ff3b30; border: none; width: 48px; height: 48px; border-radius: 50%; display: flex; flex-direction: column; justify-content: center; align-items: center; cursor: pointer; gap: 4px; margin-left: 5px; transition: all 0.3s;">
                <span style="display: block; width: 22px; height: 2px; background: #ff3b30; border-radius: 2px;"></span>
                <span style="display: block; width: 22px; height: 2px; background: #ff3b30; border-radius: 2px;"></span>
                <span style="display: block; width: 22px; height: 2px; background: #ff3b30; border-radius: 2px;"></span>
            </button>
        </div>

        <!-- Mobile nav container inside the structure so plugin catches it -->
        <div class="mobile-nav"></div>
    </div>
</div>
HTML;

// Replace from `<div class="custom-top-header"` to `<!-- Header Inner` (exclusive)
$header = preg_replace('/<div class="custom-top-header".*?<!-- Header Inner \(Original Navigation\)/is', $new_top_header . "\n\n    <!-- Header Inner (Original Navigation)", $header);

// Now update the sidebar menu to include Account, Login, Wishlist, etc.
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
HTML;

$header = preg_replace('/<!-- Modern Off-Canvas Sidebar -->.*?<\/div>\s*<\/div>/is', $new_sidebar_html, $header);

file_put_contents($header_path, $header);
echo "Clean modern navbar successfully built.\n";
