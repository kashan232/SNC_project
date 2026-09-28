<?php
function fixScript($f) {
    $c = file_get_contents($f);

    // Remove the misplaced script from anywhere
    $c = preg_replace('/<script>\s*\$\(document\)\.ready\(function\(\) \{\s*\$\("#size"\)\.on\("change.*?(?=<\/script>)<\/script>/is', '', $c);

    // Now insert it correctly at the end of the file, inside @push('scripts') if it exists, or just append it.
    // The safest way is to append it just before the final @endpush (which is usually the scripts push)
    // Wait, let's just append it to the absolute bottom of the file if @push('scripts') is the last block.
    // Let's replace the last @endpush with our script and @endpush.
    
    // We do this by finding the last @endpush
    $pos = strrpos($c, '@endpush');
    if ($pos !== false) {
        $script = '
<script>
    $(document).ready(function() {
        let existingPrices = ' . ($f == 'resources/views/backend/product/edit.blade.php' ? '{!! $product->size_prices ? $product->size_prices : "{}" !!}' : '{}') . ';
        
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
        $c = substr_replace($c, $script . "\n@endpush", $pos, strlen('@endpush'));
    }

    file_put_contents($f, $c);
}

fixScript('resources/views/backend/product/create.blade.php');
fixScript('resources/views/backend/product/edit.blade.php');
echo "Fixed script placement by putting it in the correct push block at the end.";
?>
