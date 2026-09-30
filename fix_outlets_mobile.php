<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

$old = '.store-details .contact-info i {
        color: var(--primary-color);
        margin-right: 5px;
    }';

$new = '.store-details .contact-info i {
        color: var(--primary-color);
        margin-right: 5px;
    }
    
    @media(max-width: 768px) {
        #our-outlets-premium {
            padding: 40px 0;
        }
        .store-icon-wrapper {
            width: 55px;
            height: 55px;
            margin: 15px auto 10px;
            font-size: 24px;
        }
        .store-details {
            padding: 0 15px 20px;
        }
        .store-details h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .store-details p {
            font-size: 13px;
            line-height: 1.4;
            margin-bottom: 10px;
        }
        #our-outlets-premium .section-title {
            margin-bottom: 30px;
        }
        #our-outlets-premium .section-title h2 {
            font-size: 28px;
        }
        .premium-store-grid {
            gap: 15px;
        }
    }';

$c = str_replace($old, $new, $c);

file_put_contents($f, $c);
echo "Fixed outlet cards size on mobile.\n";
?>
