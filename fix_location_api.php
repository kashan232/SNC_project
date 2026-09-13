<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Update JS in modal to fix language and precision
$modal_path = $base_dir . 'resources/views/frontend/layouts/location_modal.blade.php';
$modal = file_get_contents($modal_path);

// Replace fetch URL
$modal = str_replace(
    'fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)',
    'fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&accept-language=en`)',
    $modal
);

// Improve area extraction logic
$old_extraction = "let area = data.address.suburb || data.address.neighbourhood || data.address.road || '';";
$new_extraction = "let area = data.address.residential || data.address.neighbourhood || data.address.suburb || data.address.village || data.address.road || '';";
$modal = str_replace($old_extraction, $new_extraction, $modal);

file_put_contents($modal_path, $modal);

echo "JS updated for English and better precision.\n";
