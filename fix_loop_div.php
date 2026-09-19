<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Restore the missing div at the end of the Our Products loop
$c = preg_replace('/(\<\/div\>\s*\<\/div\>\s*)@endforeach/is', "$1</div>\n@endforeach", $c);

// Also remove the "fix" I applied earlier that added a div before <!-- End Product Area -->
// Because if I fix the loop, the section will be perfectly closed, and the extra div at the end will cause issues!
$c = preg_replace('/(\<\/div\>\n)\<\!-- End Product Area --\>/is', '<!-- End Product Area -->', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Restored the loop's HTML structure correctly.";
