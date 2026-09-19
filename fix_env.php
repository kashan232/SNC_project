<?php
$e = file_get_contents('.env');
$e = preg_replace('/^APP_URL=.*$/m', 'APP_URL=http://127.0.0.1:8000', $e);
file_put_contents('.env', $e);
echo 'Updated .env';
