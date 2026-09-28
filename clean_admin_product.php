<?php
// Restore create.blade.php and edit.blade.php from git or manually strip
function cleanFile($f) {
    $c = file_get_contents($f);

    // Remove all injected size-price-container divs
    $c = preg_replace('/<div id="size-price-container" style="background:#f9f9f9; padding: 15px; border-radius: 5px; margin-top: 10px; display: none;"><\/div>\n?/', '', $c);

    // Remove all injected JS scripts
    $c = preg_replace('/<script>\s*\$\(document\)\.ready\(function\(\) \{\s*(let existingPrices|let container).*?<\/script>/is', '', $c);
    
    // We also need to strip out any multiple injections of the script from str_replace
    $c = preg_replace('/<script>\s*\$\(document\)\.ready\(function\(\) \{\s*\$\("#size"\)\.on\("change".*?<\/script>/is', '', $c);
    
    // Check if the script block exists, and clean it up completely
    return $c;
}

$f1 = 'resources/views/backend/product/create.blade.php';
$c1 = cleanFile($f1);
// Now carefully add back just ONE size-price-container ONLY after the size select
$c1 = str_replace(
    '<select name="size[]" id="size" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">--Select any size--</option>
              <option value="S">Small (S)</option>
              <option value="M">Medium (M)</option>
              <option value="L">Large (L)</option>
              <option value="XL">Extra Large (XL)</option>
          </select>
        </div>',
    '<select name="size[]" id="size" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">--Select any size--</option>
              <option value="S">Small (S)</option>
              <option value="M">Medium (M)</option>
              <option value="L">Large (L)</option>
              <option value="XL">Extra Large (XL)</option>
          </select>
        </div>
        <div id="size-price-container" style="background:#f9f9f9; padding: 15px; border-radius: 5px; margin-top: 10px; display: none;"></div>',
    $c1
);

// Add JS correctly at the end of the file
$script1 = '
<script>
    $(document).ready(function() {
        $("#size").on("change", function() {
            let sizes = $(this).val();
            let container = $("#size-price-container");
            container.empty();
            
            if (sizes) {
                sizes = sizes.filter(s => s !== "");
            }

            if (sizes && sizes.length > 0) {
                container.show();
                container.append("<h5 style=\'font-size: 14px; margin-bottom: 15px; font-weight: bold;\'>Set Specific Prices for Selected Sizes (Optional)</h5>");
                sizes.forEach(function(size) {
                    container.append(`
                        <div class="form-group row" style="margin-bottom: 10px; align-items: center;">
                            <label class="col-sm-3 col-form-label" style="margin-bottom: 0;">Price for Size <strong>${size}</strong></label>
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
$c1 .= $script1;
file_put_contents($f1, $c1);


$f2 = 'resources/views/backend/product/edit.blade.php';
$c2 = cleanFile($f2);

// Edit has a slightly different select sometimes, let's use regex but strictly target the size div
$c2 = preg_replace(
    '/(<select name="size\[\]".*?<\/select>\s*<\/div>)/is',
    '$1'."\n        <div id=\"size-price-container\" style=\"background:#f9f9f9; padding: 15px; border-radius: 5px; margin-top: 10px; display: none;\"></div>\n",
    $c2,
    1 // Limit to 1 replacement
);

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
                        <div class="form-group row" style="margin-bottom: 10px; align-items: center;">
                            <label class="col-sm-3 col-form-label" style="margin-bottom: 0;">Price for Size <strong>${size}</strong></label>
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
            $("#size-price-container input").each(function() {
                let name = $(this).attr("name");
                let match = name.match(/\[(.*?)\]/);
                if(match && match[1]) {
                    existingPrices[match[1]] = $(this).val();
                }
            });
            renderSizePrices();
        });
        
        setTimeout(renderSizePrices, 500);
    });
</script>
';
$c2 .= $script2;
file_put_contents($f2, $c2);

echo "Admin views cleaned and properly injected!";
?>
