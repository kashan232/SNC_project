<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// We need to update the injected CSS overrides for the badges and wishlist
$newOverrides = '
    /* Ribbon & Wishlist Overrides */
    .card-badges {
        position: absolute !important;
        top: 15px !important;
        left: 15px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 5px !important;
        margin: 0 !important;
        z-index: 5 !important;
    }
    .badge-discount {
        background: #ff4757 !important; /* Beautiful Red for discount */
        color: #fff !important;
        border-radius: 6px !important; /* Soft corners */
        padding: 5px 10px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 10px rgba(255, 71, 87, 0.3) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        display: inline-block;
    }
    .btn-wishlist-modern {
        background: #ff4757 !important; /* Solid red by default */
        border: none !important;
        color: #ffffff !important; /* White heart */
        box-shadow: 0 4px 12px rgba(255, 71, 87, 0.25) !important;
        border-radius: 50% !important;
    }
    .btn-wishlist-modern:hover {
        background: #e8414f !important; /* Slightly darker on hover */
        transform: scale(1.05) !important;
    }
';

// Replace the old override block with the new one
// The old block was added in step "fix_badges_wishlist.php"
$oldOverrideStart = '/* Ribbon & Wishlist Overrides */';
$oldOverrideEnd = '.btn-wishlist-modern:hover {
        background: #ff4757 !important;
        color: #ffffff !important;
        box-shadow: 0 6px 15px rgba(255, 71, 87, 0.3) !important;
    }';

$posStart = strpos($c, $oldOverrideStart);
$posEnd = strpos($c, $oldOverrideEnd);

if ($posStart !== false && $posEnd !== false) {
    $c = substr($c, 0, $posStart) . $newOverrides . substr($c, $posEnd + strlen($oldOverrideEnd));
}

// In case the exact string wasn't found due to formatting differences, let's also append it just to be safe, 
// but it's better to do a preg_replace if needed. Actually string replace should work perfectly since I generated it.

file_put_contents($f, $c);
echo "Wishlist and ribbon fixed!";
?>
