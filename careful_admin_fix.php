<?php
function injectProperly($f, $isEdit) {
    $c = file_get_contents($f);

    // 1. Add id="size" to selectpicker
    if (strpos($c, 'id="size"') === false) {
        $c = str_replace('name="size[]" class="form-control selectpicker"', 'name="size[]" id="size" class="form-control selectpicker"', $c);
    }

    // 2. Add container immediately after the size select
    // We can do this by finding '<option value="XL">Extra Large (XL)</option>' and the following '</select>'
    $c = preg_replace('/(<option value="XL">Extra Large \(XL\)<\/option>\s*<\/select>\s*<\/div>)/i', '$1'."\n        <div id=\"size-price-container\" style=\"background:#f9f9f9; padding: 15px; border-radius: 5px; margin-top: 10px; display: none;\"></div>\n", $c);

    // 3. Append the script at the VERY end of the file. No regex replacements of @endpush to avoid messing it up.
    // Wait, the file should end with @endpush for the scripts block. If we just append <script> after @endpush, it won't be pushed.
    // Let's insert it right BEFORE the literal last @endpush
    
    $script = '
<script>
    $(document).ready(function() {
        let existingPrices = ' . ($isEdit ? '{!! $product->size_prices ? $product->size_prices : "{}" !!}' : '{}') . ';
        
        function renderSizePrices() {
            let sizes = $("#size").val();
            let container = $("#size-price-container");
            container.empty();
            
            if (sizes) {
                sizes = sizes.filter(s => s !== "");
            }

            if (sizes && sizes.length > 0) {
                container.show();
                container.append("<h5 style=\'font-size: 14px; margin-bottom: 15px; font-weight: bold; color: #333;\'>Set Specific Prices for Selected Sizes (Optional)</h5>");
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
        
        $("#size").on("change changed.bs.select", function() {
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

    // Find the last position of @endpush
    $pos = strrpos($c, '@endpush');
    if ($pos !== false) {
        $c = substr_replace($c, $script . "\n@endpush", $pos, strlen('@endpush'));
    }

    file_put_contents($f, $c);
}

injectProperly('resources/views/backend/product/create.blade.php', false);
injectProperly('resources/views/backend/product/edit.blade.php', true);
echo "Cleanly applied the changes.";
?>
