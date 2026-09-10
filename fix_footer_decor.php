<?php
$file = 'resources/views/frontend/layouts/footer.blade.php';
$content = file_get_contents($file);

// Replace the CSS block for .footer-decor
$old_decor = "	/* Decorative Bottom Image Layer */
	.footer-decor {
		width: 100%;
		height: 80px;
		background: url('{{asset('images/banners/main_banner.jpg')}}') repeat-x center center;
		background-size: cover;
		opacity: 0.1;
		margin-top: 10px;
	}";

$new_decor = "	/* Decorative Bottom Image Layer */
	.footer-decor {
		width: 100%;
		height: 120px;
		background: url('{{asset('images/banners/main_banner.jpg')}}') repeat-x center center;
		background-size: cover;
		opacity: 1; /* Fully visible */
		margin-top: 30px;
		border-top: 3px solid #e62020;
	}";

$content = str_replace($old_decor, $new_decor, $content);

file_put_contents($file, $content);
echo "Decor opacity and height updated.\n";
