<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/complain.blade.php');

$php_block = <<< 'HTML'
@php
    $settings = \App\Models\Settings::first();
    $themeColor = $settings->theme_color ?? '#036b41';
    $hoverColor = $settings->hover_color ?? '#024a2d';
@endphp
<style>
HTML;

$c = str_replace('<style>', $php_block, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/complain.blade.php', $c);
echo "Injected settings query\n";
