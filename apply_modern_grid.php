<?php
$file = 'c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/product-grids.blade.php';
$content = file_get_contents($file);

// Let's replace the breadcrumbs with the new dark hero section
$new_breadcrumbs = <<<HTML
    <!-- Modern Hero Section -->
    <div class="menu-hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="bread-list-modern">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><span>/</span></li>
                        <li class="active">Our Menu</li>
                    </ul>
                    <h1 class="hero-title">EXPLORE <span class="text-primary">MENU</span></h1>
                </div>
            </div>
        </div>
    </div>
HTML;
$content = preg_replace('/<!-- Breadcrumbs -->.*?<!-- End Breadcrumbs -->/s', $new_breadcrumbs, $content);

// Let's replace the whole shop-sidebar section to match the modern design
$new_sidebar = <<<HTML
                        <div class="shop-sidebar modern-sidebar">
                                <!-- Categories Widget -->
                                <div class="single-widget category-widget">
                                    <h3 class="widget-title"><i class="ti-layout-grid2 text-primary"></i> CATEGORIES</h3>
                                    <ul class="categor-list-modern">
										@php
											\$menu=App\Models\Category::getAllParentWithChild();
										@endphp
										@if(\$menu)
											@foreach(\$menu as \$cat_info)
                                                <li>
                                                    <a href="{{route('product-cat',\$cat_info->slug)}}" class="{{ Request::is('product-cat/'.\$cat_info->slug) ? 'active' : '' }}">
                                                        <span class="cat-icon"><i class="ti-pie-chart"></i></span>
                                                        <span class="cat-name">{{\$cat_info->title}}</span>
                                                        <span class="cat-count badge">{{\$cat_info->products()->count()}}</span>
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
                                            <input type="radio" id="price-all" name="price" value="" @if(empty(\$_GET['price'])) checked @endif>
                                            <label for="price-all">All Prices</label>
                                        </div>
                                        <div class="custom-radio">
                                            <input type="radio" id="price-300" name="price" value="0-300" @if(!empty(\$_GET['price']) && \$_GET['price']=='0-300') checked @endif>
                                            <label for="price-300">Under Rs: 300</label>
                                        </div>
                                        <div class="custom-radio">
                                            <input type="radio" id="price-500" name="price" value="300-500" @if(!empty(\$_GET['price']) && \$_GET['price']=='300-500') checked @endif>
                                            <label for="price-500">Rs: 300 - Rs: 500</label>
                                        </div>
                                        <div class="custom-radio">
                                            <input type="radio" id="price-above" name="price" value="500-10000" @if(!empty(\$_GET['price']) && \$_GET['price']=='500-10000') checked @endif>
                                            <label for="price-above">Above Rs: 500</label>
                                        </div>
                                        
                                        <button type="submit" class="btn-apply-filter">Apply Filter</button>
                                    </div>
                                </div>
                        </div>
HTML;
$content = preg_replace('/<div class="shop-sidebar">.*?<\/div>.*?<\/div>\s*<div class="col-lg-9/s', $new_sidebar . "\n                    </div>\n                    <div class=\"col-lg-9", $content);

