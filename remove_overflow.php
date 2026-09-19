<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');

$c = str_replace(
    "<style>\n    html, body {\n        max-width: 100vw;\n        overflow-x: hidden;\n    }\n</style>\n",
    "",
    $c
);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php', $c);
echo "Removed overflow hidden!";
