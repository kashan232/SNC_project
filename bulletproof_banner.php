<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css = <<<'CSS'
<style>
    /* Absolute Bulletproof overrides for Banner */
    #Gslider .carousel-item::after, 
    #Gslider .carousel-item::before {
        display: none !important;
        background: none !important;
    }
    #Gslider .carousel-inner img {
        opacity: 1 !important;
        transform: none !important;
        width: 100% !important;
        height: auto !important;
        max-height: none !important;
    }
    #Gslider .carousel-inner {
        height: auto !important;
        min-height: 0 !important;
    }
    #Gslider .carousel-item {
        height: auto !important;
    }
</style>
CSS;

$c = str_replace('<!-- Slider Area -->', '<!-- Slider Area -->' . "\n" . $css, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Added bulletproof banner css.\n";