// Replace Shop Top and Products List with modern design
$new_products_area = <<<HTML
                        <div class="shop-top-modern">
                            <div class="shop-top-left">
                                <h2>
                                    @php 
                                        \$catTitle = "ALL ITEMS";
                                        if(Request::route('slug')) {
                                            \$cat = App\Models\Category::where('slug', Request::route('slug'))->first();
                                            if(\$cat) \$catTitle = strtoupper(\$cat->title);
                                        }
                                    @endphp
                                    {{\$catTitle}} 
                                    <span class="item-count">{{count(\$products)}} ITEMS</span>
                                </h2>
                            </div>
                            <div class="shop-top-right">
                                <label>Sort by:</label>
                                <select class="modern-select" name="sortBy" onchange="this.form.submit();">
                                    <option value="default" @if(empty(\$_GET['sortBy'])) selected @endif>Recommended</option>
                                    <option value="title" @if(!empty(\$_GET['sortBy']) && \$_GET['sortBy']=='title') selected @endif>Name</option>
                                    <option value="price" @if(!empty(\$_GET['sortBy']) && \$_GET['sortBy']=='price') selected @endif>Price</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row modern-products-grid">
                            @if(count(\$products)>0)
                                @foreach(\$products as \$product)
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="modern-product-card">
                                            <!-- Top Badges -->
                                            <div class="card-badges">
                                                @if(\$product->condition=='hot')
                                                    <span class="badge-bestseller"><i class="ti-star"></i> BESTSELLER</span>
                                                @endif
                                                @if(\$product->discount)
                                                    <span class="badge-discount">{{\$product->discount}}% OFF</span>
                                                @endif
                                                @if(\$product->stock<=0)
                                                    <span class="badge-soldout">SOLD OUT</span>
                                                @endif
                                            </div>
                                            
                                            <!-- Wishlist Button -->
                                            <a href="{{route('add-to-wishlist',\$product->slug)}}" class="btn-wishlist-modern"><i class="ti-heart"></i></a>
                                            
                                            <div class="product-img-modern">
                                                <a href="{{route('product-detail',\$product->slug)}}">
                                                    @php \$photo=explode(',',\$product->photo); @endphp
                                                    <img src="{{\$photo[0]}}" alt="{{\$photo[0]}}">
                                                </a>
                                            </div>
                                            
                                            <div class="product-info-modern">
                                                <h3><a href="{{route('product-detail',\$product->slug)}}">{{\$product->title}}</a></h3>
                                                <p class="product-desc">{!! strip_tags(\$product->summary) !!}</p>
                                                
                                                <div class="price-row">
                                                    @php \$after_discount=(\$product->price-(\$product->price*\$product->discount)/100); @endphp
                                                    <span class="current-price">Rs: {{number_format(\$after_discount,0)}}</span>
                                                    @if(\$product->discount)
                                                        <span class="old-price"><del>Rs: {{number_format(\$product->price,0)}}</del></span>
                                                    @endif
                                                </div>
                                                
                                                @if(\$product->stock<=0)
                                                    <button type="button" class="btn-add-modern btn-soldout" disabled>OUT OF STOCK</button>
                                                @else
                                                    <a href="{{route('add-to-cart',\$product->slug)}}" class="btn-add-modern"><i class="ti-plus"></i> ADD TO ORDER</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12"><h4 class="text-warning text-center mt-5">There are no products matching your filter.</h4></div>
                            @endif
                        </div>
                        
                        @if(count(\$products) >= 9)
                        <div class="row">
                            <div class="col-12 text-center mt-4 mb-5">
                                <button type="button" class="btn-load-more"><i class="ti-reload"></i> Load More Deliciousness</button>
                            </div>
                        </div>
                        @endif
HTML;

$content = preg_replace('/<div class="shop-top">.*?<\/div>\s*<\/div>\s*<\/div>\s*<div class="row">.*?@if\(count\(\$products\)>0\).*?@endif\s*<\/div>/s', $new_products_area, $content);

