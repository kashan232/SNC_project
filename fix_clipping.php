<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css = <<<CSS

    /* --- FIX OWL CAROUSEL CLIPPING ON HOVER --- */
    .owl-carousel.popular-slider .owl-stage-outer {
        padding-top: 20px !important;
        padding-bottom: 30px !important;
        padding-left: 10px !important;
        padding-right: 10px !important;
        margin-top: -20px !important;
        margin-bottom: -30px !important;
        margin-left: -10px !important;
        margin-right: -10px !important;
    }
CSS;

$c = preg_replace('/(\<\/style\>)/i', $css . "\n$1", $c, 1);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed carousel clipping!";
