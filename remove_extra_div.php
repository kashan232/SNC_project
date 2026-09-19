<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$c = str_replace('</div>
<!-- End Product Area -->', '<!-- End Product Area -->', $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Removed extra closing div.";
