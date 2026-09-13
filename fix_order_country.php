<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$order_controller = file_get_contents($base_dir . 'app/Http/Controllers/OrderController.php');

$order_controller = str_replace(
    "\$order_data['payment_status']='Unpaid';\n        }\n        \$order->fill(\$order_data);",
    "\$order_data['payment_status']='Unpaid';\n        }\n        \$order_data['country'] = 'PK';\n        \$order->fill(\$order_data);",
    $order_controller
);

file_put_contents($base_dir . 'app/Http/Controllers/OrderController.php', $order_controller);
echo "Order controller fixed.\n";
