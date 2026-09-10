<?php
$file = 'resources/views/frontend/layouts/header.blade.php';
$content = file_get_contents($file);

// Find the nav menu and add the link
$old_nav = <<<HTML
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Contact Us</a></li>
                                        </ul>
HTML;

$new_nav = <<<HTML
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Contact Us</a></li>
                                            <li><a href="/#our-outlets">Our Outlets</a></li>
                                        </ul>
HTML;

$content = str_replace($old_nav, $new_nav, $content);

file_put_contents($file, $content);
echo "Header navbar updated.\n";
