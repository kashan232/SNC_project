<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css_old = <<<'CSS'
.our-products-area .section-title::after {
    content: '';
    display: block;
    width: 50px;
    height: 2px;
    background: #a49175;
    margin: 15px auto 0;
}
CSS;

$css_new = <<<'CSS'
.our-products-area .section-title::after {
    content: '';
    display: block;
    width: 60px;
    height: 3px;
    background: #ffffff;
    margin: 15px auto 0;
    border-radius: 5px;
}
CSS;

$c = str_replace($css_old, $css_new, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Underline updated.";
