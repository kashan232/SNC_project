<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

$old = '/* Fix Carousel Arrows overlapping */
    .popular-slider .owl-nav div {
        background: #fff !important;
        color: var(--primary-color) !important;
        border: 1px solid var(--primary-color) !important;
        border-radius: 50% !important;
        width: 35px !important; 
        padding: 0 !important;
    }
    .popular-slider .owl-prev { left: -10px !important; } 
    .popular-slider .owl-next { right: -10px !important; }';

$new = '/* Fix Carousel Arrows overlapping */
    .popular-slider {
        position: relative !important;
    }
    .popular-slider .owl-nav {
        position: absolute !important;
        top: 50% !important;
        width: 100% !important;
        transform: translateY(-50%) !important;
        left: 0 !important;
        margin: 0 !important;
        pointer-events: none; /* Let clicks pass through empty space */
    }
    .popular-slider .owl-nav div {
        background: #fff !important;
        color: var(--primary-color) !important;
        border: 1px solid var(--primary-color) !important;
        border-radius: 50% !important;
        width: 35px !important;
        height: 35px !important;
        padding: 0 !important;
        position: absolute !important;
        top: 0 !important;
        pointer-events: auto; /* Re-enable clicks on arrows */
        margin: 0 !important;
        transform: translateY(-50%) !important;
    }
    .popular-slider .owl-prev { left: 0px !important; } 
    .popular-slider .owl-next { right: 0px !important; }';

$c = str_replace($old, $new, $c);

file_put_contents($f, $c);
echo "Fixed carousel arrows on mobile.\n";
?>
