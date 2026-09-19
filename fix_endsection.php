<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// First, let's remove any @endsection currently in the file.
$c = str_ireplace('@endsection', '', $c);

// Now, we need to insert @endsection right before @push('styles') OR @push('scripts') - whichever comes first.
// Wait, we know @push('styles') or @push('scripts') starts the footer stuff.
$push_pos = strpos($c, "@push('styles')");
if ($push_pos === false) {
    $push_pos = strpos($c, "@push('scripts')");
}

if ($push_pos !== false) {
    $before = substr($c, 0, $push_pos);
    $after = substr($c, $push_pos);
    $c = $before . "\n@endsection\n" . $after;
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Fixed @endsection position successfully.";
} else {
    // Just append it to the end if no @push is found
    $c .= "\n@endsection\n";
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Appended @endsection at the end.";
}
