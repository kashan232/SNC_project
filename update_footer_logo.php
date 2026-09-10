<?php
$source = 'C:/Users/Admin/.gemini/antigravity/brain/6b95a971-0927-49fe-b1af-de49642894f7/.user_uploaded/media_1789021289074.jpg';
$dest = 'public/images/footer_logo.jpg';
copy($source, $dest);

$file = 'resources/views/frontend/layouts/footer.blade.php';
$content = file_get_contents($file);

$old_logo = <<<HTML
<a href="{{route('home')}}" style="font-family: 'Poppins', sans-serif; font-size: 26px; font-weight: 800; color: #111; text-decoration: none; line-height: 1.2; display: inline-block;">
                                SHOUKAT<br><span style="color: var(--primary-color);">NIMCO CENTER</span>
                            </a>
HTML;

$new_logo = <<<HTML
<a href="{{route('home')}}">
                                <img src="{{asset('images/footer_logo.jpg')}}" alt="Shoukat Nimco Center Logo" style="max-width: 150px; border-radius: 8px;">
                            </a>
HTML;

$content = str_replace($old_logo, $new_logo, $content);
file_put_contents($file, $content);

echo "Logo copied and footer updated.\n";
