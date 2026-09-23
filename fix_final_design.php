<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// 1. Add 'Sort By' back into shop-top-right and update Search bar HTML
$oldTopRight = '<div class="shop-top-right">
                                <!-- Replaced Sort By with Search Bar -->
                                <div class="search-bar-modern">
                                    <input type="text" name="search" placeholder="Search products..." value="{{ request(\'search\') }}" class="modern-search-input">
                                    <button type="submit" class="modern-search-btn"><i class="ti-search"></i></button>
                                </div>
                            </div>';

$newTopRight = '<div class="shop-top-right d-flex align-items-center" style="gap: 15px;">
                                <div class="search-bar-modern">
                                    <input type="text" name="search" placeholder="Search products..." value="{{ request(\'search\') }}" class="modern-search-input">
                                    <button type="submit" class="modern-search-btn"><i class="ti-search"></i></button>
                                </div>
                                <div class="sort-by-modern d-none d-lg-flex align-items-center">
                                    <span style="font-size: 13px; font-weight: 600; color: #555; margin-right: 10px; white-space: nowrap;">Sort by</span>
                                    <select class="modern-select" name="sortBy" onchange="this.form.submit();">
                                        <option value="default">Featured</option>
                                        <option value="title" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'title\') selected @endif>Name</option>
                                        <option value="price" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'price\') selected @endif>Price</option>
                                        <option value="category" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'category\') selected @endif>Category</option>
                                        <option value="brand" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'brand\') selected @endif>Brand</option>
                                    </select>
                                </div>
                            </div>';

$c = str_replace($oldTopRight, $newTopRight, $c);

// 2. Fix the button text
$c = str_replace('<i class="ti-shopping-cart"></i> Cart</a>', '<i class="ti-shopping-cart"></i> Add to Cart</a>', $c);
$c = str_replace('<i class="ti-eye"></i> View</a>', '<i class="ti-eye"></i> View Details</a>', $c);

// 3. Insert Mobile Categories block
$mobileCategoriesHtml = '
<!-- MOBILE SEARCH, FILTER & CATEGORIES (Matches Mockup exactly) -->
<div class="mobile-filter-cat-area d-block d-lg-none mt-3 mb-4">
    <!-- Filter Toggle Button for mobile -->
    <button type="button" class="btn-mobile-filter mb-3" onclick="$(\'.sidebar-modern\').toggle();">
        <i class="ti-filter"></i> Filter
    </button>
    
    <!-- Horizontal scrolling categories -->
    <div class="mobile-categories-scroll">
        <a href="{{route(\'product-grids\')}}" class="mobile-cat-pill {{ Request::is(\'product-grids\') ? \'active\' : \'\' }}">
            <i class="ti-layout-grid2" style="font-size:24px; margin-bottom:5px;"></i>
            All Items
        </a>
        @php
            $mobile_menu=App\Models\Category::getAllParentWithChild();
        @endphp
        @if($mobile_menu)
            @foreach($mobile_menu as $cat_info)
                <a href="{{route(\'product-cat\',$cat_info->slug)}}" class="mobile-cat-pill {{ Request::is(\'product-cat/\'.$cat_info->slug) ? \'active\' : \'\' }}">
                    @if(stripos($cat_info->title, \'nimco\') !== false) <img src="https://cdn-icons-png.flaticon.com/512/3256/3256114.png" alt="">
                    @elseif(stripos($cat_info->title, \'biscuit\') !== false) <img src="https://cdn-icons-png.flaticon.com/512/2619/2619574.png" alt="">
                    @elseif(stripos($cat_info->title, \'sweet\') !== false) <img src="https://cdn-icons-png.flaticon.com/512/3014/3014491.png" alt="">
                    @else <i class="ti-layout-list-thumb" style="font-size:24px; margin-bottom:5px;"></i> @endif
                    {{$cat_info->title}}
                </a>
            @endforeach
        @endif
    </div>
</div>
';
$c = str_replace('</div>
                        
                        <div class="row modern-products-grid"', '</div>' . $mobileCategoriesHtml . '
                        
                        <div class="row modern-products-grid"', $c);

// Hide sidebar on mobile by default
$c = str_replace('<div class="sidebar-modern">', '<div class="sidebar-modern d-none d-lg-block">', $c);

// 4. Append the PERFECT CSS overrides right before </style>
$overrideCSS = '
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
';

$c = str_replace('</style>', $overrideCSS . "\n</style>", $c);

// Clean up duplicate old @media blocks that mess up layout
$badBlockStart = '@media (max-width: 768px) { /* keeping original query for safety */';
$pos = strpos($c, $badBlockStart);
if ($pos !== false) {
    // Find the end of this block by searching for the next '@media' or '</style>'
    $nextMedia = strpos($c, '@media', $pos + 10);
    $endStyle = strpos($c, '</style>', $pos);
    $endPos = ($nextMedia !== false && $nextMedia < $endStyle) ? $nextMedia : $endStyle;
    
    $c = substr($c, 0, $pos) . substr($c, $endPos);
}

file_put_contents($f, $c);
echo "Design restored and perfected!";
?>
