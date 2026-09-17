<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$footer_path = $base_dir . 'resources/views/frontend/layouts/footer.blade.php';
$footer = file_get_contents($footer_path);

// The script to automatically add aos to elements
$global_aos_script = <<<JS
<!-- Global AOS Auto-Apply -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Automatically add AOS animations to all main elements across the ENTIRE website
        const elementsToAnimate = document.querySelectorAll('.single-product, .section-title, .single-banner, .shop-single-blog, .single-service, .product-content, .contact-us .form-main, .contact-us .single-info, .about-us .about-content, .about-us .about-img, .shopping-cart, .checkout .checkout-form, .checkout .order-details, .product-des .short, .product-des .color, .product-des .size, .reviews .single-rating');
        
        elementsToAnimate.forEach(function(el) {
            if(!el.hasAttribute('data-aos')) {
                el.setAttribute('data-aos', 'fade-up');
                el.setAttribute('data-aos-offset', '50');
            }
        });

        const rows = document.querySelectorAll('.row');
        rows.forEach(function(row) {
            let delay = 0;
            const cols = row.querySelectorAll('.col-lg-3, .col-lg-4, .col-md-6, .col-sm-6');
            cols.forEach(function(col) {
                // If it doesn't already have an AOS attr inside it manually
                if(!col.hasAttribute('data-aos')) {
                    col.setAttribute('data-aos', 'fade-up');
                    col.setAttribute('data-aos-delay', delay.toString());
                    delay += 100; // Stagger effect
                }
            });
        });

        if(typeof AOS !== 'undefined') {
            AOS.refresh();
        }
    });
</script>
JS;

if (strpos($footer, 'Global AOS Auto-Apply') === false) {
    // Insert before the AOS.init() block if possible, or before </body>
    $footer = str_replace('</body>', $global_aos_script . "\n</body>", $footer);
    file_put_contents($footer_path, $footer);
    echo "Global AOS Script added.\n";
} else {
    echo "Global AOS Script already exists.\n";
}
