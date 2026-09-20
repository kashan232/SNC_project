<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$old_css = <<<CSS
    a.clean-add-cart i {
        position: absolute !important;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease !important;
    }
    a.clean-add-cart .ti-plus {
        transform: scale(1) rotate(0deg) !important;
        opacity: 1 !important;
    }
    a.clean-add-cart .ti-shopping-cart {
        transform: scale(0) rotate(-180deg) !important;
        opacity: 0 !important;
    }
    
    .clean-card:hover a.clean-add-cart {
        background: #4a2e2b !important;
        transform: scale(1.1) !important;
        box-shadow: 0 6px 15px rgba(74, 46, 43, 0.4) !important;
        border-radius: 50% !important; /* Make it fully round on hover */
    }
    
    .clean-card:hover a.clean-add-cart .ti-plus {
        transform: scale(0) rotate(180deg) !important;
        opacity: 0 !important;
    }
    
    .clean-card:hover a.clean-add-cart .ti-shopping-cart {
        transform: scale(1) rotate(0deg) !important;
        opacity: 1 !important;
    }
CSS;

$new_css = <<<CSS
    a.clean-add-cart i {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        margin-top: -9px !important; /* Half of font size to center perfectly */
        margin-left: -9px !important;
        font-size: 18px !important;
        width: 18px !important;
        height: 18px !important;
        display: block !important;
        line-height: 1 !important;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease !important;
    }
    a.clean-add-cart .ti-plus {
        transform: scale(1) rotate(0deg) !important;
        opacity: 1 !important;
    }
    a.clean-add-cart .ti-shopping-cart {
        transform: scale(0) rotate(-180deg) !important;
        opacity: 0 !important;
    }
    
    .clean-card:hover a.clean-add-cart {
        background: #4a2e2b !important;
        transform: scale(1.15) !important;
        box-shadow: 0 6px 15px rgba(74, 46, 43, 0.4) !important;
        border-radius: 50% !important; /* Make it fully round on hover */
    }
    
    .clean-card:hover a.clean-add-cart .ti-plus {
        transform: scale(0) rotate(180deg) !important;
        opacity: 0 !important;
    }
    
    .clean-card:hover a.clean-add-cart .ti-shopping-cart {
        transform: scale(1) rotate(0deg) !important;
        opacity: 1 !important;
    }
CSS;

$c = str_replace($old_css, $new_css, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed stacked icons!";
