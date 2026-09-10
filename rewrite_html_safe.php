<?php
$file = 'resources/views/frontend/index.blade.php';
$lines = file($file);

$clean_featured = <<<HTML
                    <!-- Start Clean Product Card -->
                    <div class="single-product clean-card">
                        <div class="product-img">
                            <a href="{{route('product-detail',\$product->slug)}}">
                                @php \$photo=explode(',',\$product->photo); @endphp
                                <img class="default-img" src="{{\$photo[0]}}" alt="{{\$photo[0]}}">
                            </a>
                            <a class="clean-wishlist" href="{{route('add-to-wishlist',\$product->slug)}}"><i class="ti-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{route('product-detail',\$product->slug)}}">{{\$product->title}}</a></h3>
                            <div class="price-container">
                                @php \$after_discount=(\$product->price-(\$product->price*\$product->discount)/100); @endphp
                                @if(\$product->discount>0)
                                    <del>Rs:{{number_format(\$product->price,2)}}</del>
                                @endif
                                <span class="current-price">Rs:{{number_format(\$after_discount,2)}}</span>
                            </div>
                            <a class="clean-add-cart" href="{{route('add-to-cart',\$product->slug)}}"><i class="ti-plus"></i></a>
                        </div>
                    </div>
                    <!-- End Clean Product Card -->
HTML;

$clean_new = <<<HTML
                        <!-- Start Clean Product Card -->
                        <div class="single-product clean-card">
                            <div class="product-img">
                                <a href="{{route('product-detail',\$product->slug)}}">
                                    @php \$photo=explode(',',\$product->photo); @endphp
                                    <img class="default-img" src="{{\$photo[0]}}" alt="{{\$photo[0]}}">
                                </a>
                                <a class="clean-wishlist" href="{{route('add-to-wishlist',\$product->slug)}}"><i class="ti-heart"></i></a>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{route('product-detail',\$product->slug)}}">{{\$product->title}}</a></h3>
                                <div class="price-container">
                                    @php \$after_discount=(\$product->price-(\$product->price*\$product->discount)/100); @endphp
                                    @if(\$product->discount>0)
                                        <del>Rs:{{number_format(\$product->price,2)}}</del>
                                    @endif
                                    <span class="current-price">Rs:{{number_format(\$after_discount,2)}}</span>
                                </div>
                                <a class="clean-add-cart" href="{{route('add-to-cart',\$product->slug)}}"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <!-- End Clean Product Card -->
HTML;

// We will replace array chunks. 
// Featured is lines 1249 to 1280 (indices 1248 to 1279)
// New Arrivals is lines 1310 to 1341 (indices 1309 to 1340)

// Safely do it by matching the markers in case lines shifted
$new_lines = [];
$in_featured = false;
$in_new = false;
$featured_replaced = false;
$new_replaced = false;

foreach ($lines as $i => $line) {
    if (strpos($line, '<!-- Start Single Product -->') !== false && !$featured_replaced) {
        $in_featured = true;
        $new_lines[] = $clean_featured . "\n";
        continue;
    }
    if ($in_featured) {
        if (strpos($line, '<!-- End Single Product -->') !== false) {
            $in_featured = false;
            $featured_replaced = true;
        }
        continue;
    }

    if (strpos($line, '<!-- Start Single List  -->') !== false && !$new_replaced) {
        $in_new = true;
        $new_lines[] = $clean_new . "\n";
        continue;
    }
    if ($in_new) {
        if (strpos($line, '<!-- End Single List  -->') !== false) {
            $in_new = false;
            $new_replaced = true;
        }
        continue;
    }

    $new_lines[] = $line;
}

file_put_contents($file, implode("", $new_lines));
echo "HTML structure replaced safely using array lines.\n";
