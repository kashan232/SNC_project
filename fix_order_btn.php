<?php
$f = 'resources/views/user/order/index.blade.php';
$c = file_get_contents($f);

// Find the delete form block
$old_block = '<form method="POST" action="{{route(\'user.order.delete\',[$order->id])}}">
                          @csrf
                          @method(\'delete\')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>';

$new_block = '
                        @php
                            $hoursDiff = \Carbon\Carbon::parse($order->created_at)->diffInHours(\Carbon\Carbon::now());
                        @endphp
                        @if($order->status == \'new\' && $hoursDiff <= 2)
                        <form method="POST" action="{{route(\'user.order.delete\',[$order->id])}}">
                          @csrf
                          @method(\'delete\')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Cancel Order"><i class="fas fa-times"></i></button>
                        </form>
                        @endif
';

$c = str_replace($old_block, $new_block, $c);
file_put_contents($f, $c);

// Also change JS SweetAlert text to 'Cancel' instead of 'Delete'
$c = file_get_contents($f);
$c = str_replace('text: "Once deleted, you will not be able to recover this data!",', 'text: "Are you sure you want to cancel this order?",', $c);
$c = str_replace('swal("Your data is safe!");', 'swal("Order is safe!");', $c);
file_put_contents($f, $c);

echo "Order list updated with 2 hour delete condition.\n";
?>
