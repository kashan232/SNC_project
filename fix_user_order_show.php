<?php
$f = 'resources/views/user/order/show.blade.php';
$c = file_get_contents($f);

$old = '<p class="text-muted small mb-0">{{ $order->country }} <br> Post Code: {{ $order->post_code }}</p>';
$new = '<p class="text-muted small mb-0">
                @if($order->city)
                    <strong>City:</strong> {{ $order->city->name }} <br>
                @endif
                @if($order->area)
                    <strong>Area:</strong> {{ $order->area->name }} <br>
                @endif
                @if(!$order->city && !$order->area)
                    {{ $order->country }} <br>
                @endif
                Post Code: {{ $order->post_code }}
            </p>';

$c = str_replace($old, $new, $c);
file_put_contents($f, $c);
echo "Added city/area to User Order Show.\n";
?>
