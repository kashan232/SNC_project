<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$start = strpos($c, '<!-- Start Product Area -->');
$end = strpos($c, '<!-- End Product Area -->');

if ($start !== false && $end !== false) {
    $before = substr($c, 0, $start);
    $block = substr($c, $start, $end - $start);
    $after = substr($c, $end);
    
    // We want to find: <div class="button-head"> ... </div></div>
    // Extract it, remove it, and insert it after the end of <div class="product-content">
    
    $pos = 0;
    while (($button_start = strpos($block, '<div class="button-head">', $pos)) !== false) {
        // Find the end of this button-head block. It contains one inner div.
        // Actually, it always looks like:
        /*
        <div class="button-head">
            <div class="product-action d-flex justify-content-center align-items-center w-100">
                <a...</a>
                <a...</a>
                <a...</a>
            </div>
        </div>
        */
        $button_end = strpos($block, '</div>', $button_start); // closes product-action
        $button_end = strpos($block, '</div>', $button_end + 1); // closes button-head
        $button_end += 6; // include </div>
        
        // Extract the button-head HTML
        $button_html = substr($block, $button_start, $button_end - $button_start);
        
        // Remove it from the block
        $block = substr_replace($block, '', $button_start, $button_end - $button_start);
        
        // Now, we need to find where to insert it.
        // It should be inserted at the end of the very next <div class="product-content"> block.
        // Wait, the next tag after removing button_head is `</div>` (which closed product-img).
        // Then `<div class="product-content">`
        
        $content_start = strpos($block, '<div class="product-content">', $button_start);
        if ($content_start !== false) {
            // Find the end of product-content using a simple stack parser
            $open = 1;
            $curr = $content_start + 29; // length of <div class="product-content">
            while ($open > 0 && $curr < strlen($block)) {
                $next_open = strpos($block, '<div', $curr);
                $next_close = strpos($block, '</div', $curr);
                
                if ($next_open !== false && $next_open < $next_close) {
                    $open++;
                    $curr = $next_open + 4;
                } else if ($next_close !== false) {
                    $open--;
                    $curr = $next_close + 5;
                } else {
                    break;
                }
            }
            
            // curr is now just after the closing </div> of product-content
            // Wait, $curr is at `</div` + 5 = the end of the `</div>` tag... wait, `</div>` is 6 chars!
            $curr = $curr + 1; // to include the `>` of `</div>`
            
            // Insert button_html here
            $block = substr_replace($block, "\n" . trim($button_html) . "\n", $curr, 0);
            
            // Move pos past the inserted block to find the next one
            $pos = $curr + strlen($button_html);
        } else {
            $pos = $button_start + 1;
        }
    }
    
    $c = $before . $block . $after;
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Moved buttons!";
}
