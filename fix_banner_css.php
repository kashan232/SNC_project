<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Remove the after overlay
$c = preg_replace('/#Gslider \.carousel-item::after\s*{[^}]*}/s', '', $c);

// Remove the 85vh height enforcement
$c = preg_replace('/#Gslider \.carousel-inner\s*{\s*height:\s*85vh;\s*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-item\s*{\s*height:\s*100%;\s*}/s', '', $c);

// Remove the opacity and transform from the image
$c = preg_replace('/#Gslider \.carousel-inner img\s*{[^}]*}/s', "      #Gslider .carousel-inner img {\n          width: 100% !important;\n          height: auto !important;\n          display: block;\n      }", $c);

// Remove the scale transform on active
$c = preg_replace('/#Gslider \.carousel-item\.active img\s*{\s*transform:\s*scale\(1\.05\);\s*\/\* Slight zoom on active \*\/\s*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-item\.active img\s*{\s*transform:\s*scale\(1\.08\);\s*\/\* Slow zoom in \*\/\s*}/s', '', $c);

// Also remove the generic transform transition
$c = preg_replace('/#Gslider \.carousel-item img\s*{\s*transition: transform 6s ease-in-out;\s*transform: scale\(1\);\s*}/s', '', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Banner CSS fixed.\n";
