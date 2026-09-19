<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$c = str_replace(
    '.kfc-name-line {
        display: none; /* Not visible in screenshot */
    }',
    '.kfc-name-line {
        width: 35px;
        height: 3px;
        background: #b59063; /* Golden */
        margin: 8px auto 0;
        transition: width 0.3s ease;
    }
    .kfc-card-item:hover .kfc-name-line {
        width: 50px;
    }',
    $c
);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Updated name line.";
