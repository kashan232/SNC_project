<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$modal_path = $base_dir . 'resources/views/frontend/layouts/location_modal.blade.php';
$modal = file_get_contents($modal_path);

// Fix CSS logic so it doesn't rely on .show
$modal = str_replace('#locationModal.show .modal-header-custom .animated-logo', '#locationModal .modal-header-custom .animated-logo', $modal);
$modal = str_replace('#locationModal.show .modal-body', '#locationModal .modal-body', $modal);
$modal = str_replace('#locationModal.show .modal-content', '#locationModal .modal-content', $modal);

// Remove the inline opacity: 0 that might be stuck
$modal = str_replace('opacity: 0; position: relative;', 'position: relative;', $modal);

file_put_contents($modal_path, $modal);
echo "Modal opacity fixed.\n";
