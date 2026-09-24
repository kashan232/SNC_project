<?php
$f_index = 'resources/views/frontend/index.blade.php';
$f_grids = 'resources/views/frontend/pages/product-grids.blade.php';

$c_index = file_get_contents($f_index);
$c_grids = file_get_contents($f_grids);

// 1. Extract the CSS from product-grids
$cssStart = strpos($c_grids, '<style>');
$cssEnd = strpos($c_grids, '</style>');
$cssBlock = substr($c_grids, $cssStart, $cssEnd - $cssStart + 8);

// 2. We only need the modern-product-card styles. It's safer to just inject the whole <style> 
// block at the end of index.blade.php before @endpush, or just at the end of the file.
// But to avoid clashing, I'll only append it if it doesn't exist.
if (strpos($c_index, '.modern-product-card {') === false) {
    // Append the CSS block before @endpush or at the end of the file
    if (strpos($c_index, '@endpush') !== false) {
        $c_index = str_replace('@endpush', $cssBlock . "\n@endpush", $c_index);
    } else {
        $c_index .= "\n" . $cssBlock;
    }
}

// 3. Replace the old card HTML in index.blade.php Isotope Grid
$oldCardStart = '<div class="single-product clean-card anime-card">';
$oldCardEnd = '</div>
                                </div>
                            </div>
                        </div>'; // Needs careful regex to match the inner card

// Using regex to find the .single-product inside isotope-grid
$pattern = '/<div class="single-product clean-card anime-card".*?<\/div>\s*<\/div>\s*<\/div>\s*<\/div>/s';

$modernCardHTML = '
<div class="modern-product-card {{ $product->stock<=0 ? \'card-soldout\' : \'\' }} anime-card">
    <div class="card-badges">
        @if($product->stock<=0)
            <span class="badge-soldout">Sold Out</span>
        @elseif($product->condition==\'hot\')
            <span class="badge-bestseller"><i class="ti-star"></i> Bestseller</span>
        @endif
        @if($product->discount)
            <span class="badge-discount">{{$product->discount}}%</span>
        @endif
    </div>
    
    <a href="{{route(\'add-to-wishlist\',$product->slug)}}" class="btn-wishlist-modern"><i class="ti-heart"></i></a>
    
    <div class="product-img-modern">
        <a href="{{route(\'product-detail\',$product->slug)}}">
            @php $photo=explode(\',\',$product->photo); @endphp
            <img src="{{$photo[0]}}" alt="{{$product->title}}">
        </a>
    </div>
    
    <div class="product-info-modern">
        <h3><a href="{{route(\'product-detail\',$product->slug)}}">{{$product->title}}</a></h3>
        
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
                <a href="{{route(\'add-to-cart\',$product->slug)}}" class="btn-action-modern btn-cart"><i class="ti-shopping-cart"></i> Add to Cart</a>
                <a href="{{route(\'product-detail\',$product->slug)}}" class="btn-action-modern btn-view"><i class="ti-eye"></i> View Details</a>
            </div>
        @endif
    </div>
</div>
';

// Wait, the isotope item looks like:
// <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->cat_info->title}}">
//     <div class="single-product clean-card anime-card">...</div>
// </div>
// So I should replace everything inside `<div class="col-sm-6... isotope-item...">` up to its closing div.

$c_index = preg_replace(
    '/(<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item \{\{\$product->cat_info->title\}\}">\s*)<div class="single-product clean-card anime-card".*?(?=\s*<\/div>\s*@endforeach)/s',
    '$1' . $modernCardHTML,
    $c_index
);

file_put_contents($f_index, $c_index);
echo "Cards updated in Our Products section!";
?>
