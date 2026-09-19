<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$old_heading = <<<HTML
                <div class="section-title text-center" style="margin-bottom: 25px;">
                    <span style="color: var(--primary-color); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">Top Picks</span>
                    <h2 style="font-family: 'Orbitron', sans-serif; font-size: 32px; font-weight: 800; color: #222; margin-top: 10px;">Featured <span style="color: var(--primary-color);">Products</span></h2>
                </div>
HTML;

$new_heading = <<<HTML
                <div class="section-title text-center" style="margin-bottom: 50px;">
                    <span style="color: #c1540b; font-weight: 800; text-transform: uppercase; letter-spacing: 5px; font-size: 16px; display: block; margin-bottom: 10px;">Top Picks</span>
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 52px; font-weight: 900; color: #222; margin-top: 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.05); position: relative; display: inline-block;">
                        Featured <span style="color: #c1540b; font-family: 'Playfair Display', serif; font-style: italic;">Products</span>
                        <div style="position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background: linear-gradient(90deg, #c1540b, #e67e22); border-radius: 10px;"></div>
                    </h2>
                </div>
HTML;

// Replace exactly
if (strpos($c, "Top Picks") !== false) {
    // Because spacing might be different, let's use regex
    $c = preg_replace('/\<div class="section-title text-center".*?\>.*?\>Top Picks\<\/span\>.*?Featured.*?\<\/h2\>\s*\<\/div\>/is', $new_heading, $c);
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Heading redesigned.";
} else {
    echo "Heading not found.";
}
