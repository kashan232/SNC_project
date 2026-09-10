<?php
$file = 'resources/views/frontend/pages/order-track.blade.php';
$content = file_get_contents($file);

// Replace green colors
$content = str_replace('#036b41', '#e62020', $content);
$content = str_replace('#023a23', '#cc1818', $content);

// Replace rgba shadow for active timeline dot
$content = str_replace('rgba(3, 107, 65, 0.2)', 'rgba(230, 32, 32, 0.2)', $content);

// Replace Orbitron with Poppins
$content = str_replace("font-family: 'Orbitron', sans-serif;", "font-family: 'Poppins', sans-serif;", $content);

file_put_contents($file, $content);
echo "Tracking page theme updated.\n";
