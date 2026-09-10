<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

$fix_css = <<<CSS
<style>
    /* FINAL OVERRIDE FOR HERO BANNER HEIGHT */
    section#Gslider .carousel-inner {
        height: 85vh !important;
    }
    section#Gslider .carousel-item {
        height: 100% !important;
    }
    section#Gslider .carousel-inner img.first-slide {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
    }
    @media (max-width: 768px) {
        section#Gslider .carousel-inner {
            height: 70vh !important;
        }
    }
</style>
CSS;

$content = str_replace('@endsection', $fix_css . "\n@endsection", $content);
file_put_contents($file, $content);
echo "Hero squish fixed.\n";
