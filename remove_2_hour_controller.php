<?php
$f = 'app/Http/Controllers/HomeController.php';
$c = file_get_contents($f);

// Remove the 2 hour check from controller
$old = 'if ($order->status == "process" || $order->status == \'delivered\' || $order->status == \'cancel\') {
                return redirect()->back()->with(\'error\', \'You can not cancel this order because it is already processed or delivered.\');
            } elseif ($hoursDiff > 2) {
                return redirect()->back()->with(\'error\', \'You can only cancel/delete an order within 2 hours of placing it.\');
            } else {';

$new = 'if ($order->status == "process" || $order->status == \'delivered\' || $order->status == \'cancel\') {
                return redirect()->back()->with(\'error\', \'You can not cancel this order because it is already processed or delivered.\');
            } else {';
            
$c = str_replace($old, $new, $c);
file_put_contents($f, $c);
echo "Removed 2 hour check from controller.\n";
?>
