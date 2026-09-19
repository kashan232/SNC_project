<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$c = str_replace('padding: 80px 0 60px 0;', 'padding: 40px 0 30px 0;', $c);
$c = str_replace('margin-bottom: 50px;', 'margin-bottom: 25px;', $c);
$c = preg_replace('/(\.kfc-slider\s*{\s*padding:\s*)20px(\s*0;\s*})/', '${1}10px$2', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Padding reduced.\n";
