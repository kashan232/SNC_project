<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$master_path = $base_dir . 'resources/views/frontend/layouts/master.blade.php';
$master = file_get_contents($master_path);

// Replace right: 25px with left: 25px
$master = str_replace('right: 25px;', 'left: 25px;', $master);
// Replace right: 20px with left: 20px for mobile
$master = str_replace('right: 20px;', 'left: 20px;', $master);

file_put_contents($master_path, $master);
echo "WhatsApp icon moved back to bottom left.\n";
