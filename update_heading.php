<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$new_heading = <<<HTML
                <div class="section-title text-center" style="margin-bottom: 50px;">
                    <span style="color: #ffffff; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; font-size: 16px; display: block; margin-bottom: 10px; opacity: 0.9;">Top Picks</span>
                    <h2 style="font-size: 50px; font-weight: 800; color: #ffffff; margin-top: 0; position: relative; display: inline-block;">
                        Featured Products
                        <div style="position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background: #ffffff; border-radius: 5px;"></div>
                    </h2>
                </div>
HTML;

// Replace the current custom heading
$c = preg_replace('/\<div class="section-title text-center".*?\>.*?\>Top Picks\<\/span\>.*?Featured.*?\<\/h2\>\s*\<\/div\>/is', $new_heading, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Heading updated to white and single font.";
