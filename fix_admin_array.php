<?php
$file = 'app/Http/Controllers/AdminController.php';
$content = file_get_contents($file);

// Fix the array syntax error by properly placing theme_color
$content = str_replace(', \'theme_color\'=>\'required|string\'', '', $content);
$content = str_replace(', ,', ',', $content); // if any
$content = str_replace(',,', ',', $content); // if any

// Let's manually replace the validate block in AdminController
$pattern = '/\$this->validate\(\$request,\s*\[(.*?)\]\);/s';
preg_match_all($pattern, $content, $matches);

foreach($matches[0] as $match) {
    if (strpos($match, 'short_des') !== false && strpos($match, 'theme_color') === false) {
        $fixed = str_replace(']', "    'theme_color'=>'required|string',\n        ]", $match);
        $content = str_replace($match, $fixed, $content);
    }
}

file_put_contents($file, $content);
echo "AdminController fixed\n";
