<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/app/Http/Helpers.php');
preg_match('/function getHeaderCategory.*?\}/is', $c, $m);
echo $m[0] ?? 'Not found';
