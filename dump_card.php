<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
preg_match_all('/<div class="col-sm-12 col-md-6 col-lg-3 p-b-35 isotope-item.*?<\/div>\s*<\/div>\s*<\/div>/is', $c, $m);
file_put_contents('c:/xampp/htdocs/SNC_project/dump_card.txt', $m[0][0] ?? 'Not found');
echo "Dumped\n";
