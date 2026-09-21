<?php
$files = [
    'c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/product-grids.blade.php',
    'c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/product-lists.blade.php'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    // The radios currently have name="price". They need to be name="price_range" for the backend to catch them.
    $content = str_replace('name="price"', 'name="price_range"', $content);
    file_put_contents($file, $content);
}

echo "Filter names fixed!";
