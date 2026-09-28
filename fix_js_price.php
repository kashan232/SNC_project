<?php
$f = 'resources/views/frontend/pages/product_detail.blade.php';
$c = file_get_contents($f);

$js_old = "$('.current-price').html('Rs:' + finalPrice.toFixed(2));
        if(discount > 0) {
            $('.old-price del').html('Rs:' + unitPrice.toFixed(2));
            $('.product-des .short .price .discount').html('Rs:' + finalPrice.toFixed(2));
            $('.product-des .short .price s').html('Rs:' + unitPrice.toFixed(2));
        } else {
            $('.old-price del').html('');
            $('.product-des .short .price .discount').html('Rs:' + finalPrice.toFixed(2));
            $('.product-des .short .price s').html('');
        }";

$js_new = "$('.current-price, .snc-current-price').html('Rs: ' + finalPrice.toFixed(2));
        if(discount > 0) {
            $('.old-price del, .snc-old-price').html('Rs: ' + unitPrice.toFixed(2));
            $('.product-des .short .price .discount').html('Rs: ' + finalPrice.toFixed(2));
            $('.product-des .short .price s').html('Rs: ' + unitPrice.toFixed(2));
        } else {
            $('.old-price del, .snc-old-price').html('');
            $('.product-des .short .price .discount').html('Rs: ' + finalPrice.toFixed(2));
            $('.product-des .short .price s').html('');
        }";

$c = str_replace($js_old, $js_new, $c);
file_put_contents($f, $c);
echo "Fixed price selectors.\n";
?>
