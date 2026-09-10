<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

// Ensure .carousel-item has height: 100%
$content = preg_replace(
    '/#Gslider \.carousel-inner \{.*?\}/s',
    "#Gslider .carousel-inner {\n        height: 85vh;\n    }\n    #Gslider .carousel-item {\n        height: 100%;\n    }",
    $content
);

file_put_contents($file, $content);
echo "Fixed carousel-item height.\n";
