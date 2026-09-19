<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// STEP 1: Headings
$new_featured = '<h2 style="font-family: \'Orbitron\', sans-serif;font-size: 32px;font-weight: 800;color: #fff!important;margin-top: 10px;">Featured <span style="/* color: var(--primary-color); */">Products</span></h2>';
$c = preg_replace('/\<h2 style="[^"]*?"\>Featured \<span style="[^"]*?"\>Products\<\/span\>\<\/h2\>/is', $new_featured, $c);

$new_our_products = '<h2 style="font-family: \'Orbitron\', sans-serif;font-size: 32px;font-weight: 800;color: #fff!important;margin-top: 10px;">Our <span style="/* color: var(--primary-color); */">Products</span></h2>';
$c = preg_replace('/\<h2 style="[^"]*?"\>Our \<span style="[^"]*?"\>Products\<\/span\>\<\/h2\>/is', $new_our_products, $c);


// STEP 2: Add our-products-area
$c = preg_replace('/\<div class="product-area section"\>(\s*\<div class="container"\>\s*\<div class="row"\>\s*\<div class="col-12"\>\s*\<div class="section-title text-center" style="margin-bottom: 50px;"\>\s*\<span.*?Explore Collection)/s', '<div class="product-area section our-products-area">$1', $c);


// STEP 3: Move button-head AFTER product-content in our-products-area only
$start = strpos($c, 'our-products-area');
$end = strpos($c, 'our-outlets-premium'); // No! our-outlets-premium DOES NOT exist? Wait! I just saw it at 3308! So it DOES exist!
// Let's use it.
if ($start !== false && $end !== false) {
    $before = substr($c, 0, $start);
    $block = substr($c, $start, $end - $start);
    $after = substr($c, $end);
    
    $block = preg_replace_callback('/(\<div class="single-product".*?\>)(.*?)(\<\/div\>\s*\<\/div\>)/s', function($matches) {
        $card = $matches[2];
        
        $button_head_start = strpos($card, '<div class="button-head">');
        if ($button_head_start !== false) {
            $open = 1;
            $pos = $button_head_start + 25;
            while ($open > 0 && $pos < strlen($card)) {
                $next_open = strpos($card, '<div', $pos);
                $next_close = strpos($card, '</div', $pos);
                if ($next_open !== false && $next_open < $next_close) {
                    $open++;
                    $pos = $next_open + 4;
                } else if ($next_close !== false) {
                    $open--;
                    $pos = $next_close + 5;
                } else {
                    break;
                }
            }
            
            $button_head_html = substr($card, $button_head_start, $pos - $button_head_start + 1);
            $card = str_replace($button_head_html, '', $card);
            
            $content_start = strpos($card, '<div class="product-content">');
            if ($content_start !== false) {
                $open = 1;
                $pos = $content_start + 29;
                while ($open > 0 && $pos < strlen($card)) {
                    $next_open = strpos($card, '<div', $pos);
                    $next_close = strpos($card, '</div', $pos);
                    if ($next_open !== false && $next_open < $next_close) {
                        $open++;
                        $pos = $next_open + 4;
                    } else if ($next_close !== false) {
                        $open--;
                        $pos = $next_close + 5;
                    } else {
                        break;
                    }
                }
                
                $card = substr_replace($card, "\n" . $button_head_html . "\n", $pos + 1, 0);
            }
        }
        
        return $matches[1] . $card . $matches[3];
    }, $block);
    
    $c = $before . $block . $after;
}


// STEP 4: Add CSS before @endsection
$css = <<<'CSS'
/* === OUR PRODUCTS DARK/GOLD DESIGN === */
.our-products-area {
    background-color: #2b2b36 !important;
    padding-top: 80px;
    padding-bottom: 80px;
}
.our-products-area .single-product {
    background: #ffffff !important;
    border-radius: 12px !important;
    overflow: hidden !important;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08) !important;
    border: none !important;
    display: flex !important;
    flex-direction: column !important;
    height: 100% !important;
    transition: all 0.4s ease !important;
}
.our-products-area .single-product:hover {
    box-shadow: 0 15px 35px rgba(0,0,0,0.2) !important;
    transform: translateY(-8px) !important;
}

