<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$modal_path = $base_dir . 'resources/views/frontend/layouts/location_modal.blade.php';
$modal = file_get_contents($modal_path);

// Remove the conflicting img style
$modal = preg_replace('/#locationModal \.modal-header-custom img\s*\{[^}]+\}/s', '', $modal);

file_put_contents($modal_path, $modal);
echo "Conflicting CSS removed.\n";
