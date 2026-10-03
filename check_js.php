<?php
$c = file_get_contents('resources/views/frontend/pages/complain.blade.php');
preg_match('/<script>.*<\/script>/is', $c, $m);
if($m) {
    echo "SCRIPT LENGTH: " . strlen($m[0]) . "\n";
    echo substr($m[0], 0, 1000) . "\n\n...\n\n" . substr($m[0], -1500);
}
?>
