<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css_fix = <<<CSS
    /* Vertically center the modal */
    .modal-dialog {
        display: flex !important;
        align-items: center !important;
        min-height: calc(100vh - 60px) !important;
        margin: 30px auto !important;
    }
    .modal-content {
        width: 100% !important;
    }
CSS;

$c = str_replace(
    '/* Quantity input styling */',
    $css_fix . "\n    /* Quantity input styling */",
    $c
);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Modal centered!";
