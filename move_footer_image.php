<?php
$file = 'resources/views/frontend/layouts/footer.blade.php';
$content = file_get_contents($file);

// Move the footer-decor from bottom to top
$old_html = '	</div>
	
	<!-- Footer Decor line -->
	<div class="footer-decor"></div>

	<!-- Red Copyright Bar -->
	<div class="copyright">';

$new_html = '	</div>

	<!-- Red Copyright Bar -->
	<div class="copyright">';
	
$content = str_replace($old_html, $new_html, $content);

// Put it at the top
$old_top = '<footer class="footer">
	<!-- Footer Top -->
	<div class="footer-top">';
	
$new_top = '<footer class="footer">
	<!-- Footer Decor line (Moved to top) -->
	<div class="footer-decor"></div>

	<!-- Footer Top -->
	<div class="footer-top">';
	
$content = str_replace($old_top, $new_top, $content);

// Remove margin-top and border-top from footer-decor css
$old_css = '	.footer-decor {
		width: 100%;
		height: 120px;
		background: url(\'{{asset(\'images/banners/main_banner.jpg\')}}\') repeat-x center center;
		background-size: cover;
		opacity: 1; /* Fully visible */
		margin-top: 30px;
		border-top: 3px solid #e62020;
	}';
	
$new_css = '	.footer-decor {
		width: 100%;
		height: 120px;
		background: url(\'{{asset(\'images/banners/main_banner.jpg\')}}\') repeat-x center center;
		background-size: cover;
		opacity: 1; /* Fully visible */
	}';
	
$content = str_replace($old_css, $new_css, $content);

file_put_contents($file, $content);
echo "Image moved to top of footer.\n";
