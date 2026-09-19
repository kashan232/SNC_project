<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Replace all section-title divs with clean HTML
// 1. Featured Products (Top Picks)
$c = preg_replace(
    '/\<div class="section-title text-center.*?featured-products-title.*?\>.*?\>Top Picks\<\/span\>.*?Featured \<\span\>Products\<\/span\>\<\/h2\>\s*\<\/div\>/is',
    '<div class="section-title text-center"><span>Top Picks</span><h2>Featured Products</h2></div>',
    $c
);

// Wait, the regex might fail. Let's just use a simpler replacement for all known headings.
$c = preg_replace('/\<div class="section-title text-center.*?Top Picks.*?\<\/div\>/is', '<div class="section-title text-center"><span>Top Picks</span><h2>Featured Products</h2></div>', $c);
$c = preg_replace('/\<div class="section-title text-center.*?Just In.*?\<\/div\>/is', '<div class="section-title text-center"><span>Just In</span><h2>New Arrivals</h2></div>', $c);
$c = preg_replace('/\<div class="section-title text-center.*?Explore Collection.*?\<\/div\>/is', '<div class="section-title text-center"><span>Explore Collection</span><h2>Our Products</h2></div>', $c);

// Now we apply a global CSS for ALL .section-title
$css = <<<'CSS'
/* === GLOBAL SECTION TITLES (Unified Design) === */
.section-title {
    margin-bottom: 50px !important;
    text-align: center !important;
}
.section-title span {
    font-size: 16px !important;
    letter-spacing: 3px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    opacity: 0.8 !important;
    display: block !important;
    margin-bottom: 10px !important;
}
.section-title h2 {
    font-size: 45px !important;
    font-weight: 800 !important;
    margin-top: 0 !important;
    font-family: 'Poppins', sans-serif !important; /* Clean, modern, bold font */
    position: relative !important;
    display: inline-block !important;
    text-transform: capitalize !important;
}
.section-title::after {
    content: '';
    display: block !important;
    position: absolute !important;
    bottom: -15px !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    width: 60px !important;
    height: 3px !important;
    border-radius: 5px !important;
}

/* Colors for White Background Sections (Featured & New Arrivals) */
.section-title span {
    color: #c1540b !important; /* Orange subtitle */
}
.section-title h2 {
    color: #222222 !important; /* Dark heading */
}
.section-title::after {
    background: #c1540b !important; /* Orange underline */
}

/* Colors for Orange Background Section (Our Products) */
.our-products-area .section-title span {
    color: #ffffff !important;
    opacity: 0.9 !important;
}
.our-products-area .section-title h2 {
    color: #ffffff !important;
}
.our-products-area .section-title::after {
    background: #ffffff !important;
}
CSS;

// Remove my previous specific title overrides to avoid conflicts
$c = preg_replace('/\/\* Titles \*\/(.*?)\/\* Tabs \(Filters\) \*\//is', "/* Tabs (Filters) */", $c);
$c = preg_replace('/\/\* Featured Products Title Styling \*\/(.*?)CSS;/is', '', $c); // cleanup if any

$c = preg_replace('/@endsection/i', $css . "\n@endsection", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Global unified headings applied.";
