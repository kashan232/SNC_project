@extends('frontend.layouts.master')

@section('title', 'Shoukat Nimco Center || PRODUCT PAGE')

@section('main-content')
    <!-- Modern Hero Section -->
    <div class="menu-hero-section" style="background-color: #0b1d2e; background-image: linear-gradient(to right, #0b1d2e 0%, #0b1d2e 45%, rgba(11, 29, 46, 0.4) 100%), url('{{asset('frontend/img/explore-banner-bg.png')}}'); background-position: right center; background-size: cover; background-repeat: no-repeat; padding: 60px 0 100px 0; position: relative;">
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row">
                <div class="col-lg-7 col-md-9 col-12">
                    <ul class="bread-list-modern" style="display: flex; align-items: center; list-style: none; padding: 0; margin: 0 0 15px 0; font-size: 13px; color: #fff;">
                        <li><a href="{{route('home')}}" style="color: #fff; text-decoration: none;">Home</a></li>
                        <li style="margin: 0 10px; color: #F7941D;"><i class="ti-angle-right" style="font-size: 10px;"></i></li>
                        <li class="active" style="color: #fff; font-weight: 600;">Our Menu</li>
                    </ul>
                    <h1 class="hero-title" style="font-size: 48px; font-weight: 900; color: #fff; margin-bottom: 15px; letter-spacing: 1px;">EXPLORE OUR <span style="color: #F7941D;">MENU</span></h1>
                    <p class="hero-subtitle" style="color: #e0e6ed; font-size: 15px; line-height: 1.6; font-weight: 400; max-width: 450px; margin-bottom: 0;">Premium quality Nimco, bakery items, and biscuits made with care and tradition.</p>
                </div>
            </div>
        </div>
        
        <!-- Bottom Wave SVG to match mockup exactly -->
        <div class="hero-wave" style="position: absolute; bottom: -2px; left: 0; width: 100%; overflow: hidden; line-height: 0; z-index: 1;">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="display: block; width: 100%; height: 70px;">
                <!-- Orange Outline Wave -->
                <path d="M0,60 C320,120 420,0 720,40 C1020,80 1120,-20 1440,60 L1440,120 L0,120 Z" fill="#F7941D" transform="translate(0, -6)"></path>
                <!-- White Fill Wave -->
                <path d="M0,60 C320,120 420,0 720,40 C1020,80 1120,-20 1440,60 L1440,120 L0,120 Z" fill="#eff2f6"></path>
            </svg>
        </div>
    </div>
    
    <form action="{{route('shop.filter')}}" method="POST" id="filter-form">
        @csrf
        <section class="product-area shop-sidebar shop section" style="padding-top: 0; background: #eff2f6;">
            <div class="container">
                <div class="row">
                    <!-- SIDEBAR -->
                    <div class="col-lg-3 col-md-12 col-12 order-2 order-lg-1">
                        <div class="shop-sidebar product-page-sidebar">
                                <!-- Categories Widget -->
                                <div class="single-widget category-widget">
                                    <h3 class="widget-title"><i class="ti-list"></i> CATEGORIES</h3>
                                    <ul class="categor-list-modern">
                                        <!-- All Categories -->
                                        <li>
                                            <a href="{{route('product-grids')}}" class="{{ Request::is('product-grids') ? 'active' : '' }}">
                                                <span class="cat-icon"><i class="ti-layout-grid2"></i></span>
                                                <span class="cat-name">All Items</span>
                                                <span class="cat-count badge">{{App\Models\Product::where('status','active')->count()}}</span>
                                            </a>
                                        </li>
										@php
											$menu=App\Models\Category::getAllParentWithChild();
										@endphp
										@if($menu)
											@foreach($menu as $cat_info)
                                                <li>
                                                    <a href="{{route('product-cat',$cat_info->slug)}}" class="{{ Request::is('product-cat/'.$cat_info->slug) ? 'active' : '' }}">
                                                        <span class="cat-icon">
                                                            @if(stripos($cat_info->title, 'nimco') !== false) <img src="https://cdn-icons-png.flaticon.com/512/3256/3256114.png" width="16" style="opacity: 0.6;" alt="">
                                                            @elseif(stripos($cat_info->title, 'biscuit') !== false) <img src="https://cdn-icons-png.flaticon.com/512/2619/2619574.png" width="16" style="opacity: 0.6;" alt="">
                                                            @elseif(stripos($cat_info->title, 'sweet') !== false) <img src="https://cdn-icons-png.flaticon.com/512/3014/3014491.png" width="16" style="opacity: 0.6;" alt="">
                                                            @else <i class="ti-layout-list-thumb"></i> @endif
                                                        </span>
                                                        <span class="cat-name">{{$cat_info->title}}</span>
                                                        <span class="cat-count badge">{{$cat_info->products()->count()}}</span>
                                                    </a>
                                                </li>
											@endforeach
										@endif
                                    </ul>
                                </div>
                                
                                <!-- Shop By Price Widget -->
                                <div class="single-widget price-widget">
                                    <h3 class="widget-title">FILTER BY PRICE</h3>
                                    <div class="price-filter-modern">
                                        <div class="custom-radio">
                                            <input type="radio" id="price-all" name="price_range" value="" @if(empty($_GET['price'])) checked @endif>
                                            <label for="price-all">All Prices</label>
                                        </div>
                                        <div class="custom-radio">
                                            <input type="radio" id="price-300" name="price_range" value="0-300" @if(!empty($_GET['price']) && $_GET['price']=='0-300') checked @endif>
                                            <label for="price-300">Under Rs: 300</label>
                                        </div>
                                        <div class="custom-radio">
                                            <input type="radio" id="price-500" name="price_range" value="300-500" @if(!empty($_GET['price']) && $_GET['price']=='300-500') checked @endif>
                                            <label for="price-500">Rs: 300 - Rs: 500</label>
                                        </div>
                                        <div class="custom-radio">
                                            <input type="radio" id="price-above" name="price_range" value="500-10000" @if(!empty($_GET['price']) && $_GET['price']=='500-10000') checked @endif>
                                            <label for="price-above">Above Rs: 500</label>
                                        </div>
                                        
                                        <button type="submit" class="btn-apply-filter">Apply Filter</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    
                    <!-- PRODUCTS AREA -->
                    <div class="col-lg-9 col-md-12 col-12 order-1 order-lg-2">
                        <div class="shop-top-modern">
                            <div class="shop-top-left">
                                <h2>
                                    @php 
                                        $catTitle = "ALL ITEMS";
                                        if(Request::route('slug')) {
                                            $cat = App\Models\Category::where('slug', Request::route('slug'))->first();
                                            if($cat) $catTitle = strtoupper($cat->title);
                                        }
                                    @endphp
                                    {{$catTitle}} 
                                    <span class="item-count">{{count($products)}} ITEMS</span>
                                </h2>
                            </div>
                            <div class="shop-top-right d-flex align-items-center" style="gap: 15px;">
                                <div class="search-bar-modern">
                                    <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" class="modern-search-input">
                                    <button type="submit" class="modern-search-btn"><i class="ti-search"></i></button>
                                </div>
                                <div class="sort-by-modern d-none d-lg-flex align-items-center">
                                    <span style="font-size: 13px; font-weight: 600; color: #555; margin-right: 10px; white-space: nowrap;">Sort by</span>
                                    <select class="modern-select" name="sortBy" onchange="this.form.submit();">
                                        <option value="default">Featured</option>
                                        <option value="title" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title') selected @endif>Name</option>
                                        <option value="price" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price') selected @endif>Price</option>
                                        <option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category') selected @endif>Category</option>
                                        <option value="brand" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand') selected @endif>Brand</option>
                                    </select>
                                </div>
                            </div>
                        </div>
