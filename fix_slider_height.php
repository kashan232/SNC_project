<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Remove the after overlay entirely
$c = preg_replace('/#Gslider \.carousel-item::after\s*{[^}]*}/s', '', $c);

// Fix other specific Gslider overrides
$c = preg_replace('/#Gslider \.carousel-inner\s*{\s*height:\s*85vh;\s*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-item\s*{\s*height:\s*100%;\s*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-inner img\s*{[^}]*}/s', "      #Gslider .carousel-inner img {\n          width: 100% !important;\n          height: auto !important;\n          display: block;\n      }", $c);
$c = preg_replace('/#Gslider \.carousel-item\.active img\s*{\s*transform:\s*scale\(1\.05\);\s*\/\* Slight zoom on active \*\/\s*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-item\.active img\s*{\s*transform:\s*scale\(1\.08\);\s*\/\* Slow zoom in \*\/\s*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-item img\s*{\s*transition: transform 6s ease-in-out;\s*transform: scale\(1\);\s*}/s', '', $c);

// Remove the FINAL OVERRIDE forced heights
$c = preg_replace('/section#Gslider \.carousel-inner\s*{\s*height:\s*85vh\s*!important;\s*}/i', '', $c);
$c = preg_replace('/section#Gslider \.carousel-item\s*{\s*height:\s*100%\s*!important;\s*}/i', '', $c);
$c = preg_replace('/section#Gslider \.carousel-inner img\.first-slide\s*{[^}]*}/i', '', $c);
$c = preg_replace('/@media\s*\(max-width:\s*768px\)\s*{\s*section#Gslider \.carousel-inner\s*{\s*height:\s*70vh\s*!important;\s*}\s*}/i', '', $c);

// Also remove inline styles from HTML
$c = preg_replace('/style="width: 100%; height: auto; object-fit: cover;"/i', 'style="width: 100%; height: auto;"', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Cleaned up GSlider height CSS.\n";
