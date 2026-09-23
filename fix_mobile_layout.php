<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// 1. Replace the old mobile-filter-cat-area block
$oldMobileAreaStart = '<div class="mobile-filter-cat-area d-block d-lg-none mt-3 mb-4">';
$oldMobileAreaEnd = '<div class="row modern-products-grid"';

$newMobileArea = '<div class="mobile-filter-cat-area d-block d-lg-none mt-3 mb-4">
    <!-- Top Row: Search and Filter -->
    <div class="d-flex align-items-center mb-4" style="gap: 12px;">
        <div class="mobile-search-box" style="flex-grow: 1; position: relative;">
            <input type="text" name="search" placeholder="Search products..." value="{{ request(\'search\') }}" style="width: 100%; border: 1px solid #eee; border-radius: 8px; padding: 12px 40px 12px 15px; font-size: 13px; outline: none; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
            <button type="submit" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #F7941D; font-size: 16px;"><i class="ti-search"></i></button>
        </div>
        <button type="button" onclick="$(\'.mobile-price-filter\').slideToggle();" style="background: #fff; border: 1px solid #eee; border-radius: 8px; padding: 12px 18px; font-weight: 600; color: #333; display: flex; align-items: center; gap: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); white-space: nowrap;">
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
        <a href="{{route(\'product-grids\')}}" class="mobile-cat-circle {{ Request::is(\'product-grids\') ? \'active\' : \'\' }}">
            <div class="icon-wrap">
                <i class="ti-layout-grid2" style="font-size:22px;"></i>
                <span class="m-badge">{{App\Models\Product::where(\'status\',\'active\')->count()}}</span>
            </div>
            <span class="cat-text">All Items</span>
        </a>
        @php
            $mobile_menu=App\Models\Category::getAllParentWithChild();
        @endphp
        @if($mobile_menu)
            @foreach($mobile_menu as $cat_info)
                <a href="{{route(\'product-cat\',$cat_info->slug)}}" class="mobile-cat-circle {{ Request::is(\'product-cat/\'.$cat_info->slug) ? \'active\' : \'\' }}">
                    <div class="icon-wrap">
                        @if(stripos($cat_info->title, \'nimco\') !== false) <img src="https://cdn-icons-png.flaticon.com/512/3256/3256114.png" alt="">
                        @elseif(stripos($cat_info->title, \'biscuit\') !== false) <img src="https://cdn-icons-png.flaticon.com/512/2619/2619574.png" alt="">
                        @elseif(stripos($cat_info->title, \'sweet\') !== false) <img src="https://cdn-icons-png.flaticon.com/512/3014/3014491.png" alt="">
                        @else <i class="ti-layout-list-thumb" style="font-size:22px;"></i> @endif
                        <span class="m-badge">{{$cat_info->products()->count()}}</span>
                    </div>
                    <span class="cat-text">{{$cat_info->title}}</span>
                </a>
            @endforeach
        @endif
    </div>
</div>

                        <div class="row modern-products-grid"';

$posStart = strpos($c, $oldMobileAreaStart);
$posEnd = strpos($c, $oldMobileAreaEnd);

if ($posStart !== false && $posEnd !== false) {
    $c = substr($c, 0, $posStart) . $newMobileArea . substr($c, $posEnd + strlen($oldMobileAreaEnd));
}


// 2. Append CSS for Circular Mobile Categories and hide sidebar
$mobileCSS = '
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
';

$c = str_replace('</style>', $mobileCSS . "\n</style>", $c);

file_put_contents($f, $c);
echo "Mobile responsive fixes applied!";
?>
