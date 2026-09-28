<?php
$f = 'resources/views/user/order/index.blade.php';
$c = file_get_contents($f);

// Remove the 2 hour check from blade
$old = '@php
                            $hoursDiff = \Carbon\Carbon::parse($order->created_at)->diffInHours(\Carbon\Carbon::now());
                        @endphp
                        @if($order->status == \'new\' && $hoursDiff <= 2)';
$new = '@if($order->status == \'new\')';
$c = str_replace($old, $new, $c);

file_put_contents($f, $c);
echo "Removed 2 hour check from index.\n";
?>
