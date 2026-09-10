<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

$font_override = '
<!-- GLOBAL FONT OVERRIDE: POPPINS -->
<style>
    /* Force Poppins font globally */
    body, h1, h2, h3, h4, h5, h6, p, a, span, div, li, ul, label, input, button, select, textarea {
        font-family: \'Poppins\', sans-serif !important;
    }
    
    /* Make Banner Text Bold as requested */
    #Gslider .carousel-inner .carousel-caption h1 {
        font-family: \'Poppins\', sans-serif !important;
        font-weight: 800 !important; /* Extra Bold */
        letter-spacing: 1px !important;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5) !important;
    }
    
    #Gslider .carousel-inner .carousel-caption p {
        font-family: \'Poppins\', sans-serif !important;
        font-weight: 600 !important; /* Semi Bold */
        font-size: 18px !important;
        text-shadow: 1px 1px 8px rgba(0,0,0,0.5) !important;
    }
</style>
<!-- END GLOBAL FONT OVERRIDE -->
';

// Insert it right before @endsection or at the end
if (strpos($content, 'GLOBAL FONT OVERRIDE') === false) {
    if (strpos($content, '@endsection') !== false) {
        $content = str_replace('@endsection', $font_override . "\n@endsection", $content);
    } else {
        $content .= "\n" . $font_override;
    }
} else {
    $content = preg_replace('/<!-- GLOBAL FONT OVERRIDE: POPPINS -->.*?<!-- END GLOBAL FONT OVERRIDE -->/s', $font_override, $content);
}

// Remove the Orbitron override from clean_css_override if it exists
$content = str_replace("font-family: 'Orbitron', sans-serif !important;", "font-family: 'Poppins', sans-serif !important;", $content);

file_put_contents($file, $content);
echo "Font family Poppins applied globally.\n";