<!-- MOBILE SEARCH, FILTER & CATEGORIES (Matches Mockup exactly) -->
<div class="mobile-filter-cat-area d-block d-lg-none mt-3 mb-4">
    <!-- Top Row: Search and Filter -->
    <div class="d-flex align-items-center mb-4" style="gap: 12px;">
        <div class="mobile-search-box" style="flex-grow: 1; position: relative;">
            <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" style="width: 100%; border: 1px solid #eee; border-radius: 8px; padding: 12px 40px 12px 15px; font-size: 13px; outline: none; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
            <button type="submit" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #F7941D; font-size: 16px;"><i class="ti-search"></i></button>
        </div>
        <button type="button" onclick="$('.mobile-price-filter').slideToggle();" style="background: #fff; border: 1px solid #eee; border-radius: 8px; padding: 12px 18px; font-weight: 600; color: #333; display: flex; align-items: center; gap: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); white-space: nowrap;">
            <i class="ti-filter" style="color: #F7941D; font-size: 16px;"></i> Filter
        </button>
    </div>

    <!-- Hidden Mobile Price Filter -->
    <div class="mobile-price-filter" style="display: none; background: #fff; border-radius: 12px; padding: 15px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #eee;">
        <h4 style="font-size: 13px; font-weight: 700; margin-bottom: 15px; color: #111;">FILTER BY PRICE</h4>
        <div class="custom-radio"><input type="radio" name="price_range" value="all" id="m_price_all" checked><label for="m_price_all">All Prices</label></div>
        <div class="custom-radio"><input type="radio" name="price_range" value="under_300" id="m_price_1"><label for="m_price_1">Under Rs: 300</label></div>
        <div class="custom-radio"><input type="radio" name="price_range" value="300_500" id="m_price_2"><label for="m_price_2">Rs: 300 - Rs: 500</label></div>
        <div class="custom-radio"><input type="radio" name="price_range" value="above_500" id="m_price_3"><label for="m_price_3">Above Rs: 500</label></div>
        <button type="submit" class="btn-apply-filter" style="margin-top: 10px; padding: 10px; width: 100%; background: #F7941D; color: #fff; border: none; border-radius: 8px; font-weight: 600;">Apply Filter</button>
    </div>
    
    <!-- Horizontal scrolling categories (Circular) -->
    <div class="mobile-categories-scroll" style="display: flex; overflow-x: auto; gap: 15px; padding-bottom: 15px; padding-top: 5px; scrollbar-width: none;">
        <a href="{{route('product-grids')}}" class="mobile-cat-circle {{ Request::is('product-grids') ? 'active' : '' }}">
            <div class="icon-wrap">
                <i class="ti-layout-grid2" style="font-size:22px;"></i>
                <span class="m-badge">{{App\Models\Product::where('status','active')->count()}}</span>
            </div>
            <span class="cat-text">All Items</span>
        </a>
        @php
            $mobile_menu=App\Models\Category::getAllParentWithChild();
        @endphp
        @if($mobile_menu)
            @foreach($mobile_menu as $cat_info)
                <a href="{{route('product-cat',$cat_info->slug)}}" class="mobile-cat-circle {{ Request::is('product-cat/'.$cat_info->slug) ? 'active' : '' }}">
                    <div class="icon-wrap">
                        @if(stripos($cat_info->title, 'nimco') !== false) <img src="https://cdn-icons-png.flaticon.com/512/3256/3256114.png" alt="">
                        @elseif(stripos($cat_info->title, 'biscuit') !== false) <img src="https://cdn-icons-png.flaticon.com/512/2619/2619574.png" alt="">
                        @elseif(stripos($cat_info->title, 'sweet') !== false) <img src="https://cdn-icons-png.flaticon.com/512/3014/3014491.png" alt="">
                        @else <i class="ti-layout-list-thumb" style="font-size:22px;"></i> @endif
                        <span class="m-badge">{{$cat_info->products()->count()}}</span>
                    </div>
                    <span class="cat-text">{{$cat_info->title}}</span>
                </a>
            @endforeach
        @endif
    </div>
