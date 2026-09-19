<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Add a missing closing div before <!-- End Product Area -->
$c = preg_replace('/(\<\!-- End Product Area --\>)/is', "</div>\n$1", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Added missing closing div.";
