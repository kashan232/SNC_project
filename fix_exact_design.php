<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// 1. Rewrite the Top Bar HTML exactly
$oldTopBarStart = '<div class="shop-top-modern">';
$oldTopBarEnd = '<!-- MOBILE SEARCH, FILTER & CATEGORIES';

$newTopBar = '<div class="shop-top-modern">
    <div class="shop-top-left">
        <h2>
            @php 
                $catTitle = "All Items";
                if(Request::route(\'slug\')) {
                    $cat = App\Models\Category::where(\'slug\', Request::route(\'slug\'))->first();
                    if($cat) $catTitle = $cat->title;
                }
            @endphp
            {{$catTitle}} 
            <span class="item-count">({{count($products)}} items)</span>
        </h2>
    </div>
    <div class="shop-top-right">
        <div class="search-bar-modern">
            <input type="text" name="search" placeholder="Search products..." value="{{ request(\'search\') }}" class="modern-search-input">
            <button type="submit" class="modern-search-btn"><i class="ti-search"></i></button>
        </div>
        <div class="sort-by-modern d-none d-lg-flex">
            <span class="sort-label">Sort by</span>
            <select class="modern-select" name="sortBy" onchange="this.form.submit();">
                <option value="default">Featured</option>
                <option value="title" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'title\') selected @endif>Name</option>
                <option value="price" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'price\') selected @endif>Price</option>
                <option value="category" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'category\') selected @endif>Category</option>
                <option value="brand" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'brand\') selected @endif>Brand</option>
            </select>
        </div>
    </div>
</div>
<!-- MOBILE SEARCH, FILTER & CATEGORIES';

// Find and replace the top bar HTML
$posStart = strpos($c, $oldTopBarStart);
$posEnd = strpos($c, $oldTopBarEnd);
if ($posStart !== false && $posEnd !== false) {
    $c = substr($c, 0, $posStart) . $newTopBar . substr($c, $posEnd + strlen('<!-- MOBILE SEARCH, FILTER & CATEGORIES'));
}

// 2. We need to replace the entire <style> block from @push('styles') to @endpush
$styleStart = "<style>\n    /* --------------------------------- */\n    /* MODERN EXPLORE MENU DESIGN */";
$styleEnd = "</style>";

$posStyleStart = strpos($c, '<style>');
// Let's make sure we find the right <style> block that contains 'MODERN EXPLORE'
$posModern = strpos($c, 'MODERN EXPLORE', $posStyleStart);
if ($posModern !== false) {
    // Find the </style> that closes this block
    $posStyleEnd = strpos($c, '</style>', $posStyleStart);
    
    $newCSS = '<style>
    /* --------------------------------- */
    /* EXACT MOCKUP MATCH DESIGN */
    /* --------------------------------- */
    
    body, h1, h2, h3, h4, h5, h6, p, a, span, label, button, input, select {
        font-family: \'Poppins\', sans-serif !important;
    }
    body { background-color: #f8f9fa !important; }
    
    /* Layout */
    .product-page-sidebar { margin-top: -60px; position: relative; z-index: 10; }
    .col-lg-9 { margin-top: -60px; position: relative; z-index: 10; }
    
    @media (max-width: 991px) {
        .product-page-sidebar, .col-lg-9 { margin-top: 0; }
    }
    
    /* Sidebar Widgets */
    .single-widget {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        border: 1px solid #f2f2f2;
    }
    .widget-title {
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #222;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .widget-title i { display: none; }
    
    /* Categories List */
    .categor-list-modern { list-style: none; padding: 0; margin: 0; }
    .categor-list-modern li { margin-bottom: 8px; }
    .categor-list-modern li a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        border-radius: 10px;
        color: #666;
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .cat-icon {
        width: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }
    .cat-icon img { width: 20px; opacity: 0.5; }
    .cat-name { flex-grow: 1; }
    .cat-count {
        background: #f0f0f0;
        color: #666;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 20px;
    }
    
    /* Active Category */
    .categor-list-modern li a:hover,
    .categor-list-modern li a.active {
        background: #fff0e6;
        color: #F7941D;
    }
    .categor-list-modern li a:hover .cat-icon img,
    .categor-list-modern li a.active .cat-icon img {
        opacity: 1;
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
        margin-bottom: 12px;
    }
    .custom-radio input[type="radio"] {
        appearance: none;
        width: 18px;
        height: 18px;
        border: 2px solid #ccc;
        border-radius: 50%;
        margin-right: 12px;
        outline: none;
        cursor: pointer;
        position: relative;
    }
    .custom-radio input[type="radio"]:checked {
        border-color: #F7941D;
    }
    .custom-radio input[type="radio"]:checked::after {
        content: "";
        position: absolute;
        top: 3px; left: 3px;
        width: 8px; height: 8px;
        background: #F7941D;
        border-radius: 50%;
    }
    .custom-radio label {
        font-size: 14px;
        color: #555;
        cursor: pointer;
        margin: 0;
    }
    .btn-apply-filter {
        width: 100%;
        background: #F7941D;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        margin-top: 10px;
        transition: background 0.3s;
    }
    .btn-apply-filter:hover { background: #e08316; }
    
    /* Shop Top Bar */
    .shop-top-modern {
        background: #fff;
        border-radius: 12px;
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        border: 1px solid #f2f2f2;
    }
    .shop-top-left h2 {
        font-size: 18px !important;
        font-weight: 700 !important;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #111;
    }
    .shop-top-left .item-count {
        font-size: 13px;
        color: #888;
        font-weight: 400;
    }
    .shop-top-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .search-bar-modern {
        position: relative;
        width: 250px;
    }
    .modern-search-input {
        width: 100%;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 10px 40px 10px 15px;
        font-size: 13px;
        background: #fafafa;
        outline: none;
    }
    .modern-search-btn {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #F7941D;
        font-size: 16px;
    }
    .sort-by-modern {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .sort-label {
        font-size: 13px;
        color: #555;
    }
    .modern-select {
        border: 1px solid #eee;
        background: #fafafa;
        padding: 10px 35px 10px 15px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 13px;
        color: #333;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23333%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 10px auto;
        cursor: pointer;
    }
    
    /* Product Cards */
    .modern-product-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f5f5f5;
        position: relative;
        transition: transform 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .modern-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
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
        font-size: 10px;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 4px;
        color: #fff;
        text-transform: uppercase;
    }
    .badge-bestseller { background: #F7941D; }
    .badge-discount { background: #111; }
    .badge-soldout { background: #888; }
    
    .btn-wishlist-modern {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 32px;
        height: 32px;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ff4757;
        font-size: 14px;
        z-index: 5;
        transition: all 0.3s;
    }
    .btn-wishlist-modern:hover {
        background: #ff4757;
        color: #fff;
        border-color: #ff4757;
    }
    
    .product-img-modern {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        margin-top: 15px;
    }
    .product-img-modern img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }
    
    .product-info-modern {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .product-info-modern h3 {
        margin: 0 0 5px 0;
    }
    .product-info-modern h3 a {
        font-size: 15px;
        font-weight: 700;
        color: #111;
        text-decoration: none;
    }
    .product-desc {
        font-size: 12px;
        color: #888;
        margin-bottom: 15px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .price-row {
        margin-top: auto;
        margin-bottom: 15px;
        display: flex;
        align-items: baseline;
        gap: 10px;
    }
    .current-price {
        font-size: 18px;
        font-weight: 800;
        color: #111;
    }
    .old-price del {
        font-size: 13px;
        font-weight: 500;
        color: #aaa;
    }
    
    .product-action-modern {
        display: flex;
        gap: 10px;
        margin-top: auto;
    }
    .btn-action-modern {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 5px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        text-decoration: none !important;
        transition: all 0.3s;
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
        border: 1px solid #ddd !important;
    }
    .btn-view:hover {
        border-color: #F7941D !important;
        color: #F7941D !important;
    }
    
    /* Mobile Overrides */
    .btn-mobile-filter {
        width: 100%;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        color: #333;
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
        .shop-top-modern { display: none; } /* Hide entire top bar on mobile, using custom mobile area */
        .modern-product-card { padding: 12px; }
        .product-img-modern { height: 120px; margin-top: 10px; }
        .product-info-modern h3 a { font-size: 13px; }
        .product-desc { font-size: 11px; margin-bottom: 10px; }
        .current-price { font-size: 15px; }
        .old-price del { font-size: 11px; }
        .btn-view { display: none !important; }
        .btn-action-modern { padding: 8px 5px; font-size: 11px; }
    }
    </style>';

    $c = substr($c, 0, $posStyleStart) . $newCSS . substr($c, $posStyleEnd + 8);
}

// 3. Fix the HTML of buttons. It seems I didn't change them in my code, but let's make sure.
// The code uses: <a href="{{route('add-to-cart',$product->slug)}}" class="btn-action-modern btn-cart"><i class="ti-shopping-cart"></i> Add to Cart</a> (Oops, previous was just 'Cart', let's change to 'Add to Cart')
$c = str_replace('<i class="ti-shopping-cart"></i> Cart</a>', '<i class="ti-shopping-cart"></i> Add to Cart</a>', $c);
$c = str_replace('<i class="ti-eye"></i> View</a>', '<i class="ti-eye"></i> View Details</a>', $c);

file_put_contents($f, $c);
echo "Design fully matched with mockup!";
?>
