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
        .custom-top-header {
            flex-direction: column;
            border-radius: 20px;
            padding: 20px;
            gap: 20px;
            margin: 0 15px;
        }
        .top-header-center {
            padding: 5px 15px;
        }
        .top-header-left, .top-header-right {
            width: 100%;
            justify-content: space-between;
            flex-wrap: wrap;
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
        .header.shop .header-inner {
            background: #fff !important;
        }
        .header.shop .header-inner .nav li a {
            color: #333 !important;
        }
        .header.shop .header-inner .nav li.active a {
            color: var(--primary-color) !important;
        }
    }
</style>

<header class="header shop">
    <!-- Decorative top border -->
    <div class="scalloped-top"></div>

    <!-- Top Info Pill -->
    <div class="custom-top-header" style="min-height: 80px; align-items: center;">
        
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
    <div class="header-inner">
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
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Products</a><span class="new">New</span></li>
                                            {{Helper::getHeaderCategory()}}
                                            <li><a href="{{route('home')}}#return-policy">Return Policy</a></li>
                                            <li><a href="{{route('home')}}#faq">FAQs</a></li>
                                            <li><a href="{{route('home')}}#our-outlets">Our Stores</a></li>
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
    // Update the displayed location based on localStorage
    document.addEventListener("DOMContentLoaded", function() {
        let savedLoc = localStorage.getItem('saved_location_name');
        if(savedLoc) {
            let locEl = document.getElementById('display-selected-location');
            if(locEl) locEl.innerText = savedLoc;
        }
    });
</script>
