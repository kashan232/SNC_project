const fs = require('fs');
let f = 'resources/views/frontend/pages/product_detail.blade.php';
let c = fs.readFileSync(f, 'utf8');

c = c.replace(
    '<div class="product-area most-popular related-product section">',
    '<div class="product-area most-popular related-product section" style="background:#c1540b; padding-top: 60px; padding-bottom: 60px;">'
);

c = c.replace(
    /<div class="section-title">[\s\S]*?<h2>Related Products<\/h2>[\s\S]*?<\/div>/,
    '<div class="section-title text-center" style="margin-bottom: 50px;">\\n<span style="color: var(--primary-color); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">Top Picks</span>\\n<h2 style="font-family: \\\'Orbitron\\\', sans-serif; font-size: 32px; font-weight: 800; color: #fff; margin-top: 10px;">Related <span style="color: #fff;">Products</span></h2>\\n</div>'
);

fs.writeFileSync(f, c);
