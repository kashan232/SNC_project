<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$content = file_get_contents($base_dir . 'apply_checkout.php');
$content = str_replace('\$city_area_fields', '$city_area_fields', $content);
file_put_contents($base_dir . 'apply_checkout.php', $content);
