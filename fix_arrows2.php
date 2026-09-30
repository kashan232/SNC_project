<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// 1. Remove the old .popular-slider mobile overrides block completely
$pattern = '/\/\* Fix Carousel Arrows overlapping \*\/\s*\.popular-slider \.owl-nav div \{.*?\.popular-slider \.owl-next \{ right: -10px !important; \}/is';

$new = '/* Fix Carousel Arrows perfectly centered */
    .popular-slider {
        position: relative !important;
    }
    .popular-slider .owl-nav {
        position: absolute !important;
        top: 50% !important;
        width: 100% !important;
        left: 0 !important;
        margin: 0 !important;
        transform: translateY(-50%) !important;
        pointer-events: none !important; 
    }
    .popular-slider .owl-nav div {
        background: #fff !important;
        color: var(--primary-color) !important;
        border: 1px solid var(--primary-color) !important;
        border-radius: 50% !important;
        width: 36px !important;
        height: 36px !important;
        line-height: 34px !important;
        text-align: center !important;
        font-size: 16px !important;
        position: absolute !important;
        top: 0 !important;
        transform: translateY(-50%) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
        margin: 0 !important;
        padding: 0 !important;
        pointer-events: auto !important;
    }
    .popular-slider .owl-prev { left: 0px !important; }
    .popular-slider .owl-next { right: 0px !important; }';

if (preg_match($pattern, $c)) {
    $c = preg_replace($pattern, $new, $c);
    file_put_contents($f, $c);
    echo "Successfully replaced the arrows block.\n";
} else {
    echo "Could not find the block to replace.\n";
}
?>
