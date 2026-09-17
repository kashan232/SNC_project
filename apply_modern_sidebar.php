<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$header_path = $base_dir . 'resources/views/frontend/layouts/header.blade.php';
$header = file_get_contents($header_path);

// 1. Hide the old orange navbar
$header = str_replace('<div class="header-inner">', '<div class="header-inner" style="display: none !important;">', $header);

// 2. Add the custom sidebar HTML and CSS, and JS right before </header>
$sidebar_html = <<<'HTML'
    <!-- Modern Off-Canvas Sidebar -->
    <div id="modern-sidebar" class="modern-sidebar">
        <div class="sidebar-header">
            <img src="{{asset('images/footer_logo.jpg')}}" alt="Logo" class="sidebar-logo">
            <button id="close-sidebar" class="close-sidebar-btn"><i class="ti-close"></i></button>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-menu">
                <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}"><i class="ti-home"></i> Home</a></li>
                <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}"><i class="ti-info-alt"></i> About Us</a></li>
                <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}"><i class="ti-package"></i> Products</a></li>
                <li>
                    <a href="#catSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="ti-view-grid"></i> Categories</a>
                    <ul class="collapse list-unstyled" id="catSubmenu" style="padding-left: 20px;">
                        {{Helper::getHeaderCategory()}}
                    </ul>
                </li>
                <li><a href="{{route('home')}}#our-outlets-premium"><i class="ti-location-pin"></i> Our Stores</a></li>
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
        
        /* Modern Toggle & Complaint Button in Top Header */
        .modern-nav-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #f4f6f8;
            padding: 5px 5px 5px 20px;
            border-radius: 50px;
            border: 1px solid #e1e4e8;
            margin-left: 15px;
        }
        .complaint-btn {
            font-weight: 700;
            color: #222;
            font-size: 14px;
            text-decoration: none !important;
            display: flex;
            align-items: center;
        }
        .complaint-btn span {
            display: block;
            font-size: 11px;
            color: #888;
            font-weight: 500;
            line-height: 1;
        }
        .hamburger-btn {
            background: rgba(255,100,100,0.15);
            color: #ff3b30;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            gap: 4px;
            transition: all 0.3s;
        }
        .hamburger-btn span {
            display: block;
            width: 20px;
            height: 2px;
            background: #ff3b30;
            border-radius: 2px;
            transition: all 0.3s;
        }
        .hamburger-btn:hover {
            background: #ff3b30;
        }
        .hamburger-btn:hover span {
            background: #fff;
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
</header>
HTML;

$header = str_replace('</header>', $sidebar_html, $header);

// 3. Inject the modern right side actions (Complaint text + Toggle) next to cart
$modern_actions = <<<'HTML'
                <div class="modern-nav-actions">
                    <a href="javascript:void(0)" class="complaint-btn">
                        <div>
                            Submit Your Complaint
                            <span>From Complaint to Care - Share With Us.</span>
                        </div>
                    </a>
                    <button id="modern-toggle-btn" class="hamburger-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
HTML;

// Find the end of shopping-item / right-bar and insert before mobile-nav
$header = preg_replace('/(<\/div>\s*<!-- Mobile nav container)/', $modern_actions . "\n$1", $header);

file_put_contents($header_path, $header);
echo "Modern Navbar sidebar applied!\n";
