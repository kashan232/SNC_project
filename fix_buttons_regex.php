<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$start = strpos($c, 'our-products-area');
$end = strpos($c, 'our-outlets-premium');

if ($start !== false && $end !== false) {
    $before = substr($c, 0, $start);
    $block = substr($c, $start, $end - $start);
    $after = substr($c, $end);
    
    // In our-products-area, move product-action to be AFTER product-content
    $block = preg_replace_callback('/(\<div class="single-product".*?\>)(.*?)(\<\/div\>\s*\<\/div\>)/s', function($matches) {
        $card = $matches[2];
        
        // Extract the product-action block using regex (no nested divs inside it!)
        if (preg_match('/\<div class="product-action d-flex.*?\<\/div\>/s', $card, $action_matches)) {
            $action_html = $action_matches[0];
            
            // Remove it from the original place
            $card = str_replace($action_html, '', $card);
            
            // Find end of product-content
            $content_start = strpos($card, '<div class="product-content">');
            if ($content_start !== false) {
                $open = 1;
                $pos = $content_start + 29;
                while ($open > 0 && $pos < strlen($card)) {
                    $next_open = strpos($card, '<div', $pos);
                    $next_close = strpos($card, '</div', $pos);
                    if ($next_open !== false && $next_open < $next_close) {
                        $open++;
                        $pos = $next_open + 4;
                    } else if ($next_close !== false) {
                        $open--;
                        $pos = $next_close + 5;
                    } else {
                        break;
                    }
                }
                
                // Insert the action_html AFTER product-content, wrapped in button-head
                $card = substr_replace($card, "\n" . '<div class="button-head">' . "\n" . $action_html . "\n" . '</div>' . "\n", $pos + 1, 0);
            }
        }
        
        return $matches[1] . $card . $matches[3];
    }, $block);
    
    $c = $before . $block . $after;
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Moved product-action perfectly using Regex + DOM!";
} else {
    echo "Could not find our-products-area boundaries!";
}
