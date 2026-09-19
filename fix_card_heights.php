<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css_fix = <<<CSS
    /* EQUAL HEIGHT FIX FOR OWL CAROUSEL CARDS */
    .owl-carousel.popular-slider .owl-stage {
        display: flex !important;
        align-items: stretch !important;
    }
    .owl-carousel.popular-slider .owl-item {
        display: flex !important;
        height: auto !important;
    }
    .clean-card {
        height: 100% !important;
        width: 100% !important;
    }
CSS;

$c = preg_replace('/(<!-- START CLEAN CARD CSS OVERRIDE -->\s*<style>)/i', "$1\n" . $css_fix . "\n", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed card heights with preg_replace!";
