<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$c = str_replace("</div>\n</div>\n</div>\n<!-- End Most Popular Area -->", "</div>\n<!-- End Most Popular Area -->", $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Reverted fix_featured_divs.php";
