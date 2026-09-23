<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// We will inject the new hover styles inside the <style> block of the explore section
$newHoverStyles = "
.explore-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(247, 148, 29, 0.3); /* Theme color shadow */
    background: #F7941D; /* Theme color background */
}
.explore-card:hover .explore-img-wrap {
    background-color: #fff !important; /* Force image background to white on hover */
}
.explore-info h3 {
    transition: color 0.4s ease;
}
.explore-card:hover .explore-info h3 {
    color: #fff; /* Text turns white */
}
.explore-card:hover .explore-btn {
    background: #fff;
    color: #F7941D;
    transform: scale(1.1);
}
.explore-card:hover .explore-leaf {
    color: rgba(255, 255, 255, 0.25);
}
";

// Remove old hover rules to avoid conflicts
$c = preg_replace('/\.explore-card:hover\s*\{[^}]+\}/s', '', $c);
$c = preg_replace('/\.explore-card:hover \.explore-btn\s*\{[^}]+\}/s', '', $c);
$c = preg_replace('/\.explore-card:hover \.explore-leaf\s*\{[^}]+\}/s', '', $c);
$c = preg_replace('/\.explore-card:hover \.explore-img-wrap img\s*\{[^}]+\}/s', '', $c);

// Add the new rules right before the end of the style tag
$c = str_replace('</style>', $newHoverStyles . "\n" . '.explore-card:hover .explore-img-wrap img { transform: scale(1.15); }' . "\n</style>", $c);

file_put_contents($f, $c);
echo "Done";
?>
