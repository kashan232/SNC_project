<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css_fix = <<<CSS
    .quickview-content .add-to-cart .btn {
        line-height: normal !important;
        height: auto !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    .modal-header .close {
        position: absolute !important;
        right: 15px !important;
        top: 15px !important;
        z-index: 99 !important;
        color: #333 !important;
        font-size: 20px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    .modal-header .close span {
        display: block !important;
        color: inherit !important;
    }
CSS;

$c = str_replace(
    '/* Quantity input styling */',
    $css_fix . "\n    /* Quantity input styling */",
    $c
);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Modal button fixes applied!";
