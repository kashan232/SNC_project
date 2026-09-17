<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/complain.blade.php');

$style_block = <<<'HTML'
    <style>
        :root {
            --primary-color: {{ $themeColor ?? '#036b41' }};
            --hover-color: {{ $hoverColor ?? '#024a2d' }};
        }
        
        body, html {
HTML;

$c = str_replace('<style>', $style_block, $c);

// Replace colors
$c = str_replace('#036b41', 'var(--primary-color)', $c);
$c = str_replace('#024a2d', 'var(--hover-color)', $c);
// Replace rgba variants for box shadow
$c = str_replace('rgba(3, 107, 65, 0.3)', 'var(--primary-color)', $c); // simplify
$c = str_replace('rgba(3, 107, 65, 0.4)', 'var(--primary-color)', $c); // simplify
$c = str_replace('rgba(3, 107, 65, 0.1)', 'var(--primary-color)', $c); // simplify
$c = str_replace('rgba(3, 107, 65, 0.15)', 'var(--primary-color)', $c); // simplify
$c = str_replace('rgba(3, 107, 65, 0)', 'transparent', $c);

// Specifically handle pulse animation
$c = preg_replace('/@keyframes pulse-ring \{.*?\}/is', "
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 var(--primary-color); }
            70% { box-shadow: 0 0 0 20px transparent; }
            100% { box-shadow: 0 0 0 0 transparent; }
        }
", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/complain.blade.php', $c);
echo "Colors updated to dynamic theme variables\n";
