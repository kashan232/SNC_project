<?php
$c=file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
echo 'if: '.substr_count($c,'@if').' endif: '.substr_count($c,'@endif')."\n";
echo 'foreach: '.substr_count($c,'@foreach').' endforeach: '.substr_count($c,'@endforeach')."\n";

// Let's also check the most popular section to see if I removed an @endif or @endforeach.
$lines = explode("\n", $c);
$stack = [];
foreach($lines as $i => $l) {
    if (strpos($l, '@if') !== false && strpos($l, '@elseif') === false) $stack[] = ['if', $i];
    if (strpos($l, '@foreach') !== false) $stack[] = ['foreach', $i];
    if (strpos($l, '@endif') !== false) {
        $last = array_pop($stack);
        if ($last[0] !== 'if') echo "Mismatch at line $i: expected end of {$last[0]}, got endif\n";
    }
    if (strpos($l, '@endforeach') !== false) {
        $last = array_pop($stack);
        if ($last[0] !== 'foreach') echo "Mismatch at line $i: expected end of {$last[0]}, got endforeach\n";
    }
}
if (count($stack) > 0) {
    echo "Unclosed blocks:\n";
    print_r($stack);
}
