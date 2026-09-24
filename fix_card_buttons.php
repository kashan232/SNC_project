<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

$cssFix = '
<style>
/* OVERRIDE FOR HOME PAGE CARDS (BUTTONS & BADGES) */
.isotope-grid .modern-product-card .card-badges {
    align-items: flex-start !important; /* Prevents badges from stretching full width */
}
.isotope-grid .modern-product-card .card-badges span {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: auto !important; /* Fit content */
    padding: 4px 10px !important;
    border-radius: 6px !important;
    font-size: 10px !important;
    font-weight: 700 !important;
    letter-spacing: 0.5px !important;
    white-space: nowrap !important;
    background: #F7941D !important; /* Ensure theme color */
    color: #fff !important;
}

/* Ensure buttons don\'t wrap awkwardly */
.isotope-grid .modern-product-card .product-action-modern {
    display: flex !important;
    gap: 8px !important;
    flex-wrap: nowrap !important; /* Force side by side */
    width: 100% !important;
}
.isotope-grid .modern-product-card .btn-action-modern {
    flex: 1 !important; /* Equal width */
    white-space: nowrap !important; /* Prevent text wrapping */
    font-size: 11px !important; /* Slightly smaller to fit both */
    padding: 8px 4px !important; /* Less padding to fit */
    letter-spacing: -0.2px !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 4px !important; /* Less gap between icon and text */
}

/* Fix Wishlist Icon Button Size */
.isotope-grid .modern-product-card .btn-wishlist-modern {
    width: 32px !important;
    height: 32px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 !important;
    line-height: 1 !important;
    font-size: 14px !important;
    background: #F7941D !important;
    color: #fff !important;
    top: 15px !important;
    right: 15px !important;
}

@media (max-width: 575px) {
    .isotope-grid .modern-product-card .product-action-modern {
        flex-direction: column !important; /* Stack on very small screens if they don\'t fit */
    }
}
</style>
';

// Append to the end before @endpush if exists
if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $cssFix . "\n@endpush", $c);
} else {
    $c .= "\n" . $cssFix;
}

file_put_contents($f, $c);
echo "Buttons and Badges fixed!";
?>
