<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');
preg_match_all('/@(if|endif|foreach|endforeach|auth|endauth|else|elseif)/', $c, $m);
print_r(array_count_values($m[0]));
