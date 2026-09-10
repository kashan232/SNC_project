<?php
$file = 'resources/views/frontend/layouts/header.blade.php';
$content = file_get_contents($file);

$pattern = '/\.top-header-center\s*\{.*?\}/s';
$replacement = <<<CSS
.top-header-center {
        padding: 0;
        background: transparent;
        border: none;
        box-shadow: none;
        border-radius: 0;
        text-align: center;
        z-index: 60;
        display: flex;
        align-items: center;
        justify-content: center;
    }
CSS;

$content = preg_replace($pattern, $replacement, $content, 1); // Only replace the first one in the <style>

file_put_contents($file, $content);
echo "Logo background/border removed properly.\n";
