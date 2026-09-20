<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$old_transition = "transition: box-shadow 0.3s ease, transform 0.3s ease !important;";
$new_transition = "transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;";

$c = str_replace($old_transition, $new_transition, $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed transition!";
