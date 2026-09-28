<?php
// MODIFY CREATE.BLADE.PHP
$f1 = 'resources/views/backend/product/create.blade.php';
$c1 = file_get_contents($f1);

// Add id="size" if not present
if (strpos($c1, 'id="size"') === false) {
    $c1 = str_replace('name="size[]" class="form-control selectpicker"', 'name="size[]" id="size" class="form-control selectpicker"', $c1);
}

// Add container after the select group
$c1 = preg_replace('/(<\/select>\s*<\/div>)/i', '$1'."\n          <div id=\"size-price-container\" style=\"background:#f9f9f9; padding: 15px; border-radius: 5px; margin-top: 10px; display: none;\"></div>\n", $c1);

// Add script at the bottom
$script1 = '
<script>
    $(document).ready(function() {
        $("#size").on("change", function() {
            let sizes = $(this).val();
            let container = $("#size-price-container");
            container.empty();
            
            // Remove empty string if present (from the --Select any size-- option)
            if (sizes) {
                sizes = sizes.filter(s => s !== "");
            }

            if (sizes && sizes.length > 0) {
                container.show();
                container.append("<h5 style=\'font-size: 14px; margin-bottom: 15px; font-weight: bold;\'>Set Specific Prices for Selected Sizes (Optional)</h5>");
                sizes.forEach(function(size) {
                    container.append(`
                        <div class="form-group row" style="margin-bottom: 10px;">
                            <label class="col-sm-3 col-form-label">Price for Size <strong>${size}</strong></label>
                            <div class="col-sm-9">
                                <input type="number" step="0.01" name="size_prices[${size}]" class="form-control" placeholder="Enter specific price for ${size} (leave empty to use default price)">
                            </div>
                        </div>
                    `);
                });
            } else {
                container.hide();
            }
        });
    });
</script>
';
if (strpos($c1, '$("#size").on("change"') === false) {
    $c1 = str_replace('</script>', "</script>\n".$script1, $c1);
}
file_put_contents($f1, $c1);
echo "Create view updated.\n";


// MODIFY EDIT.BLADE.PHP
$f2 = 'resources/views/backend/product/edit.blade.php';
$c2 = file_get_contents($f2);

if (strpos($c2, 'id="size"') === false) {
    $c2 = str_replace('name="size[]" class="form-control selectpicker"', 'name="size[]" id="size" class="form-control selectpicker"', $c2);
}

$c2 = preg_replace('/(<\/select>\s*<\/div>)/i', '$1'."\n          <div id=\"size-price-container\" style=\"background:#f9f9f9; padding: 15px; border-radius: 5px; margin-top: 10px; display: none;\"></div>\n", $c2);

// For edit, we need to inject the existing prices into JS
$script2 = '
<script>
    $(document).ready(function() {
        let existingPrices = {!! $product->size_prices ? $product->size_prices : "{}" !!};
        
        function renderSizePrices() {
            let sizes = $("#size").val();
            let container = $("#size-price-container");
            container.empty();
            
            if (sizes) {
                sizes = sizes.filter(s => s !== "");
            }

            if (sizes && sizes.length > 0) {
                container.show();
                container.append("<h5 style=\'font-size: 14px; margin-bottom: 15px; font-weight: bold;\'>Set Specific Prices for Selected Sizes (Optional)</h5>");
                sizes.forEach(function(size) {
                    let priceVal = existingPrices[size] !== undefined ? existingPrices[size] : "";
                    container.append(`
                        <div class="form-group row" style="margin-bottom: 10px;">
                            <label class="col-sm-3 col-form-label">Price for Size <strong>${size}</strong></label>
                            <div class="col-sm-9">
                                <input type="number" step="0.01" name="size_prices[${size}]" class="form-control" value="${priceVal}" placeholder="Enter specific price for ${size} (leave empty to use default price)">
                            </div>
                        </div>
                    `);
                });
            } else {
                container.hide();
            }
        }
        
        $("#size").on("change", function() {
            // When user changes dropdown manually, update the object so they don\'t lose inputted data
            $("#size-price-container input").each(function() {
                let name = $(this).attr("name");
                let match = name.match(/\[(.*?)\]/);
                if(match && match[1]) {
                    existingPrices[match[1]] = $(this).val();
                }
            });
            renderSizePrices();
        });
        
        // Initial render
        setTimeout(renderSizePrices, 500);
    });
</script>
';
if (strpos($c2, 'function renderSizePrices()') === false) {
    $c2 = str_replace('</script>', "</script>\n".$script2, $c2);
}
file_put_contents($f2, $c2);
echo "Edit view updated.\n";

?>
