<?php

$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

$replacements = [
    'We are passionate about transforming ordinary spaces into inspiring environments. With a commitment to quality craftsmanship and modern design, our curated collection of premium home furniture, ergonomic office setups, and high-performance gaming chairs is tailored to elevate your lifestyle and workspace.' => 'Welcome to Shoukat Nimco Center! We are passionate about delivering the finest nimco, savory snacks, and bakery items. With a commitment to traditional recipes and high-quality ingredients, our fresh products are made to satisfy your daily cravings.',
    'We offer fast shipping across the UAE. Standard delivery typically takes 2-5 business days. For customized furniture orders, please allow 10-7 working days.' => 'We offer fast delivery across our service areas. Standard delivery typically takes 1-2 business days. For bulk bakery or nimco orders, please allow 2-3 working days.',
    'Yes, professional installation is free for all orders. Our expert team will deliver and assemble your furniture right in your home or office.' => 'Yes! Our items are packed fresh and sealed perfectly so they reach you in the crispiest and best condition possible.',
    'Absolutely! All our furniture items come with a standard 1-year warranty against manufacturing defects. Premium gaming and office chairs include a 2-year warranty on mechanisms.' => 'Absolutely! All our food items are prepared fresh daily under strict hygienic conditions. We guarantee the quality and freshness of every nimco pack and bakery item you order.',
    'Dubai, United Arab Emirates<br>Main Furniture Market' => 'Hyderabad, Pakistan<br>Urdu Bazar'
];

foreach ($replacements as $search => $replace) {
    $content = str_replace($search, $replace, $content);
}

file_put_contents($file, $content);
echo "Landing page text updated.";
