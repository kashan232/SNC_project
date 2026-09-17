<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$master_path = $base_dir . 'resources/views/frontend/layouts/master.blade.php';
$master = file_get_contents($master_path);

// Replace left: 25px with right: 25px
$master = str_replace('left: 25px;', 'right: 25px;', $master);
// Replace left: 20px with right: 20px for mobile
$master = str_replace('left: 20px;', 'right: 20px;', $master);

file_put_contents($master_path, $master);
echo "WhatsApp icon moved to bottom right.\n";
