<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css = <<<CSS
<!-- OVERRIDE FOR OUR PRODUCTS BUTTONS -->
<style>
    /* Target only the buttons in the Isotope grid (Our Products section) */
    .isotope-grid .single-product {
        display: flex !important;
        flex-direction: column !important;
    }
    .isotope-grid .single-product .button-head {
        position: relative !important;
        top: auto !important;
        right: auto !important;
        bottom: auto !important;
        left: auto !important;
        width: 100% !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        padding: 10px 0 !important;
        background: transparent !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
        margin-top: 10px;
    }
    
    .isotope-grid .single-product .product-action {
        display: flex !important;
        flex-direction: row !important;
        justify-content: center !important;
        gap: 10px !important;
        width: 100% !important;
    }

    .isotope-grid .single-product .product-action a {
        position: relative !important;
        top: auto !important;
        right: auto !important;
        left: auto !important;
        width: 40px !important;
        height: 40px !important;
        line-height: 40px !important;
        border-radius: 50% !important;
        background: #fff !important;
        color: #333 !important;
        text-align: center !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
    }
    
    .isotope-grid .single-product .product-action a:hover {
        background: #c1540b !important;
        color: #fff !important;
    }
    
    .isotope-grid .single-product .product-action a span {
        display: none !important; /* Hide the text span */
    }
</style>
CSS;

$c = preg_replace('/(\<div class="product-area section"[^\>]*style="background: #c1540b;"\>)/i', $css . "\n$1", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Injected CSS override!";
