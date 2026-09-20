<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css = <<<CSS

    /* --- NEW CART ANIMATION FIX --- */
    /* Override existing styles for the button */
    a.clean-add-cart {
        overflow: hidden !important;
        position: absolute !important;
        /* It is a flex container right now, so we need to override the children */
    }
    
    a.clean-add-cart i {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform-origin: center center !important;
        margin-top: -9px !important;
        margin-left: -9px !important;
        font-size: 18px !important;
        width: 18px !important;
        height: 18px !important;
        display: block !important;
        line-height: 1 !important;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease !important;
    }
    
    /* Default state */
    a.clean-add-cart .ti-plus {
        transform: scale(1) rotate(0deg) !important;
        opacity: 1 !important;
    }
    a.clean-add-cart .ti-shopping-cart {
        transform: scale(0) rotate(-180deg) !important;
        opacity: 0 !important;
    }
    
    /* Hover on the button ITSELF, not the whole card */
    a.clean-add-cart:hover {
        background: #4a2e2b !important;
        transform: scale(1.15) !important;
        box-shadow: 0 6px 15px rgba(74, 46, 43, 0.4) !important;
        border-radius: 50% !important;
    }
    
    a.clean-add-cart:hover .ti-plus {
        transform: scale(0) rotate(180deg) !important;
        opacity: 0 !important;
    }
    
    a.clean-add-cart:hover .ti-shopping-cart {
        transform: scale(1) rotate(0deg) !important;
        opacity: 1 !important;
    }
    
    /* Remove any hover effects from the CARD hovering the button */
    .clean-card:hover a.clean-add-cart {
        /* Reset back to normal so it ONLY animates when hovering the button directly */
        background: var(--primary-color) !important;
        transform: scale(1) !important;
        border-radius: 12px !important; 
    }
    .clean-card:hover a.clean-add-cart:hover {
        background: #4a2e2b !important;
        transform: scale(1.15) !important;
        border-radius: 50% !important;
    }
    
    /* The leaf shape for the card on hover */
    .clean-card {
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    }
    .clean-card:hover {
        box-shadow: 0 15px 40px rgba(211,84,0,0.2) !important;
        transform: translateY(-8px) !important;
        border-color: rgba(211,84,0,0.3) !important;
        border-radius: 40px 12px 40px 12px !important;
    }
CSS;

// Find the first </style> tag and insert before it
$c = preg_replace('/(\<\/style\>)/i', $css . "\n$1", $c, 1);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Injected robust CSS!";
