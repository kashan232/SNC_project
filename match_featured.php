<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Restore the featured products heading to match the basic structure, but with a specific class for styling
$new_heading = <<<HTML
                <div class="section-title text-center featured-products-title" style="margin-bottom: 50px;">
                    <span>Top Picks</span>
                    <h2>Featured <span>Products</span></h2>
                </div>
HTML;

$c = preg_replace('/\<div class="section-title text-center" style="margin-bottom: 50px;"\>.*?\>Top Picks\<\/span\>.*?Featured Products.*?\<\/h2\>\s*\<\/div\>/is', $new_heading, $c);

// Add the CSS to match Our Products exactly
$css = <<<'CSS'
/* Featured Products Title Styling */
.featured-products-title span:first-child {
    color: #ffffff !important;
    font-size: 16px !important;
    letter-spacing: 3px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    opacity: 0.9 !important;
    display: block !important;
    margin-bottom: 10px !important;
}
.featured-products-title h2 {
    color: #ffffff !important;
    font-size: 50px !important;
    font-weight: 800 !important;
    margin-top: 0 !important;
    font-family: inherit !important;
}
.featured-products-title h2 span {
    color: #ffffff !important;
    font-weight: 800 !important;
    font-size: 50px !important;
}
.featured-products-title::after {
    content: '';
    display: block;
    width: 60px;
    height: 3px;
    background: #ffffff !important;
    margin: 15px auto 0 !important;
    border-radius: 5px !important;
}
CSS;

$c = preg_replace('/@endsection/i', $css . "\n@endsection", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Featured Products title perfectly matched.";
