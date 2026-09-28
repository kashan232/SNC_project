<?php
$f = 'resources/views/frontend/pages/order-track.blade.php';
$c = file_get_contents($f);

$old = '<div class="info-row">
                                            <span>Current Status:</span>';
$new = '<div class="info-row">
                                            <span>City/Area:</span>
                                            <strong>
                                                @if($order->city) {{ $order->city->name }} @else {{ $order->country }} @endif 
                                                @if($order->area) - {{ $order->area->name }} @endif
                                            </strong>
                                        </div>
                                        <div class="info-row">
                                            <span>Current Status:</span>';

$c = str_replace($old, $new, $c);
file_put_contents($f, $c);
echo "Added city/area to Order Track.\n";
?>
