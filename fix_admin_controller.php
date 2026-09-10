<?php
$controllerFile = 'app/Http/Controllers/AdminController.php';
$content = file_get_contents($controllerFile);

// Update validation logic
if (strpos($content, "'theme_color'") === false && strpos($content, "settingsUpdate(Request \$request)") !== false) {
    // Inject validation for theme_color
    $content = preg_replace(
        '/this->validate\(\$request,\s*\[(.*?)\]\);/s',
        'this->validate($request,[$1, \'theme_color\'=>\'required|string\']);',
        $content
    );
    file_put_contents($controllerFile, $content);
}
echo "Admin controller updated\n";