/* Image Zoom on Hover */
.our-products-area .single-product .product-img {
    overflow: hidden !important;
    padding: 0 !important;
    background: #f9f9f9 !important;
}
.our-products-area .single-product .product-img img {
    transition: transform 0.6s ease !important;
    width: 100% !important;
}
.our-products-area .single-product:hover .product-img img {
    transform: scale(1.08) !important;
}

/* Content Area */
.our-products-area .single-product .product-content {
    padding: 20px 20px 0 20px !important;
    text-align: left !important;
    flex-grow: 1 !important;
}
.our-products-area .single-product .product-content h3 {
    margin-bottom: 8px !important;
}
.our-products-area .single-product .product-content h3 a {
    font-size: 18px !important;
    font-weight: 700 !important;
    color: #2b2b36 !important;
    text-decoration: none !important;
    transition: color 0.3s ease !important;
}
.our-products-area .single-product .product-content h3 a:hover {
    color: #b59063 !important;
}
.our-products-area .single-product .product-price {
    display: flex !important;
    align-items: center !important;
    margin-top: 5px !important;
}
.our-products-area .single-product .product-price span {
    font-size: 16px !important;
    font-weight: 800 !important;
    color: #b59063 !important;
}
.our-products-area .single-product .product-price del {
    font-size: 14px !important;
    color: #999 !important;
    margin-left: 10px !important;
    text-decoration: line-through !important;
}

/* Buttons Area */
.our-products-area .single-product .button-head {
    background: transparent !important;
    opacity: 1 !important;
    visibility: visible !important;
    position: static !important;
    width: 100% !important;
    height: 45px !important;
    margin: 15px 0 0 0 !important;
    transform: none !important;
    padding: 0 20px 20px 20px !important;
}
.our-products-area .single-product .product-action {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    width: 100% !important;
    height: 100% !important;
    gap: 15px !important;
    position: static !important;
}

/* Bottom Buttons */
.our-products-area .single-product .product-action a[title="Quick View"],
.our-products-area .single-product .product-action a[title="Add to cart"] {
    width: 50% !important;
    height: 100% !important;
    border-radius: 8px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
}
.our-products-area .single-product .product-action a span {
    display: none !important;
}
.our-products-area .single-product .product-action a i {
    display: inline-block !important;
    font-size: 18px !important;
}
.our-products-area .single-product .product-action a[title="Quick View"] {
    background: #464a59 !important;
    color: #ffffff !important;
}
.our-products-area .single-product .product-action a[title="Quick View"]:hover {
    background: #565a6b !important;
}
.our-products-area .single-product .product-action a[title="Add to cart"] {
    background: #b59063 !important;
    color: #ffffff !important;
}
.our-products-area .single-product .product-action a[title="Add to cart"]:hover {
    background: #c6a275 !important;
}

/* Wishlist Heart */
.our-products-area .single-product .product-action a[title="Wishlist"] {
    position: absolute !important;
    top: 25px !important;
    right: 25px !important;
    background: transparent !important;
    color: #e74c3c !important;
    width: 30px !important;
    height: 30px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    z-index: 100 !important;
    transition: all 0.3s ease !important;
}
.our-products-area .single-product .product-action a[title="Wishlist"] i {
    font-size: 20px !important;
}
.our-products-area .single-product .product-action a[title="Wishlist"]:hover {
    background: rgba(231, 76, 60, 0.1) !important;
    transform: scale(1.1) !important;
}

</style>
CSS;

$c = preg_replace('/\/\* === OUR PRODUCTS DARK\/GOLD DESIGN === \*\/(.*?)\<\/style\>/is', '', $c);
$c = preg_replace('/@endsection/i', $css . "\n@endsection", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Perfect rebuild applied!";
