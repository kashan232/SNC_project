<?php
$f = 'resources/views/user/order/show.blade.php';
$c = file_get_contents($f);

$old_header = '<a href="{{route(\'user.order.index\')}}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Orders</a>';

$new_header = '
    <div>
        <a href="{{route(\'user.order.index\')}}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Orders</a>
        
        @php
            $hoursDiff = \Carbon\Carbon::parse($order->created_at)->diffInHours(\Carbon\Carbon::now());
        @endphp
        @if($order->status == \'new\' && $hoursDiff <= 2)
        <form method="POST" action="{{route(\'user.order.delete\',[$order->id])}}" class="d-inline-block ml-2">
            @csrf
            @method(\'delete\')
            <button class="btn btn-sm btn-danger shadow-sm" onclick="return confirm(\'Are you sure you want to cancel this order?\')"><i class="fas fa-times fa-sm text-white-50"></i> Cancel Order</button>
        </form>
        @endif
    </div>
';

$c = str_replace($old_header, $new_header, $c);
file_put_contents($f, $c);
echo "Cancel button added to order detail.\n";
?>
