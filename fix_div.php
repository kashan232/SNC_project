<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$c = str_replace(
    '</a>
                                      <div class="product-content">',
    '</a>
                                      </div>
                                      <div class="product-content">',
    $c
);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed missing div.";
