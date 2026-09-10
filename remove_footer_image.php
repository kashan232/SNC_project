<?php
$file = 'resources/views/frontend/layouts/footer.blade.php';
$content = file_get_contents($file);

// Remove the HTML
$content = str_replace('<!-- Footer Decor line (Moved to top) -->
	<div class="footer-decor"></div>', '', $content);
	
$content = str_replace('<!-- Footer Decor line -->
	<div class="footer-decor"></div>', '', $content);

// Remove the CSS block (using regex to be safe)
$content = preg_replace('/\/\* Decorative Bottom Image Layer \*\/.*?\}/s', '', $content);

file_put_contents($file, $content);
echo "Footer image removed.\n";
