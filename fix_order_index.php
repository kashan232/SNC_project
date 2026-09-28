<?php
$f = 'resources/views/backend/order/index.blade.php';
$c = file_get_contents($f);

// Update table headers
$c = str_replace('<th>Email</th>', "<th>Email</th>\n              <th>City/Area</th>", $c);

// Update table body
$body_old = '<td>{{$order->email}}</td>';
$body_new = '<td>{{$order->email}}</td>
              <td>
                @if($order->city) 
                    <span class="badge badge-info">{{$order->city->name}}</span>
                @endif
                @if($order->area)
                    <br><small class="text-muted">{{$order->area->name}}</small>
                @endif
              </td>';
$c = str_replace($body_old, $body_new, $c);

file_put_contents($f, $c);
echo "Added City/Area to admin order index.\n";
?>
