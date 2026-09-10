<?php
$file = 'resources/views/frontend/layouts/footer.blade.php';
$content = file_get_contents($file);

$broken_css = "	}') repeat-x center center;
		background-size: cover;
		opacity: 1; /* Fully visible */
	}";

$content = str_replace($broken_css, "", $content);

file_put_contents($file, $content);
echo "Fixed broken CSS in footer.\n";
