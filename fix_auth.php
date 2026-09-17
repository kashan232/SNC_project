<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');
$lines = explode("\n", $c);
foreach($lines as $i => $l) {
    if(strpos($l, '@auth') !== false || strpos($l, '@endauth') !== false) {
        echo ($i+1) . ": " . trim($l) . "\n";
    }
}