<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// 1. Insert the Mobile Categories Scroll block right below the top bar
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

// Insert it right after the closing </div> of shop-top-modern
$c = str_replace('</div>
                        
                        <div class="row modern-products-grid"', '</div>' . $mobileCategoriesHtml . '
                        
                        <div class="row modern-products-grid"', $c);

// 2. Hide sidebar on mobile by default
$c = str_replace('<div class="sidebar-modern">', '<div class="sidebar-modern d-none d-lg-block">', $c);


// 3. Fix the Button styles in CSS
$newStyles = '
    .btn-view {
        background: transparent !important;
        color: #888 !important;
        font-weight: 500 !important;
        box-shadow: none !important;
        padding: 10px 0 !important;
        justify-content: flex-end;
    }
    .btn-view:hover {
        background: transparent !important;
        color: #F7941D !important;
        transform: none !important;
    }
    .btn-cart {
        background: #F7941D !important;
        color: #ffffff !important;
        border-radius: 8px !important;
    }
    .product-action-modern {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 10px;
    }

    /* Mobile Additions */
    .btn-mobile-filter {
        width: 100%;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 10px;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .mobile-categories-scroll {
        display: flex;
        overflow-x: auto;
        gap: 15px;
        padding-bottom: 10px;
        scrollbar-width: none;
    }
    .mobile-categories-scroll::-webkit-scrollbar {
        display: none;
    }
    .mobile-cat-pill {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #fff;
        padding: 12px 10px;
        border-radius: 15px;
        min-width: 80px;
        text-decoration: none !important;
        color: #555;
        font-size: 11px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        border: 1px solid transparent;
        transition: all 0.3s ease;
        text-align: center;
    }
    .mobile-cat-pill.active {
        background: #fff0ef;
        color: #F7941D;
        border-color: #ffd8d4;
    }
    .mobile-cat-pill img {
        width: 24px;
        height: 24px;
        margin-bottom: 8px;
        opacity: 0.6;
    }
    .mobile-cat-pill.active img {
        opacity: 1;
        filter: sepia(1) hue-rotate(-50deg) saturate(5);
    }
';

$c = str_replace('    .btn-view {
        background: #f4f5f7;
        color: #333 !important;
    }', $newStyles, $c);

// 4. Update Mobile Media Query
$mobileMedia = '
    @media (max-width: 768px) {
        .shop-top-modern .shop-top-left h2 {
            display: none; /* Hide ALL ITEMS header on mobile */
        }
        .shop-top-modern {
            padding: 0;
            background: transparent;
            border: none;
        }
        .btn-view {
            display: none !important; /* Hide view details text on mobile */
        }
        .product-action-modern {
            display: block; /* Make cart button full width */
        }
        .btn-cart {
            width: 100%;
        }
        .modern-product-card {
            padding: 10px;
            border-radius: 15px;
        }
        .product-info-modern h3 a {
            font-size: 13px;
        }
        .current-price {
            font-size: 15px;
        }
        .old-price del {
            font-size: 11px;
        }
        .product-img-modern {
            height: 110px;
            margin-top: 15px;
        }
        .modern-search-btn {
            background: transparent;
            color: #F7941D;
        }
    }
';

$c = str_replace('@media (max-width: 768px) {', $mobileMedia . '
    @media (max-width: 768px) { /* keeping original query for safety */', $c);

file_put_contents($f, $c);
echo "Mobile Grid fixed";
?>
