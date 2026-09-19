<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Change background color of section
$c = str_replace('background-color: #3C424F !important;', 'background-color: #c1540b !important;', $c);

// Remove the ::after that I added which causes duplicate underlines
$c = preg_replace('/\.most-popular \.section-title::after\s*\{.*?\}/s', '.most-popular .section-title::after { display: none !important; }', $c);

// Increase card padding
$c = str_replace('padding: 15px 15px 20px 15px !important;', 'padding: 25px 25px 30px 25px !important;', $c);

// Change button background to white and text to red
$c = preg_replace(
    '/(\.most-popular \.clean-card \.clean-add-cart\s*\{[^}]*)background-color:\s*#[a-fA-F0-9]+\s*!important;/',
    '$1background-color: #ffffff !important;',
    $c
);
$c = preg_replace(
    '/(\.most-popular \.clean-card \.clean-add-cart\s*\{[^}]*)color:\s*#[a-fA-F0-9]+\s*!important;/',
    '$1color: #E4002B !important;',
    $c
);

// On hover, maybe swap colors
$c = preg_replace(
    '/(\.most-popular \.clean-card \.clean-add-cart:hover\s*\{[^}]*)background-color:\s*#[a-fA-F0-9]+\s*!important;/',
    '$1background-color: #f0f0f0 !important;',
    $c
);
$c = preg_replace(
    '/(\.most-popular \.clean-card \.clean-add-cart:hover\s*\{[^}]*)color:\s*#[a-fA-F0-9]+\s*!important;/',
    '$1color: #c00024 !important;',
    $c
);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Updated Featured Products CSS.";
