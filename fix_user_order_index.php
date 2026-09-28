<?php
$f = 'resources/views/user/order/index.blade.php';
$c = file_get_contents($f);

// Improve table display classes
$c = str_replace('<table class="table table-bordered" id="order-dataTable"', '<table class="table table-hover table-bordered table-striped align-middle" id="order-dataTable"', $c);

// Add styling for badges if not already neat
$c = str_replace('<td>Rs:{{$order->shipping->price ?? \'\' }}</td>', '<td>Rs. {{ number_format($order->shipping->price ?? 0, 2) }}</td>', $c);
$c = str_replace('<td>Rs:{{number_format($order->total_amount,2)}}</td>', '<td class="font-weight-bold text-primary">Rs. {{number_format($order->total_amount,2)}}</td>', $c);

// Also make order number bold
$c = str_replace('<td>{{$order->order_number}}</td>', '<td class="font-weight-bold">{{$order->order_number}}</td>', $c);

// Make the Actions column slightly wider so buttons fit neatly
$c = str_replace('<th>Action</th>', '<th style="width: 100px;">Action</th>', $c);

file_put_contents($f, $c);
echo "User orders index improved.";
?>
