<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$start = strpos($c, 'our-products-area');
if ($start !== false) {
    // Just find all occurrences of <div class="product-action d-flex...
    // and replace them!
    
    // We want to move it to AFTER <div class="product-content">...</div>
    
    // Instead of parsing the whole card, let's just use preg_replace on the whole block!
    
    $block = substr($c, $start); // Just search from our-products-area to the end
    
    // Find the product-action block
    // <div class="product-action ... w-100">
    // ...
    // </div>
    // </div>
    // </div>
    // <div class="product-content">
    // ...
    // </div>
    
    // The structure is ALWAYS:
    // <div class="product-action [anything]"> [content] </div>
    // </div>
    // </div>
    // <div class="product-content"> [content] </div>
    
    // Let's match this exact sequence!
    $pattern = '/(\<div class="product-action.*?\>.*?\<\/div\>)\s*(\<\/div\>\s*\<\/div\>\s*)(\<div class="product-content"\>.*?\<\/div\>\s*\<\/div\>)/s';
    
    $block = preg_replace_callback($pattern, function($matches) {
        $action = $matches[1];
        $closing_divs = $matches[2];
        $content = $matches[3];
        
        // Wrap action in button-head
        $action_wrapped = '<div class="button-head">' . "\n" . $action . "\n" . '</div>';
        
        // Return swapped!
        return $closing_divs . $content . "\n" . $action_wrapped . "\n";
    }, $block);
    
    $c = substr($c, 0, $start) . $block;
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Swapped using pure pattern matching!";
}
