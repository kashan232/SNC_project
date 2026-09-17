<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/master.blade.php');
preg_match_all('/<style>.*?<\/style>/is', $c, $m);
print_r($m[0]);
