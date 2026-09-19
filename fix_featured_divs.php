<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Add 2 missing divs to close the Featured Arrivals (most-popular) section
$c = str_replace("</div>\n<!-- End Most Popular Area -->", "</div>\n</div>\n</div>\n<!-- End Most Popular Area -->", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Added missing divs to Featured Arrivals.";
