<?php
// We will generate the new header but keep the original shopping cart HTML logic and navigation menu.

$header = <<<EOT
<style>
    /* Top Decorative Border */
    .scalloped-top {
        height: 15px;
        background-image: radial-gradient(circle at 10px 0, transparent 10px, #e62020 11px);
        background-size: 20px 15px;
        background-repeat: repeat-x;
        margin-bottom: 20px;
    }
    
    /* Top Pill Header */
    .custom-top-header {
        background: #f8f9fa;
        border-radius: 50px;
        padding: 10px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        position: relative;
        z-index: 50; /* ensure it stays above */
    }

    .top-header-left, .top-header-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* Action Buttons in Top Header */
    .action-box {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        border: 1px solid #eaeaea;
        border-radius: 30px;
        padding: 8px 15px;
        cursor: pointer;
        transition: 0.3s;
        text-decoration: none !important;
    }
    .action-box:hover {
        background: #f1f1f1;
        border-color: #ddd;
    }
    .action-box .icon-wrap {
        background: #ffe6e6;
        color: #e62020;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 14px;
    }
    .action-box .text-wrap {
        text-align: left;
        line-height: 1.2;
    }
    .action-box .title {
        font-weight: 800;
        color: #111;
        font-size: 13px;
        margin: 0;
    }
    .action-box .subtitle {
        color: #777;
        font-size: 11px;
        margin: 0;
        font-weight: 600;
    }

    /* Center Logo */
    .top-header-center {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: -15px; 
        background: #fff;
        padding: 10px 25px;
        border-radius: 20px;
        box-shadow: 0 10px 20px rgba(230, 32, 32, 0.15);
        border: 2px solid #e62020;
        text-align: center;
        z-index: 60;
    }
    .top-header-center a {
        font-family: 'Orbitron', sans-serif;
        font-size: 22px;
        font-weight: 900;
        color: #e62020;
        text-decoration: none;
        line-height: 1.1;
        display: inline-block;
    }

    @media(max-width: 991px) {
        .custom-top-header {
            flex-direction: column;
            border-radius: 20px;
            padding: 30px 20px 20px;
            gap: 20px;
            margin: 0 15px;
        }
        .top-header-center {
            top: -25px;
            padding: 5px 15px;
        }
        .top-header-left, .top-header-right {
            width: 100%;
            justify-content: space-between;
            flex-wrap: wrap;
        }
    }
</style>

<header class="header shop">
    <!-- Decorative top border -->
    <div class="scalloped-top"></div>

    <!-- Top Info Pill -->
    <div class="custom-top-header">
        
        <div class="top-header-left">
            <!-- Location Action -->
            <div class="action-box" onclick="$('#locationModal').modal('show');">
                <div class="icon-wrap"><i class="fa fa-map-marker"></i></div>
                <div class="text-wrap">
                    <p class="title">Change Location</p>
                    <p class="subtitle" id="display-selected-location">Select Location</p>
                </div>
                <i class="fa fa-angle-down" style="color: #999; margin-left: 5px;"></i>
            </div>

            <!-- Contact Action -->
            @php \$settings = DB::table('settings')->first(); @endphp
            <div class="action-box" style="border: none; background: transparent;">
                <div class="icon-wrap" style="background: transparent; font-size: 24px;"><i class="fa fa-phone-square"></i></div>
                <div class="text-wrap">
                    <p class="title">Call Us</p>
                    <p class="subtitle" style="color: #e62020; font-weight: 800;">{{ \$settings->phone }}</p>
                </div>
            </div>
        </div>

        <!-- Center Logo -->
        <div class="top-header-center">
            <a href="{{route('home')}}">
                Shoukat<br><span style="color: #333; font-size: 16px;">Nimco Center</span>
            </a>
        </div>

        <div class="top-header-right">
            
            <!-- User Account / Track Order -->
            @auth
                @if(Auth::user()->role=='admin')
                <a href="{{route('admin')}}" class="action-box">
                    <div class="icon-wrap"><i class="fa fa-user"></i></div>
                    <div class="text-wrap"><p class="title">Admin Panel</p></div>
                </a>
                @else
                <a href="{{route('user')}}" class="action-box">
                    <div class="icon-wrap"><i class="fa fa-user"></i></div>
                    <div class="text-wrap"><p class="title">My Account</p></div>
                </a>
                @endif
                <a href="{{route('user.logout')}}" class="action-box" style="border:none; padding: 5px;" title="Logout"><i class="fa fa-sign-out" style="color: #e62020; font-size: 18px;"></i></a>
            @else
                <a href="{{route('order.track')}}" class="action-box">
                    <div class="icon-wrap"><i class="fa fa-truck"></i></div>
                    <div class="text-wrap"><p class="title">Track Order</p></div>
                </a>
                <a href="{{route('login.form')}}" class="action-box">
                    <div class="icon-wrap"><i class="fa fa-sign-in"></i></div>
                    <div class="text-wrap"><p class="title">Login / Register</p></div>
                </a>
            @endauth

            <div class="right-bar" style="margin-top: 0;">
                <div class="sinlge-bar shopping" style="margin: 0;">
                    <a href="{{route('cart')}}" class="single-icon" style="font-size: 24px; color: #e62020;">
                        <i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span>
                    </a>
                    <!-- Shopping Item Dropdown -->
                    @auth
                    <div class="shopping-item">
                        <div class="dropdown-cart-header">
                            <span>{{count(Helper::getAllProductFromCart())}} Items</span>
                            <a href="{{route('cart')}}">View Cart</a>
                        </div>
                        <ul class="shopping-list">
                            @foreach(Helper::getAllProductFromCart() as \$data)
                            @php
                            \$photo=explode(',',\$data->product['photo']);
                            @endphp
                            <li>
                                <a href="{{route('cart-delete',\$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                <a class="cart-img" href="#"><img src="{{\$photo[0]}}" alt="{{\$photo[0]}}"></a>
                                <h4><a href="{{route('product-detail',\$data->product['slug'])}}" target="_blank">{{\$data->product['title']}}</a></h4>
                                <p class="quantity">{{\$data->quantity}} x - <span class="amount">Rs:{{number_format(\$data->price,2)}}</span></p>
                            </li>
                            @endforeach
                        </ul>
                        <div class="bottom">
                            <div class="total">
                                <span>Total</span>
                                <span class="total-amount">Rs:{{number_format(Helper::totalCartPrice(),2)}}</span>
                            </div>
                            <a href="{{route('checkout')}}" class="btn animate">Checkout</a>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- Mobile nav container inside the structure so plugin catches it -->
            <div class="mobile-nav"></div>

        </div>
    </div>

    <!-- Header Inner (Original Navigation) -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Home</a></li>
                                            <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">About Us</a></li>
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Products</a><span class="new">New</span></li>
                                            {{Helper::getHeaderCategory()}}
                                            <li><a href="{{route('home')}}#return-policy">Return Policy</a></li>
                                            <li><a href="{{route('home')}}#faq">FAQs</a></li>
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Update the displayed location based on sessionStorage
    document.addEventListener("DOMContentLoaded", function() {
        let savedLoc = sessionStorage.getItem('saved_location_name');
        if(savedLoc) {
            let locEl = document.getElementById('display-selected-location');
            if(locEl) locEl.innerText = savedLoc;
        }
    });
</script>
EOT;

file_put_contents('resources/views/frontend/layouts/header.blade.php', $header);
echo "Done replacing header.";
