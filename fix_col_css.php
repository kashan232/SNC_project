<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

$old_css = '/* Adjust card styling for smaller mobile grid (2 per row) */
  @media (max-width: 575px) {
      .isotope-grid .modern-product-card {
          margin-bottom: 10px !important;
      }
      .isotope-grid .modern-product-card .product-info-modern {
          padding: 10px !important;
      }
      .isotope-grid .modern-product-card h3 a {
          font-size: 12px !important;
          line-height: 1.3 !important;
      }
      .isotope-grid .modern-product-card .current-price {
          font-size: 14px !important;
      }
      .isotope-grid .modern-product-card .product-action-modern {
          flex-direction: column !important;
          gap: 5px !important;
      }
      .isotope-grid .modern-product-card .btn-action-modern {
          padding: 6px 4px !important;
          font-size: 10px !important;
      }
      .isotope-grid .isotope-item {
          padding-left: 8px !important;
          padding-right: 8px !important;
          padding-bottom: 20px !important;
      }
  }';

$new_css = '/* Adjust card styling for mobile grid (1 per row) */
  @media (max-width: 575px) {
      .isotope-grid .modern-product-card .product-img-modern img {
          max-height: 250px;
          object-fit: cover;
      }
      .isotope-grid .modern-product-card .product-action-modern {
          flex-direction: row !important; /* Keep buttons side by side */
      }
  }';

$c = str_replace($old_css, $new_css, $c);
file_put_contents($f, $c);
echo "Fixed CSS for 1 column layout.\n";
?>
