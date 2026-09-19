<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$c = preg_replace('/@endsection\s*@endsection/is', '@endsection', $c);
// Just in case they are separated by something else:
$count = substr_count($c, '@endsection');
if ($count > 1) {
    // replace first occurrence
    $c = preg_replace('/@endsection/i', '', $c, 1);
}
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Extra @endsection removed. Current count: " . substr_count($c, '@endsection');
