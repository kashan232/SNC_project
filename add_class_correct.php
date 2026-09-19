<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$c = preg_replace('/\<div class="product-area section"\>(\s*\<div class="container"\>\s*\<div class="row"\>\s*\<div class="col-12"\>\s*\<div class="section-title text-center" style="margin-bottom: 50px;"\>\s*\<span.*?Explore Collection)/s', '<div class="product-area section our-products-area">$1', $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Added our-products-area class successfully.";
