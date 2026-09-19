<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$start = strpos($c, 'our-products-area');
$end = strpos($c, 'our-outlets-premium');

if ($start !== false && $end !== false) {
    $before = substr($c, 0, $start);
    $block = substr($c, $start, $end - $start);
    $after = substr($c, $end);
    
    // In $block, find all single-product divs
    $block = preg_replace_callback('/(\<div class="single-product".*?\>)(.*?)(\<\/div\>\s*\<\/div\>)/s', function($matches) {
        $card = $matches[2];
        
        $button_head_start = strpos($card, '<div class="button-head">');
        if ($button_head_start !== false) {
            $open = 1;
            $pos = $button_head_start + 25;
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
            
            $button_head_html = substr($card, $button_head_start, $pos - $button_head_start + 1);
            $card = str_replace($button_head_html, '', $card);
            
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
                
                $card = substr_replace($card, "\n" . $button_head_html . "\n", $pos + 1, 0);
            }
        }
        
        return $matches[1] . $card . $matches[3];
    }, $block);
    
    $c = $before . $block . $after;
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Moved button-head perfectly in DOM.";
} else {
    echo "Could not find boundaries.";
}
