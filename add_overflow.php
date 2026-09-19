<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');

$css_overflow = <<<CSS
<style>
    html, body {
        max-width: 100vw;
        overflow-x: hidden;
    }
</style>
CSS;

if (strpos($c, 'max-width: 100vw; overflow-x: hidden;') === false) {
    $c = $css_overflow . "\n" . $c;
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php', $c);
    echo "Overflow hidden added!";
} else {
    echo "Already added.";
}
