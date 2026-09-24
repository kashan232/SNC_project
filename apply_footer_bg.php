<?php
$f = 'resources/views/frontend/layouts/footer.blade.php';
$c = file_get_contents($f);

// Replace the transparent textures URL with our new background
$old_bg = "background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');";
$new_bg = "background-image: url('{{ asset(\"frontend/img/footer-bg.jpg\") }}');\n        background-size: cover;\n        background-position: center top;";

$c = str_replace($old_bg, $new_bg, $c);

file_put_contents($f, $c);
echo "Footer background image updated!";
?>
