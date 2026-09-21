<?php
$f = 'resources/views/frontend/pages/product_detail.blade.php';
$c = file_get_contents($f);
$css = "
    /* === OWL CAROUSEL IMAGE FIX === */
    .owl-carousel .owl-item .product-img-modern img { height: 200px !important; width: 100% !important; object-fit: contain !important; display: block !important; margin: 0 auto !important; }
    .card-badges { z-index: 10; }
    .btn-wishlist-modern { z-index: 10; }
    /* === OWL CAROUSEL ARROWS REDESIGN === */
    .related-product .owl-carousel { position: relative; }
    .related-product .owl-nav { margin: 0; }
    .related-product .owl-nav .owl-prev, .related-product .owl-nav .owl-next { position: absolute !important; top: 50% !important; transform: translateY(-50%) !important; width: 45px !important; height: 45px !important; background: #fff !important; color: #F7941D !important; border-radius: 50% !important; display: flex !important; align-items: center !important; justify-content: center !important; box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important; font-size: 24px !important; line-height: 1 !important; transition: all 0.3s ease !important; z-index: 99; margin: 0 !important; padding: 0 !important; border: 2px solid transparent !important; }
    .related-product .owl-nav .owl-prev { left: -15px !important; }
    .related-product .owl-nav .owl-next { right: -15px !important; }
    .related-product .owl-nav .owl-prev:hover, .related-product .owl-nav .owl-next:hover { background: #F7941D !important; color: #fff !important; border-color: #fff !important; }
    </style>";
$c = str_replace('</style>', $css, $c);
file_put_contents($f, $c);
