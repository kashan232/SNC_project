<?php
$f = 'resources/views/frontend/pages/product_detail.blade.php';
$c = file_get_contents($f);

// 1. Fix Add to Cart button hover color (remove dark green) & width (remove flex: 1)
$c = str_replace('background: #14532d !important;', 'filter: brightness(0.85);', $c);
$c = preg_replace('/flex:\s*1;/m', '', $c);

// Fix the green box-shadows on the button
$c = preg_replace('/box-shadow:\s*0\s*6px\s*16px\s*rgba\(22,\s*101,\s*52,\s*0\.35\);/', 'box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);', $c);
$c = preg_replace('/box-shadow:\s*0\s*4px\s*12px\s*rgba\(22,\s*101,\s*52,\s*0\.25\);/', 'box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);', $c);

// 2. Fix feature icons color (replace Bootstrap text-success with custom class)
$c = str_replace('text-success', 'snc-theme-color', $c);

// 3. Fix Related Products heading font (Orbitron -> Poppins) and sub-heading color
$c = str_replace("font-family: 'Orbitron', sans-serif;", "font-family: 'Poppins', sans-serif;", $c);
$c = str_replace('color: var(--primary-color); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">Top Picks</span>', 'color: #fff; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">Top Picks</span>', $c);

// 4. Inject small CSS for the new icon class
$css = '
<style>
.snc-theme-color { color: var(--primary-color) !important; }
</style>
';

if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

file_put_contents($f, $c);
echo "Add to Cart, Feature Icons, and Related Products heading fixed!";
?>
