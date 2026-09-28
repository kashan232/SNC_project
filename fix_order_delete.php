<?php
$f = 'app/Http/Controllers/HomeController.php';
$c = file_get_contents($f);

$old_func = 'public function userOrderDelete($id)
    {
        $order = Order::find($id);
        if ($order) {
            if ($order->status == "process" || $order->status == \'delivered\' || $order->status == \'cancel\') {
                return redirect()->back()->with(\'error\', \'You can not delete this order now\');
            } else {
                $status = $order->delete();
                if ($status) {
                    request()->session()->flash(\'success\', \'Order Successfully deleted\');
                } else {
                    request()->session()->flash(\'error\', \'Order can not deleted\');
                }
                return redirect()->route(\'user.order.index\');
            }
        } else {
            request()->session()->flash(\'error\', \'Order can not found\');
            return redirect()->back();
        }
    }';

$new_func = 'public function userOrderDelete($id)
    {
        $order = Order::find($id);
        if ($order) {
            // Check time difference (in hours)
            $createdAt = \Carbon\Carbon::parse($order->created_at);
            $now = \Carbon\Carbon::now();
            $hoursDiff = $createdAt->diffInHours($now);

            if ($order->status == "process" || $order->status == \'delivered\' || $order->status == \'cancel\') {
                return redirect()->back()->with(\'error\', \'You can not cancel this order because it is already processed or delivered.\');
            } elseif ($hoursDiff > 2) {
                return redirect()->back()->with(\'error\', \'You can only cancel/delete an order within 2 hours of placing it.\');
            } else {
                // Change status to cancel instead of fully deleting from DB to keep record
                $order->status = \'cancel\';
                $status = $order->save();
                if ($status) {
                    request()->session()->flash(\'success\', \'Order Successfully cancelled\');
                } else {
                    request()->session()->flash(\'error\', \'Order could not be cancelled\');
                }
                return redirect()->route(\'user.order.index\');
            }
        } else {
            request()->session()->flash(\'error\', \'Order not found\');
            return redirect()->back();
        }
    }';

$c = str_replace($old_func, $new_func, $c);
file_put_contents($f, $c);
echo "Order delete logic updated to 2-hour window and cancel instead of hard delete.";
?>
