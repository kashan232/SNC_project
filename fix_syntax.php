<?php
$file = 'resources/views/frontend/layouts/location_modal.blade.php';
$content = file_get_contents($file);

// Fix the $(key) typo to $key
$content = str_replace('{{$(key) == 0 ? \'active\' : \'\'}}', '{{$key == 0 ? \'active\' : \'\'}}', $content);

file_put_contents($file, $content);
echo "Syntax error fixed.\n";
