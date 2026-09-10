<?php
$file = 'public/frontend/css/style.css';
$content = file_get_contents($file);

$content = str_replace(
    ".header.shop .right-bar {\n\tdisplay: inline-block;\n\tpadding: 0;\n\tmargin: 0;\n\ttop: 20px;\n\tfloat: right;\n\tposition: relative;\n}",
    ".header.shop .right-bar {\n\tdisplay: inline-block;\n\tpadding: 0;\n\tmargin: 0;\n\t/* top: 20px removed */\n\tfloat: right;\n\tposition: relative;\n}",
    $content
);

file_put_contents($file, $content);
echo "top 20 removed from right bar in style.css.\n";
