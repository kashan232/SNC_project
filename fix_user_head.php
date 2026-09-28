<?php
$f = 'resources/views/user/layouts/head.blade.php';
$c = file_get_contents($f);

$pattern = '/<style>\s*:root\s*{\s*--primary-color:\s*#F7941D;\s*}/';
$new = '
@php
    $settings = DB::table(\'settings\')->first();
    $themeColor = $settings->theme_color ?? \'#F7941D\';
@endphp
<style>
    :root {
        --primary-color: {{ $themeColor }};
    }';

$c = preg_replace($pattern, $new, $c);
file_put_contents($f, $c);
echo "Injected dynamic theme color CSS into user head.\n";
?>
