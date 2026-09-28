<?php
$f = 'resources/views/frontend/pages/product_detail.blade.php';
$c = file_get_contents($f);

$old_func = "    function selectSncSize(element, sizeName) {
        $('.snc-size-btn').removeClass('active btn-dark').addClass('btn-outline-dark');
        $(element).addClass('active btn-dark').removeClass('btn-outline-dark');
        
        $('#selectedSizeInput').val(sizeName);

        // Update the displayed price
        let unitPrice = window.baseProductPrice;
        if(window.productSizePrices[sizeName] !== undefined && window.productSizePrices[sizeName] !== null && window.productSizePrices[sizeName] !== \"\") {
            unitPrice = parseFloat(window.productSizePrices[sizeName]);
        }
        
        let discount = window.productDiscount || 0;
        let finalPrice = unitPrice - (unitPrice * discount / 100);
        
        $('.current-price, .snc-current-price').html('Rs: ' + finalPrice.toFixed(2));
        if(discount > 0) {
            $('.old-price del, .snc-old-price').html('Rs: ' + unitPrice.toFixed(2));
            $('.product-des .short .price .discount').html('Rs: ' + finalPrice.toFixed(2));
            $('.product-des .short .price s').html('Rs: ' + unitPrice.toFixed(2));
        } else {
            $('.old-price del, .snc-old-price').html('');
            $('.product-des .short .price .discount').html('Rs: ' + finalPrice.toFixed(2));
            $('.product-des .short .price s').html('');
        }
    }";

$new_func = "    let sncLoaderTimeout = null;
    function selectSncSize(element, sizeName) {
        $('.snc-size-btn').removeClass('active btn-dark').addClass('btn-outline-dark');
        $(element).addClass('active btn-dark').removeClass('btn-outline-dark');
        
        $('#selectedSizeInput').val(sizeName);

        // Show a small loader to simulate loading
        $('.current-price, .snc-current-price').html('<i class=\"fa fa-spinner fa-spin\"></i>');
        
        if (sncLoaderTimeout) {
            clearTimeout(sncLoaderTimeout);
        }

        sncLoaderTimeout = setTimeout(function() {
            // Update the displayed price
            let unitPrice = window.baseProductPrice;
            if(window.productSizePrices[sizeName] !== undefined && window.productSizePrices[sizeName] !== null && window.productSizePrices[sizeName] !== \"\") {
                unitPrice = parseFloat(window.productSizePrices[sizeName]);
            }
            
            let discount = window.productDiscount || 0;
            let finalPrice = unitPrice - (unitPrice * discount / 100);
            
            $('.current-price, .snc-current-price').hide().html('Rs: ' + finalPrice.toFixed(2)).fadeIn(200);
            if(discount > 0) {
                $('.old-price del, .snc-old-price').html('Rs: ' + unitPrice.toFixed(2));
                $('.product-des .short .price .discount').html('Rs: ' + finalPrice.toFixed(2));
                $('.product-des .short .price s').html('Rs: ' + unitPrice.toFixed(2));
            } else {
                $('.old-price del, .snc-old-price').html('');
                $('.product-des .short .price .discount').html('Rs: ' + finalPrice.toFixed(2));
                $('.product-des .short .price s').html('');
            }
        }, 400); // 400ms loader simulation
    }";

if (strpos($c, "fa-spinner fa-spin") === false) {
    $c = str_replace($old_func, $new_func, $c);
    file_put_contents($f, $c);
    echo "Added loader successfully.\n";
} else {
    echo "Loader already exists.\n";
}
?>
