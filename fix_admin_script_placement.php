<?php
$f1 = 'resources/views/backend/product/create.blade.php';
$c1 = file_get_contents($f1);

// Move the script inside @push('scripts') if it is outside
$c1 = preg_replace('/@endpush\s*<script>\s*\$\(document\)\.ready\(function\(\) \{\s*\$\("#size"\)\.on\("change".*?<\/script>/is', '', $c1);
// Also remove it if it was added multiple times
$c1 = preg_replace('/<script>\s*\$\(document\)\.ready\(function\(\) \{\s*\$\("#size"\)\.on\("change".*?<\/script>/is', '', $c1);

$script1 = '
    <script>
        $(document).ready(function() {
            $("#size").on("change changed.bs.select", function() {
                let sizes = $(this).val();
                let container = $("#size-price-container");
                container.empty();
                
                if (sizes) {
                    sizes = sizes.filter(s => s !== "");
                }

                if (sizes && sizes.length > 0) {
                    container.show();
                    container.append("<h5 style=\'font-size: 14px; margin-bottom: 15px; font-weight: bold; color: #333;\'>Set Specific Prices for Selected Sizes (Optional)</h5>");
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
$c1 = str_replace('@endpush', $script1 . "\n@endpush", $c1);
file_put_contents($f1, $c1);


$f2 = 'resources/views/backend/product/edit.blade.php';
$c2 = file_get_contents($f2);

$c2 = preg_replace('/@endpush\s*<script>\s*\$\(document\)\.ready\(function\(\) \{\s*(let existingPrices|let container).*?<\/script>/is', '', $c2);
$c2 = preg_replace('/<script>\s*\$\(document\)\.ready\(function\(\) \{\s*(let existingPrices|let container).*?<\/script>/is', '', $c2);

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
$c2 = str_replace('@endpush', $script2 . "\n@endpush", $c2);
file_put_contents($f2, $c2);

echo "Scripts moved inside @push('scripts') correctly.";
?>