</div>

                        <div class="row modern-products-grid" style="margin: 0 -5px;">
                            @if(count($products)>0)
                                @foreach($products as $product)
                                    <div class="col-lg-4 col-md-6 col-6 mb-4" style="padding: 0 5px;">
                                        <div class="modern-product-card @if($product->stock<=0) card-soldout @endif">
                                            <!-- Top Badges -->
                                            <div class="card-badges">
                                                
                                                @if($product->discount)
                                                    <span class="badge-discount">{{$product->discount}}%</span>
                                                @endif
                                                @if($product->stock<=0)
                                                    <span class="badge-soldout">SOLD OUT</span>
                                                @endif
                                            </div>
                                            
                                            <!-- Wishlist Button -->
                                            <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn-wishlist-modern"><i class="ti-heart"></i></a>
                                            
                                            <div class="product-img-modern">
                                                <a href="{{route('product-detail',$product->slug)}}">
                                                    @php $photo=explode(',',$product->photo); @endphp
                                                    <img src="{{$photo[0]}}" alt="{{$product->title}}">
                                                </a>
                                            </div>
                                            
                                            <div class="product-info-modern">
                                                <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                                <p class="product-desc">{!! \Illuminate\Support\Str::limit(strip_tags($product->summary), 55) !!}</p>
                                                
                                                <div class="price-row">
                                                    @php $after_discount=($product->price-($product->price*$product->discount)/100); @endphp
                                                    <span class="current-price">Rs: {{number_format($after_discount,0)}}</span>
                                                    @if($product->discount)
                                                        <span class="old-price"><del>Rs: {{number_format($product->price,0)}}</del></span>
                                                    @endif
                                                </div>
                                                
                                                @if($product->stock<=0)
                                                    <button type="button" class="btn-action-modern btn-soldout" disabled>OUT OF STOCK</button>
                                                @else
                                                    <div class="product-action-modern">
                                                        <a href="{{route('add-to-cart',$product->slug)}}" class="btn-action-modern btn-cart"><i class="ti-shopping-cart"></i> Add to Cart</a>
                                                        <a href="{{route('product-detail',$product->slug)}}" class="btn-action-modern btn-view"><i class="ti-eye"></i> View Details</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12"><h4 class="text-warning text-center mt-5" style="font-family: 'Poppins';">There are no products matching your filter.</h4></div>
                            @endif
                        </div>
                        
                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-12 text-center mt-4 mb-5">
                                @if(method_exists($products, 'links'))
                                    {{$products->appends($_GET)->links()}}
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@push('styles')
<style>
    /* --------------------------------- */
    /* MODERN EXPLORE MENU DESIGN */
    /* --------------------------------- */
    
    body, h1, h2, h3, h4, h5, h6, p, a, span, label, button, input, select {
        font-family: 'Poppins', sans-serif !important;
    }
    
    body {
        background-color: #f8f9fa !important;
    }
    
    /* Hero Section */
    .menu-hero-section {
        background: var(--primary-color, #c1540b);
        padding: 50px 0 100px;
        color: #fff;
    }
    .bread-list-modern {
        display: flex;
        align-items: center;
        list-style: none;
        padding: 0;
        margin: 0 0 10px 0;
        font-size: 13px;
        color: #9ba4b5;
    }
    .bread-list-modern li a {
        color: #9ba4b5;
        text-decoration: none;
        transition: color 0.3s;
    }
    .bread-list-modern li a:hover {
        color: #fff;
    }
    .bread-list-modern li span {
        margin: 0 10px;
    }
    .bread-list-modern li.active {
        color: #fff;
        font-weight: 500;
    }
    .hero-title {
        font-size: 48px !important;
        font-weight: 900 !important;
        margin: 0;
        letter-spacing: 1px;
    }
    
    /* Desktop layout overrides */
    @media (min-width: 992px) {
        .product-page-sidebar {
            margin-top: 20px;
            position: relative;
            z-index: 10;
        }
        .shop-top-modern {
            margin-top: 20px;
            position: relative;
            z-index: 10;
        }
    }

    /* Sidebar */
    .single-widget {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        border: none;
    }
    .widget-title {
        font-size: 15px !important;
        font-weight: 800 !important;
        color: #111;
        margin-bottom: 25px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 10px;
        letter-spacing: 0.5px;
    }
    
    .categor-list-modern {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .categor-list-modern li {
        margin-bottom: 8px;
    }
    .categor-list-modern li a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        border-radius: 30px;
        color: #444;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        background: transparent;
    }
    .categor-list-modern li a .cat-icon {
        margin-right: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background: #f4f5f7;
        border-radius: 50%;
        color: #888;
        font-size: 14px;
    }
    .categor-list-modern li a .cat-count {
        margin-left: auto;
        background: #f0f0f0;
        color: #666;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }
    
    /* Active & Hover state for Categories (like mockup) */
    .categor-list-modern li a:hover,
    .categor-list-modern li a.active {
        background: #fff0ef;
        color: #F7941D;
    }
    .categor-list-modern li a:hover .cat-icon,
    .categor-list-modern li a.active .cat-icon {
        background: #fff;
        color: #F7941D;
    }
    .categor-list-modern li a:hover .cat-icon img,
    .categor-list-modern li a.active .cat-icon img {
        opacity: 1 !important;
        filter: sepia(1) hue-rotate(-50deg) saturate(5);
    }
    .categor-list-modern li a:hover .cat-count,
    .categor-list-modern li a.active .cat-count {
        background: #F7941D;
        color: #fff;
    }
    
    /* Price Filter */
    .custom-radio {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    .custom-radio input[type="radio"] {
        width: 18px;
        height: 18px;
        margin-right: 12px;
        accent-color: #F7941D;
        cursor: pointer;
    }
    .custom-radio label {
        font-size: 14px;
        font-weight: 500;
        color: #444;
        cursor: pointer;
        margin: 0;
    }
    .btn-apply-filter {
        width: 100%;
        padding: 12px;
        background: #f4f5f7;
        color: #222;
        border: none;
        border-radius: 30px;
        font-weight: 700;
        font-size: 14px;
        margin-top: 15px;
        transition: all 0.3s ease;
    }
    .btn-apply-filter:hover {
        background: #e2e4e8;
    }
    
    /* Shop Top */
    .shop-top-modern {
        background: #fff;
        border-radius: 16px;
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .shop-top-left h2 {
        font-size: 16px !important;
        font-weight: 800 !important;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
        color: #111;
        letter-spacing: 0.5px;
    }
    .shop-top-left .item-count {
        font-size: 11px;
        background: #f0f0f0;
        color: #666;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .shop-top-right {
        display: flex;
        align-items: center;
    }
    
    .search-bar-modern {
        display: flex;
        align-items: center;
        background: #eff2f6;
        border-radius: 30px;
        padding: 5px 15px;
        border: 1px solid #e1e4e8;
    }
    
    .modern-search-input {
        border: none;
        background: transparent;
        padding: 8px 10px;
        font-size: 14px;
        outline: none;
        width: 200px;
        color: #333;
    }
    
    .modern-search-btn {
        background: var(--primary-color, #c1540b);
        color: #fff;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.3s;
    }
    
    .modern-search-btn:hover {
        background: #333;
    }
    .modern-select {
        border: 1px solid #eee;
        background: #fafafa;
        padding: 8px 30px 8px 15px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 13px;
        color: #333;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23333%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 10px auto;
        cursor: pointer;
    }
    
    /* Product Cards */
    .modern-product-card {
        background: #fff;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        position: relative;
        transition: all 0.4s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .modern-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    }
    .card-soldout {
        opacity: 0.6;
    }
    
    .card-badges {
        position: absolute;
        top: 20px;
        left: 20px;
        display: flex;
        flex-direction: column;
        gap: 5px;
        z-index: 5;
    }
    .card-badges span {
        font-size: 9px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 6px;
        color: #fff;
        letter-spacing: 0.5px;
    }
    .badge-bestseller { background: #fdb813; color: #fff; }
    .badge-discount { background: #111; color: #fff; }
    .badge-soldout { background: #6c757d; color: #fff; }
    
    .btn-wishlist-modern {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ff4757;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        font-size: 16px;
        font-weight: bold;
        z-index: 5;
        transition: all 0.3s ease;
    }
    .btn-wishlist-modern:hover {
        background: #ff4757;
        color: #ffffff;
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(255, 71, 87, 0.3);
    }
    
    .product-img-modern {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        margin-top: 25px;
    }
    .product-img-modern img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.5s ease;
    }
    .modern-product-card:not(.card-soldout):hover .product-img-modern img {
        transform: scale(1.08);
    }
    
    .product-info-modern {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .product-info-modern h3 {
        margin: 0 0 8px 0;
    }
    .product-info-modern h3 a {
        font-size: 16px;
        font-weight: 800;
        color: #111;
        text-decoration: none;
        line-height: 1.4;
    }
    .product-desc {
        font-size: 12px;
        color: #888;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
    }
    
    .price-row {
        margin-top: auto;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .current-price {
        font-size: 22px;
        font-weight: 900;
        color: #111;
    }
    .old-price del {
        font-size: 13px;
        font-weight: 600;
        color: #aaa;
    }
    
    .product-action-modern {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    
    .btn-action-modern {
        flex: 1;
        text-align: center;
        padding: 10px 5px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
    
    .btn-cart {
        background: #F7941D;
        color: #ffffff !important;
    }
    
    .btn-cart i {
        color: #ffffff !important;
    }
    
    .btn-cart:hover {
        background: #F7941D;
        filter: brightness(0.85);
        color: #ffffff !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    
    .btn-view {
        background: #f4f5f7;
        color: #333 !important;
    }
    
    .btn-view i {
        color: #333 !important;
    }
    
    .btn-view:hover {
        background: #e2e4e8;
        color: #111 !important;
        transform: translateY(-2px);
    }
    
    .btn-soldout {
        background: #e9ecef !important;
        color: #888 !important;
        cursor: not-allowed;
        width: 100%;
        padding: 12px;
        border-radius: 8px;
    }
    .btn-soldout:hover {
        transform: none;
        box-shadow: none;
    }
    

    @media (max-width: 768px) {
        .shop-top-modern {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
            padding: 15px;
        }
        .shop-top-right {
            width: 100%;
        }
        .search-bar-modern {
            width: 100%;
        }
        .modern-search-input {
            width: 100%;
        }
        
        /* Buttons layout on mobile */
        .product-action-modern {
            flex-direction: column;
            gap: 8px;
        }
        .btn-action-modern {
            width: 100%;
            padding: 8px 5px;
            font-size: 12px;
        }
        
        /* Reduce card padding on mobile */
        .modern-product-card {
            padding: 12px;
            border-radius: 12px;
        }
        .product-info-modern h3 a {
            font-size: 14px;
        }
        .current-price {
            font-size: 16px;
        }
        .card-badges span {
            font-size: 8px;
            padding: 3px 6px;
        }
        .product-img-modern {
            height: 120px;
        }
    }
    
    /* OVERRIDES FOR PERFECT MOCKUP MATCH */
    .product-action-modern {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
    .btn-action-modern {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 5px !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 12px !important;
        text-decoration: none !important;
        transition: all 0.3s;
        flex: 1; /* Equal width */
    }
    .btn-cart {
        background: #F7941D !important;
        color: #fff !important;
        border: 1px solid #F7941D !important;
    }
    .btn-cart:hover {
        background: #e08316 !important;
        border-color: #e08316 !important;
    }
    .btn-view {
        background: #fff !important;
        color: #555 !important;
        border: 1px solid #e0e0e0 !important;
    }
    .btn-view:hover {
        border-color: #F7941D !important;
        color: #F7941D !important;
    }
    
    .price-row {
        display: flex;
        align-items: baseline;
        gap: 8px;
        margin-top: auto;
        margin-bottom: 10px;
    }
    .current-price {
        font-size: 18px !important;
        font-weight: 800 !important;
        color: #111 !important;
    }
    .old-price del {
        font-size: 13px !important;
        font-weight: 500 !important;
        color: #aaa !important;
    }
    
    .product-info-modern h3 a {
        font-size: 15px !important;
        font-weight: 700 !important;
        color: #111 !important;
    }
    
    .card-badges span {
        font-size: 10px !important;
        font-weight: 700 !important;
        padding: 4px 8px !important;
        border-radius: 4px !important;
        color: #fff !important;
        text-transform: uppercase !important;
    }
    .badge-bestseller { background: #F7941D !important; }
    
    .btn-wishlist-modern {
        background: #fff !important;
        border: 1px solid #eee !important;
        color: #ff4757 !important;
    }
    
    .modern-product-card {
        border-radius: 12px !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04) !important;
        border: 1px solid #f5f5f5 !important;
    }
    
    .widget-title {
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #222 !important;
    }
    .widget-title i { display: none !important; }
    
    .categor-list-modern li a.active, .categor-list-modern li a:hover {
        background: #fff0e6 !important;
        color: #F7941D !important;
    }
    
    .shop-top-modern {
        border-radius: 12px !important;
        padding: 15px 25px !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02) !important;
        border: 1px solid #f2f2f2 !important;
    }
    .shop-top-left h2 {
        font-size: 18px !important;
        font-weight: 700 !important;
        color: #111 !important;
    }
    .modern-search-input {
        background: #fafafa !important;
        border-radius: 8px !important;
    }
    .modern-select {
        background: #fafafa !important;
        border-radius: 8px !important;
    }
    
    /* Mobile specific fixes */
    .btn-mobile-filter {
        width: 100%;
        background: #F7941D;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 15px;
    }
    .mobile-categories-scroll {
        display: flex;
        overflow-x: auto;
        gap: 10px;
        padding-bottom: 10px;
        scrollbar-width: none;
    }
    .mobile-categories-scroll::-webkit-scrollbar { display: none; }
    .mobile-cat-pill {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #fff;
        padding: 12px 10px;
        border-radius: 12px;
        min-width: 80px;
        text-decoration: none !important;
        color: #555;
        font-size: 11px;
        font-weight: 600;
        border: 1px solid #eee;
    }
    .mobile-cat-pill.active {
        background: #fff0e6;
        color: #F7941D;
        border-color: #ffd8cc;
    }
    .mobile-cat-pill img { width: 24px; height: 24px; margin-bottom: 8px; opacity: 0.6; }
    .mobile-cat-pill.active img { opacity: 1; filter: sepia(1) hue-rotate(-50deg) saturate(5); }
    
    @media (max-width: 768px) {
        .shop-top-modern { display: none !important; }
        .modern-product-card { padding: 12px !important; }
        .product-img-modern { height: 120px !important; margin-top: 10px !important; }
        .product-info-modern h3 a { font-size: 13px !important; }
        .product-desc { font-size: 11px !important; margin-bottom: 10px !important; }
        .current-price { font-size: 15px !important; }
        .old-price del { font-size: 11px !important; }
        .btn-view { display: none !important; }
        .btn-action-modern { padding: 8px 5px !important; font-size: 11px !important; }
    }


    /* CARD HEIGHT & GRID FIXES */
    .modern-products-grid {
        display: flex !important;
        flex-wrap: wrap !important;
    }
    .modern-products-grid > [class*="col-"] {
        display: flex !important;
        flex-direction: column !important;
        margin-bottom: 25px !important;
    }
    .modern-product-card {
        flex: 1 1 auto !important; /* Forces card to stretch to match sibling heights */
        width: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
    }
    .product-info-modern {
        display: flex !important;
        flex-direction: column !important;
        flex-grow: 1 !important; /* Takes up remaining space */
    }
    
    /* Lock image container sizes */
    .product-img-modern {
        height: 180px !important;
        min-height: 180px !important;
        max-height: 180px !important;
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        overflow: hidden !important;
    }
    .product-img-modern img {
        width: 100% !important;
        height: 100% !important;
        object-fit: contain !important; /* Contains any image ratio inside the 180px box perfectly */
    }
    
    /* Standardize Title & Desc Heights so they align beautifully */
    .product-info-modern h3 {
        margin-bottom: 5px !important;
        min-height: 42px !important; /* Space for 2 lines */
    }
    .product-info-modern h3 a {
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        line-height: 1.4 !important;
    }
    
    .product-desc {
        min-height: 36px !important; /* Space for 2 lines */
        margin-bottom: 15px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        line-height: 1.4 !important;
    }
    
    /* Force price and buttons to the bottom */
    .price-row {
        margin-top: auto !important;
        margin-bottom: 15px !important;
    }
    .product-action-modern {
        margin-top: 0 !important; /* Auto handled by price-row */
    }
    
    @media (max-width: 768px) {
        .product-img-modern {
            height: 120px !important;
            min-height: 120px !important;
            max-height: 120px !important;
        }
        .product-info-modern h3 {
            min-height: 38px !important;
        }
        .product-desc {
            min-height: 32px !important;
            margin-bottom: 10px !important;
        }
    }


    /* Fix top overlap */
    @media (min-width: 992px) {
        .product-page-sidebar, .col-lg-9, .shop-top-modern {
            margin-top: 20px !important;
        }
    }


    @media (max-width: 768px) {
        .menu-hero-section {
            padding: 40px 0 80px 0 !important;
            background-image: linear-gradient(to right, rgba(11, 29, 46, 0.9) 0%, rgba(11, 29, 46, 0.8) 100%), url('{{asset('frontend/img/explore-banner-bg.png')}}') !important;
        }
        .hero-title {
            font-size: 32px !important;
        }
        .hero-subtitle {
            font-size: 14px !important;
        }
        .hero-wave svg {
            height: 40px !important;
        }
    }


    /* VISIBILITY OVERRIDES: Shadow & Body Color */
    body { background-color: #eff2f6 !important; }
    
    .modern-product-card {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08) !important;
        border: none !important;
    }
    
    .single-widget {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08) !important;
        border: none !important;
    }
    
    .shop-top-modern {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08) !important;
        border: none !important;
    }
    
    /* Enhance the hover effect slightly so it lifts off the page */
    .modern-product-card:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12) !important;
        transform: translateY(-5px) !important;
    }


    
    /* Ribbon & Wishlist Overrides */
    .card-badges {
        position: absolute !important;
        top: 15px !important;
        left: 15px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 5px !important;
        margin: 0 !important;
        z-index: 5 !important;
    }
    .badge-discount {
        background: #ff4757 !important; /* Beautiful Red for discount */
        color: #fff !important;
        border-radius: 6px !important; /* Soft corners */
        padding: 5px 10px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 10px rgba(255, 71, 87, 0.3) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        display: inline-block;
    }
    .btn-wishlist-modern {
        background: #ff4757 !important; /* Solid red by default */
        border: none !important;
        color: #ffffff !important; /* White heart */
        box-shadow: 0 4px 12px rgba(255, 71, 87, 0.25) !important;
        border-radius: 50% !important;
    }
    .btn-wishlist-modern:hover {
        background: #e8414f !important; /* Slightly darker on hover */
        transform: scale(1.05) !important;
    }



    /* COLOR THEME & FULL IMAGE WIDTH FIXES */
    .badge-discount {
        background: #F7941D !important; /* Theme Orange */
        color: #fff !important;
    }
    .btn-wishlist-modern {
        background: #F7941D !important; /* Theme Orange */
        color: #fff !important;
    }
    .btn-wishlist-modern:hover {
        background: #e08316 !important;
    }
    
    /* Remove padding from card, apply to content so image is edge-to-edge at the top */
    .modern-product-card {
        padding: 0 !important;
    }
    .product-img-modern {
        margin: 0 !important;
        border-radius: 12px 12px 0 0 !important;
        height: 220px !important; /* Slightly taller to look majestic */
        background: #fff;
    }
    .product-img-modern img {
        object-fit: cover !important; /* Forces the image to fill the entire space beautifully */
    }
    .product-info-modern {
        padding: 15px 20px 20px 20px !important;
    }
    
    @media (max-width: 768px) {
        .product-img-modern {
            height: 140px !important;
        }
        .product-info-modern {
            padding: 10px 12px 12px 12px !important;
        }
    }


    /* CIRCULAR MOBILE CATEGORIES */
    .mobile-cat-circle {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none !important;
        min-width: 65px;
    }
    .mobile-cat-circle .icon-wrap {
        width: 60px;
        height: 60px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        position: relative;
        border: 2px solid transparent;
        margin-bottom: 10px;
        transition: all 0.3s;
    }
    .mobile-cat-circle .icon-wrap img {
        width: 28px;
        height: 28px;
        opacity: 0.6;
    }
    .mobile-cat-circle .icon-wrap i {
        color: #666;
    }
    .mobile-cat-circle .m-badge {
        position: absolute;
        bottom: -2px;
        right: -4px;
        background: #555;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px solid #eff2f6; /* match body background */
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .mobile-cat-circle .cat-text {
        font-size: 12px;
        font-weight: 600;
        color: #444;
        padding-bottom: 4px;
        border-bottom: 2px solid transparent;
    }

    /* Active State */
    .mobile-cat-circle.active .icon-wrap {
        border-color: #F7941D;
        box-shadow: 0 0 0 3px rgba(247, 148, 29, 0.15);
    }
    .mobile-cat-circle.active .icon-wrap img,
    .mobile-cat-circle.active .icon-wrap i {
        opacity: 1;
        color: #F7941D;
        filter: sepia(1) hue-rotate(-50deg) saturate(5); /* Make images orange */
    }
    .mobile-cat-circle.active .m-badge {
        background: #F7941D;
    }
    .mobile-cat-circle.active .cat-text {
        color: #F7941D;
        border-bottom-color: #F7941D;
    }
    
    .mobile-categories-scroll::-webkit-scrollbar {
        display: none;
    }

    /* Hide sidebar completely on mobile so everything is driven from the top */
    @media (max-width: 991px) {
        .product-page-sidebar {
            display: none !important;
        }
    }

</style>
@endpush
@push('scripts')
<script>
    $(document).ready(function() {
        // DataTables-like Instant Search (Live Filter)
        $('.modern-search-input').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            var hasVisible = false;
            
            $('.modern-products-grid .col-lg-4').filter(function() {
                var isVisible = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(isVisible);
                if(isVisible) hasVisible = true;
            });
            
            // Optionally, we could show a "No products found" message here if !hasVisible
        });
        
        // Prevent form submission if they press enter, let the live filter do its job, 
        // OR allow form submission if they want to search server-side across all pages.
        // We'll leave the form submission intact so they can search all pages if they hit Enter.
    });
</script>
@endpush