// Add the custom CSS at the bottom
$css = <<<HTML
@push('styles')
<style>
    /* --------------------------------- */
    /* MODERN EXPLORE MENU DESIGN */
    /* --------------------------------- */
    
    body {
        background-color: #f8f9fa !important;
    }
    
    .product-area.shop-sidebar {
        padding-top: 40px !important;
        background-color: #f8f9fa !important;
    }

    /* Hero Section */
    .menu-hero-section {
        background: linear-gradient(135deg, #111424 0%, #1e263d 100%);
        padding: 50px 0 60px;
        color: #fff;
    }
    .bread-list-modern {
        display: flex;
        align-items: center;
        list-style: none;
        padding: 0;
        margin: 0 0 15px 0;
        font-family: 'Poppins', sans-serif;
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
        font-family: 'Orbitron', sans-serif;
        font-size: 48px;
        font-weight: 900;
        margin: 0;
        letter-spacing: 1px;
    }
    
    /* Sidebar */
    .modern-sidebar {
        margin-top: -80px; /* Pull up over the hero section */
        position: relative;
        z-index: 10;
    }
    .single-widget {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: none;
    }
    .widget-title {
        font-family: 'Orbitron', sans-serif;
        font-size: 16px !important;
        font-weight: 800 !important;
        color: #222;
        margin-bottom: 20px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 10px;
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
        border-radius: 12px;
        color: #555;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        background: transparent;
    }
    .categor-list-modern li a .cat-icon {
        margin-right: 12px;
        font-size: 16px;
        color: #999;
    }
    .categor-list-modern li a .cat-count {
        margin-left: auto;
        background: #f0f0f0;
        color: #777;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
    }
    .categor-list-modern li a:hover,
    .categor-list-modern li a.active {
        background: #fff0f0;
        color: var(--primary-color);
    }
    .categor-list-modern li a:hover .cat-icon,
    .categor-list-modern li a.active .cat-icon {
        color: var(--primary-color);
    }
    .categor-list-modern li a:hover .cat-count,
    .categor-list-modern li a.active .cat-count {
        background: var(--primary-color);
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
        accent-color: var(--primary-color);
        cursor: pointer;
    }
    .custom-radio label {
        font-family: 'Poppins', sans-serif;
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
        color: #333;
        border: none;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
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
        margin-top: -80px; /* Pull up */
        position: relative;
        z-index: 10;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .shop-top-left h2 {
        font-family: 'Orbitron', sans-serif;
        font-size: 18px;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .shop-top-left .item-count {
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        background: #f0f0f0;
        color: #555;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .shop-top-right {
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #666;
    }
    .modern-select {
        border: 1px solid #eee;
        background: #fafafa;
        padding: 8px 30px 8px 15px;
        border-radius: 8px;
        font-weight: 500;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23333%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 10px auto;
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
        font-family: 'Orbitron', sans-serif;
        font-size: 10px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 6px;
        color: #fff;
    }
    .badge-bestseller { background: #ffaa00; }
    .badge-discount { background: #111; }
    .badge-soldout { background: #6c757d; }
    
    .btn-wishlist-modern {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        background: #f4f5f7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 16px;
        z-index: 5;
        transition: all 0.3s ease;
    }
    .btn-wishlist-modern:hover {
        background: #fff0f0;
        color: var(--primary-color);
        transform: scale(1.1);
    }
    
    .product-img-modern {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        margin-top: 20px;
    }
    .product-img-modern img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.5s ease;
    }
    .modern-product-card:hover .product-img-modern img {
        transform: scale(1.1);
    }
    
    .product-info-modern {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .product-info-modern h3 {
        margin: 0 0 10px 0;
    }
    .product-info-modern h3 a {
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 800;
        color: #222;
        text-decoration: none;
        line-height: 1.3;
    }
    .product-desc {
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #888;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .price-row {
        margin-top: auto;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .current-price {
        font-family: 'Orbitron', sans-serif;
        font-size: 24px;
        font-weight: 900;
        color: #111;
    }
    .old-price del {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #aaa;
    }
    
    .btn-add-modern {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px;
        background: var(--primary-color);
        color: #fff;
        border-radius: 12px;
        font-family: 'Orbitron', sans-serif;
        font-weight: 800;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
    }
    .btn-add-modern:hover {
        background: #a04307;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(193, 84, 11, 0.3);
    }
    .btn-add-modern i {
        margin-right: 5px;
    }
    
    .btn-soldout {
        background: #e9ecef !important;
        color: #888 !important;
        cursor: not-allowed;
    }
    .btn-soldout:hover {
        transform: none;
        box-shadow: none;
    }
    
    .btn-load-more {
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        padding: 12px 30px;
        border-radius: 30px;
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 15px;
        transition: all 0.3s ease;
    }
    .btn-load-more:hover {
        background: var(--primary-color);
        color: #fff;
        box-shadow: 0 8px 20px rgba(193, 84, 11, 0.2);
    }
    
    @media (max-width: 991px) {
        .modern-sidebar {
            margin-top: 0;
            margin-bottom: 30px;
        }
        .shop-top-modern {
            margin-top: 0;
        }
        .hero-title {
            font-size: 36px;
        }
    }
</style>
@endpush
HTML;

$content = str_replace('@endsection', $css . "\n@endsection", $content);

file_put_contents($file, $content);
echo "Modern grid layout applied!";
