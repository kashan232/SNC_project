<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// We need to override the global owl-carousel styles with a highly specific block
$fixCSS = "
/* FORCE ARROW CENTERING AND STYLE */
section.explore-menu-section .explore-slider.owl-carousel .owl-nav {
    position: absolute !important;
    top: 50% !important;
    left: 0 !important;
    width: 100% !important;
    height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    transform: translateY(-50%) !important;
    pointer-events: none !important;
    z-index: 10 !important;
}

section.explore-menu-section .explore-slider.owl-carousel .owl-nav div.owl-prev,
section.explore-menu-section .explore-slider.owl-carousel .owl-nav div.owl-next {
    position: absolute !important;
    top: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    transform: translateY(-50%) !important;
    width: 45px !important;
    height: 45px !important;
    background: #fff !important;
    color: #333 !important;
    border: 1px solid #eee !important;
    border-radius: 50% !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    pointer-events: auto !important;
    font-size: 18px !important;
    transition: all 0.3s ease !important;
}

section.explore-menu-section .explore-slider.owl-carousel .owl-nav div.owl-prev {
    left: -20px !important;
}

section.explore-menu-section .explore-slider.owl-carousel .owl-nav div.owl-next {
    right: -20px !important;
}

section.explore-menu-section .explore-slider.owl-carousel .owl-nav div.owl-prev:hover,
section.explore-menu-section .explore-slider.owl-carousel .owl-nav div.owl-next:hover {
    background: #F7941D !important;
    color: #fff !important;
    border-color: #F7941D !important;
}
</style>
";

// Insert the highly specific CSS right before the FIRST </style> tag in the file (which should be the explore menu style)
$c = preg_replace('/<\/style>/', $fixCSS, $c, 1);

file_put_contents($f, $c);
echo "Arrow position fixed!";
?>
