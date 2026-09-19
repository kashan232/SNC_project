<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$c = preg_replace('/<\/a>\s*<\/div>\s*<\/div>\s*<\/div>/', "</a>\n                            </div>\n                        </div>", $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed extra closing div.\n";
