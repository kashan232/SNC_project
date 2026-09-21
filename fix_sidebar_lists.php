<?php
$content = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/product-grids.blade.php');

// Let's add a safety CSS rule to ensure the sidebar displays correctly
$css_fix = <<<CSS
    /* Fix for sidebar missing */
    .col-lg-3 {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    .modern-sidebar {
        display: block !important;
        width: 100% !important;
    }
CSS;

$content = str_replace('/* Sidebar */', "/* Sidebar */\n" . $css_fix, $content);

// Save to product-grids.blade.php
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/product-grids.blade.php', $content);

// Now copy exactly the same content to product-lists.blade.php so they get the beautiful design everywhere!
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/product-lists.blade.php', $content);

echo "Applied to both product-grids and product-lists!";
