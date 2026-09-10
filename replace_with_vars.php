<?php
$masterFile = 'resources/views/frontend/layouts/master.blade.php';
$content = file_get_contents($masterFile);

// Remove the old injection if any
$content = preg_replace('/@php\s*\$settings = DB::table\(\'settings\'\)->first\(\);\s*\$themeColor.*?<\/style>/s', '', $content);

$css = <<<HTML
@php
    \$settings = DB::table('settings')->first();
    \$themeColor = \$settings->theme_color ?? '#d35400';
    // Function to calculate hover color (darker version of theme color)
    \$hoverColor = '#a84300';
    if(preg_match('/^#([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/', \$themeColor, \$matches)) {
        \$r = max(0, hexdec(\$matches[1]) - 43);
        \$g = max(0, hexdec(\$matches[2]) - 17);
        \$b = max(0, hexdec(\$matches[3]) - 0); // Simplified darkening
        \$hoverColor = sprintf("#%02x%02x%02x", \$r, \$g, \$b);
    }
@endphp
<style>
    :root {
        --primary-color: {{\str_replace(';', '', \$themeColor)}} !important;
        --hover-color: {{\str_replace(';', '', \$hoverColor)}} !important;
    }
</style>
HTML;

$content = str_replace('</head>', $css . "\n</head>", $content);
file_put_contents($masterFile, $content);
echo "Master blade updated with CSS variables.\n";

// Replace colors with vars in frontend files
$dirs = ['resources/views/frontend', 'public/frontend/css'];
foreach($dirs as $dir) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach($files as $file) {
        if($file->isFile() && in_array($file->getExtension(), ['php', 'css'])) {
            $fileContent = file_get_contents($file->getRealPath());
            
            // replace occurrences of #d35400 and #a84300
            $newContent = str_ireplace('#d35400', 'var(--primary-color)', $fileContent);
            $newContent = str_ireplace('#a84300', 'var(--hover-color)', $newContent);
            
            // rgba replacements
            $newContent = str_ireplace('rgba(211, 84, 0,', 'color-mix(in srgb, var(--primary-color) ', $newContent);
            
            if ($fileContent !== $newContent) {
                file_put_contents($file->getRealPath(), $newContent);
            }
        }
    }
}
echo "All frontend files updated to use dynamic variables.\n";
