<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$c = preg_replace('/\<div class="product-area section"\>\s*\<div class="container"\>\s*\<div class="row"\>\s*\<div class="col-12"\>\s*\<div class="section-title text-center"\>.*?Explore Collection/s', '<div class="product-area section our-products-area">' . "\n" . '    <div class="container">' . "\n" . '        <div class="row">' . "\n" . '            <div class="col-12">' . "\n" . '                <div class="section-title text-center">' . "\n" . '                    <span style="color: var(--primary-color); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display:block; margin-bottom: 10px;">Explore Collection', $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Class our-products-area added back.";
