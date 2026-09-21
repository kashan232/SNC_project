<style>
    /* Top Decorative Border */
    .scalloped-top {
        height: 15px;
        background-image: radial-gradient(circle at 10px 0, transparent 10px, var(--primary-color) 11px);
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
        color: var(--primary-color);
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
        padding: 0;
        background: transparent;
        border: none;
        box-shadow: none;
        border-radius: 0;
        text-align: center;
        z-index: 60;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .top-header-center a {
        font-family: 'Orbitron', sans-serif;
        font-size: 20px;
        font-weight: 900;
        color: var(--primary-color);
        text-decoration: none;
        line-height: 1.1;
        display: inline-block;
    }

            @media(max-width: 991px) {
        /* Standard Navbar Layout */
        .custom-top-header {
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            border-radius: 0 !important;
            padding: 10px 15px !important;
            margin: 0 !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08) !important;
            align-items: center !important;
            justify-content: space-between !important;
            background: #fff !important;
            position: relative;
            z-index: 1000;
            height: 70px;
        }

        /* 1. Left: Logo */
        .top-header-center {
            order: 1;
            width: auto !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .top-header-center img {
            width: 45px !important;
            height: 45px !important;
        }

        /* 2. Middle: Change Location */
        .top-header-left {
            order: 2;
            width: auto !important;
            flex: 1;
            justify-content: flex-start !important;
            padding-left: 10px;
        }
        .top-header-left > .action-box:first-child {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .top-header-left > .action-box:first-child .icon-wrap {
            background: transparent !important;
            color: var(--primary-color) !important;
            font-size: 18px !important;
            width: auto !important;
            height: auto !important;
        }
        .top-header-left > .action-box:first-child .title {
            display: none !important; /* Hide "Change Location" title */
        }
        .top-header-left > .action-box:first-child .subtitle {
            font-size: 13px !important;
            color: #333 !important;
            font-weight: 700 !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100px;
        }

        /* Hide Call Us */
        .top-header-left > .action-box:nth-child(2) {
            display: none !important;
        }

        /* 3. Right: Cart & Menu */
        .top-header-right {
            order: 3;
            width: auto !important;
            justify-content: flex-end !important;
            gap: 5px !important;
        }
        .top-header-right > .action-box,
        .top-header-right > div:first-child,
        .modern-nav-actions .complaint-btn,
        .modern-nav-actions > div:first-of-type {
            display: none !important; /* Hide phone and complaint button on mobile */
        }
        
        .modern-nav-actions {
            padding: 0 !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            gap: 5px !important;
        }
        
        /* Adjust Icons */
        .right-bar {
            gap: 10px !important;
            margin: 0 !important;
        }
        .right-bar .single-icon .icon-wrap {
            width: 32px !important;
            height: 32px !important;
            font-size: 18px !important;
        }
        
        /* SlickNav Mobile Menu Fixes */
        .mobile-nav {
            margin-left: 5px;
            display: flex;
            align-items: center;
        }
        .slicknav_menu {
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .slicknav_btn {
            background: transparent !important;
            margin: 0 !important;
            padding: 5px !important;
        }
        .slicknav_icon-bar {
            background-color: #333 !important;
        }
        
        /* Full Dropdown styling */
        .slicknav_nav {
            position: absolute !important;
            top: 70px !important; /* Right below the 70px header */
            left: 0 !important;
            right: 0 !important;
            width: 100vw !important;
            background: #fff !important;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
            z-index: 999999 !important;
            border-top: 2px solid var(--primary-color) !important;
            max-height: calc(100vh - 70px);
            overflow-y: auto;
        }
        .slicknav_nav li {
            width: 100%;
            display: block;
        }
        .slicknav_nav a {
            color: #333 !important;
            font-weight: 600 !important;
            padding: 12px 20px !important;
            border-bottom: 1px solid #f5f5f5 !important;
            text-align: left;
            margin: 0 !important;
            border-radius: 0 !important;
        }
        .slicknav_nav a:hover {
            background: #f9f9f9 !important;
            color: var(--primary-color) !important;
        }
    }

    /* Override dark theme for the main navigation bar safely */
    .header.shop .header-inner {
        background: var(--primary-color) !important; /* Theme red background */
        border-top: 1px solid #c91919;
    }
    .header.shop .header-inner .nav li a {
        color: #fff !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        transition: 0.3s;
    }
    .header.shop .header-inner .nav li:hover > a,
    .header.shop .header-inner .nav li.active > a {
        color: #ffcccc !important;
        background: transparent !important;
    }
    
    /* Dropdown fixes */
    .header.shop .header-inner .nav li .dropdown {
        background: #fff !important;
        border: 1px solid #eee;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .header.shop .header-inner .nav li .dropdown li a {
        color: #333 !important;
        text-transform: capitalize;
        font-weight: 500;
    }
    .header.shop .header-inner .nav li .dropdown li:hover > a {
        color: var(--primary-color) !important;
        background: #ffe6e6 !important;
    }
    
    /* "NEW" badge styling */
    .header.shop .header-inner .nav li .new {
        background: #fff !important;
        color: var(--primary-color) !important;
        font-weight: bold;
    }

    /* Mobile overrides */
            @media(max-width: 991px) {
        /* Standard Navbar Layout */
        .custom-top-header {
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            border-radius: 0 !important;
            padding: 10px 15px !important;
            margin: 0 !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08) !important;
            align-items: center !important;
            justify-content: space-between !important;
            background: #fff !important;
            position: relative;
            z-index: 1000;
            height: 70px;
        }

        /* 1. Left: Logo */
        .top-header-center {
            order: 1;
            width: auto !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .top-header-center img {
            width: 45px !important;
            height: 45px !important;
        }

        /* 2. Middle: Change Location */
        .top-header-left {
            order: 2;
            width: auto !important;
            flex: 1;
            justify-content: flex-start !important;
            padding-left: 10px;
        }
        .top-header-left > .action-box:first-child {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .top-header-left > .action-box:first-child .icon-wrap {
            background: transparent !important;
            color: var(--primary-color) !important;
            font-size: 18px !important;
            width: auto !important;
            height: auto !important;
        }
        .top-header-left > .action-box:first-child .title {
            display: none !important; /* Hide "Change Location" title */
        }
        .top-header-left > .action-box:first-child .subtitle {
            font-size: 13px !important;
            color: #333 !important;
            font-weight: 700 !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100px;
        }

        /* Hide Call Us */
        .top-header-left > .action-box:nth-child(2) {
            display: none !important;
        }

        /* 3. Right: Cart & Menu */
        .top-header-right {
            order: 3;
            width: auto !important;
            justify-content: flex-end !important;
            gap: 5px !important;
        }
        .top-header-right > .action-box,
        .top-header-right > div:first-child,
        .modern-nav-actions .complaint-btn,
        .modern-nav-actions > div:first-of-type {
            display: none !important; /* Hide phone and complaint button on mobile */
        }
        
        .modern-nav-actions {
            padding: 0 !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            gap: 5px !important;
        }
        
        /* Adjust Icons */
        .right-bar {
            gap: 10px !important;
            margin: 0 !important;
        }
        .right-bar .single-icon .icon-wrap {
            width: 32px !important;
            height: 32px !important;
            font-size: 18px !important;
        }
        
        /* SlickNav Mobile Menu Fixes */
        .mobile-nav {
            margin-left: 5px;
            display: flex;
            align-items: center;
        }
        .slicknav_menu {
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .slicknav_btn {
            background: transparent !important;
            margin: 0 !important;
            padding: 5px !important;
        }
        .slicknav_icon-bar {
            background-color: #333 !important;
        }
        
        /* Full Dropdown styling */
        .slicknav_nav {
            position: absolute !important;
            top: 70px !important; /* Right below the 70px header */
            left: 0 !important;
            right: 0 !important;
            width: 100vw !important;
            background: #fff !important;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
            z-index: 999999 !important;
            border-top: 2px solid var(--primary-color) !important;
            max-height: calc(100vh - 70px);
            overflow-y: auto;
        }
        .slicknav_nav li {
            width: 100%;
            display: block;
        }
        .slicknav_nav a {
            color: #333 !important;
            font-weight: 600 !important;
            padding: 12px 20px !important;
            border-bottom: 1px solid #f5f5f5 !important;
            text-align: left;
            margin: 0 !important;
            border-radius: 0 !important;
        }
        .slicknav_nav a:hover {
            background: #f9f9f9 !important;
            color: var(--primary-color) !important;
        }
    }
</style>

<header class="header shop">
    <!-- Decorative top border -->
    <div class="scalloped-top"></div>

    <!-- Top Info Pill -->
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
            
            <a href="{{route('complain')}}" class="complaint-btn" style="text-decoration: none; display: flex; flex-direction: column; justify-content: center;">
                <span style="font-weight: 800; color: #111; font-size: 15px; line-height: 1.2;">Submit Your Complaint</span>
                <span style="font-size: 12px; color: #888; font-weight: 500;">From Complaint to Care.</span>
            </a>

            <!-- Border separator -->
            <div style="width: 1px; height: 35px; background: #eee; margin: 0 5px;"></div>
            
            <div class="sinlge-bar shopping" style="margin: 0; display: flex; align-items: center; height: 100%;">
                    <a href="{{route('cart')}}" class="single-icon action-box" style="padding: 5px; border-radius: 50%; border: none; background: transparent; display: flex; align-items: center; margin: 0;">
                        <div class="icon-wrap" style="width: 42px; height: 42px; font-size: 20px; position: relative;">
                            <i class="ti-bag"></i> 
                            <span class="total-count" style="background:var(--primary-color); color:white; font-size: 10px; width: 18px; height: 18px; display: flex; justify-content: center; align-items: center; border-radius: 50%; position: absolute; top: -4px; right: -4px; border: 2px solid #fff;">{{Helper::cartCount()}}</span>
                        </div>
                    </a>
                    <!-- Shopping Item Dropdown -->
                    @auth
                    <div class="shopping-item">
                        <div class="dropdown-cart-header">
                            <span>{{count(Helper::getAllProductFromCart())}} Items</span>
                            <a href="{{route('cart')}}">View Cart</a>
                        </div>
                        <ul class="shopping-list">
                            @foreach(Helper::getAllProductFromCart() as $data)
                            @php
                            $photo=explode(',',$data->product['photo']);
                            @endphp
                            <li>
                                <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                <p class="quantity">{{$data->quantity}} x - <span class="amount">Rs:{{number_format($data->price,2)}}</span></p>
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
            <!-- Hamburger -->
            <button id="modern-toggle-btn" class="hamburger-btn" style="background: #ffeaea; color: #ff3b30; border: none; width: 48px; height: 48px; border-radius: 50%; display: flex; flex-direction: column; justify-content: center; align-items: center; cursor: pointer; gap: 4px; margin-left: 5px; transition: all 0.3s;">
                <span style="display: block; width: 22px; height: 2px; background: #ff3b30; border-radius: 2px;"></span>
                <span style="display: block; width: 22px; height: 2px; background: #ff3b30; border-radius: 2px;"></span>
                <span style="display: block; width: 22px; height: 2px; background: #ff3b30; border-radius: 2px;"></span>
            </button>
        </div>
    </div>
</div>
<div class="custom-top-header" style="display:none !important;" style="min-height: 80px; align-items: center;">
        
        <div class="top-header-left" style="height: 100%; display: flex; align-items: center;">
            <!-- Location Action -->
            <div class="action-box" onclick="$('#locationModal').modal('show');" style="display: flex; align-items: center;">
                <div class="icon-wrap"><i class="fa fa-map-marker"></i></div>
                <div class="text-wrap">
                    <p class="title">Change Location</p>
                    <p class="subtitle" id="display-selected-location">Select Location</p>
                </div>
                <i class="fa fa-angle-down" style="color: #999; margin-left: 5px;"></i>
            </div>

            <!-- Contact Action -->
            @php $settings = DB::table('settings')->first(); @endphp
            <div class="action-box" style="border: none; background: transparent; display: flex; align-items: center;">
                <div class="icon-wrap" style="background: transparent; font-size: 24px;"><i class="fa fa-phone-square"></i></div>
                <div class="text-wrap">
                    <p class="title">Call Us</p>
                    <p class="subtitle" style="color: var(--primary-color); font-weight: 800;">{{ $settings->phone }}</p>
                </div>
            </div>
        </div>

        <!-- Center Logo -->
        <div class="top-header-center">
            <a href="{{route('home')}}">
                <img src="{{asset('images/footer_logo.jpg')}}" alt="Shoukat Nimco Center Logo" style="width: 75px; height: 75px; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
            </a>
        </div>

        <div class="top-header-right" style="height: 100%; display: flex; align-items: center;">
            
            <!-- User Account / Track Order -->
            @auth
                @if(Auth::user()->role=='admin')
                <a href="{{route('admin')}}" class="action-box" style="display: flex; align-items: center;">
                    <div class="icon-wrap"><i class="fa fa-user"></i></div>
                    <div class="text-wrap"><p class="title">Admin Panel</p></div>
                </a>
                @else
                <a href="{{route('user')}}" class="action-box" style="display: flex; align-items: center;">
                    <div class="icon-wrap"><i class="fa fa-user"></i></div>
                    <div class="text-wrap"><p class="title">My Account</p></div>
                </a>
                @endif
                <a href="{{route('user.logout')}}" class="action-box" style="border:none; padding: 5px; display: flex; align-items: center;" title="Logout"><i class="fa fa-sign-out" style="color: var(--primary-color); font-size: 18px;"></i></a>
            @else
                <a href="{{route('order.track')}}" class="action-box" style="display: flex; align-items: center;">
                    <div class="icon-wrap"><i class="fa fa-truck"></i></div>
                    <div class="text-wrap"><p class="title">Track Order</p></div>
                </a>
                <a href="{{route('login.form')}}" class="action-box" style="display: flex; align-items: center;">
                    <div class="icon-wrap"><i class="fa fa-sign-in"></i></div>
                    <div class="text-wrap"><p class="title">Login / Register</p></div>
                </a>
            @endauth

            <div class="right-bar" style="margin-top: 0; display: flex; align-items: center; gap: 15px; height: 100%;">
                <div class="sinlge-bar shopping" style="margin: 0; display: flex; align-items: center; height: 100%;">
                    <a href="{{route('wishlist')}}" class="single-icon action-box" style="padding: 5px; border-radius: 50%; border: none; background: transparent; display: flex; align-items: center; margin: 0;">
                        <div class="icon-wrap" style="width: 42px; height: 42px; font-size: 20px; position: relative;">
                            <i class="fa fa-heart-o"></i> 
                            <span class="total-count" style="background:var(--primary-color); color:white; font-size: 10px; width: 18px; height: 18px; display: flex; justify-content: center; align-items: center; border-radius: 50%; position: absolute; top: -4px; right: -4px; border: 2px solid #fff;">{{Helper::wishlistCount()}}</span>
                        </div>
                    </a>
                    <!-- Wishlist Item Dropdown -->
                    @auth
                    <div class="shopping-item">
                        <div class="dropdown-cart-header">
                            <span>{{count(Helper::getAllProductFromWishlist())}} Items</span>
                            <a href="{{route('wishlist')}}">View Wishlist</a>
                        </div>
                        <ul class="shopping-list">
                            @foreach(Helper::getAllProductFromWishlist() as $data)
                            @php
                            $photo=explode(',',$data->product['photo']);
                            @endphp
                            <li>
                                <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                <p class="quantity">{{$data->quantity}} x - <span class="amount">Rs:{{number_format($data->price,2)}}</span></p>
                            </li>
                            @endforeach
                        </ul>
                        <div class="bottom">
                            <div class="total">
                                <span>Total</span>
                                <span class="total-amount">Rs:{{number_format(Helper::totalWishlistPrice(),2)}}</span>
                            </div>
                            <a href="{{route('cart')}}" class="btn animate">Cart</a>
                        </div>
                    </div>
                    @endauth
                </div>

                <div class="sinlge-bar shopping" style="margin: 0; display: flex; align-items: center; height: 100%;">
                    <a href="{{route('cart')}}" class="single-icon action-box" style="padding: 5px; border-radius: 50%; border: none; background: transparent; display: flex; align-items: center; margin: 0;">
                        <div class="icon-wrap" style="width: 42px; height: 42px; font-size: 20px; position: relative;">
                            <i class="ti-bag"></i> 
                            <span class="total-count" style="background:var(--primary-color); color:white; font-size: 10px; width: 18px; height: 18px; display: flex; justify-content: center; align-items: center; border-radius: 50%; position: absolute; top: -4px; right: -4px; border: 2px solid #fff;">{{Helper::cartCount()}}</span>
                        </div>
                    </a>
                    <!-- Shopping Item Dropdown -->
                    @auth
                    <div class="shopping-item">
                        <div class="dropdown-cart-header">
                            <span>{{count(Helper::getAllProductFromCart())}} Items</span>
                            <a href="{{route('cart')}}">View Cart</a>
                        </div>
                        <ul class="shopping-list">
                            @foreach(Helper::getAllProductFromCart() as $data)
                            @php
                            $photo=explode(',',$data->product['photo']);
                            @endphp
                            <li>
                                <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                <p class="quantity">{{$data->quantity}} x - <span class="amount">Rs:{{number_format($data->price,2)}}</span></p>
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
    <div class="header-inner" style="display:none !important;">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-12">
                        <div class="menu-area" style="display: flex; justify-content: center;">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav" style="justify-content: center; width: 100%;">
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Home</a></li>
                                            <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">About Us</a></li>
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Our Menu</a><span class="new">New</span></li>
                                            {{Helper::getHeaderCategory()}}
                                            
                                            
                                            <li><a href="{{route('home')}}#our-outlets">Our Stores</a></li>
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('complain')}}">Contact Us</a></li>
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
                
                <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}"><i class="ti-package"></i> Our Menu</a></li>
                <li>
                    <a href="#catSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" style="display:flex; justify-content:space-between; align-items:center;"><span style="display:flex; align-items:center;"><i class="ti-view-grid" style="margin-right:10px;"></i> Categories</span> <i class="fa fa-angle-down"></i></a>
                    <ul class="collapse list-unstyled" id="catSubmenu" style="background: #fafafa; border-left: 3px solid var(--primary-color);">
                        @php
                            $categories = \App\Models\Category::where('is_parent',1)->where('status','active')->orderBy('title','ASC')->get();
                        @endphp
                        @foreach($categories as $cat)
                            <li><a href="{{route('product-cat', $cat->slug)}}" style="padding: 10px 25px; color: #555; display:block; text-decoration:none; border-bottom: 1px solid #eee;">{{$cat->title}}</a></li>
                        @endforeach
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
                <li><a href="{{route('complain')}}"><i class="ti-headphone-alt"></i> Contact Us</a></li>
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
</header>

<script>
    // Update the displayed location based on localStorage
    document.addEventListener("DOMContentLoaded", function() {
        let savedLoc = localStorage.getItem('saved_location_name');
        if(savedLoc) {
            let locEl = document.getElementById('display-selected-location');
            if(locEl) locEl.innerText = savedLoc;
        }
    });
</script>
