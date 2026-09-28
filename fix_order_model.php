<?php
$f = 'app/Models/Order.php';
$c = file_get_contents($f);
$old = "protected \$fillable = ['user_id', 'order_number', 'sub_total', 'quantity', 'delivery_charge', 'status', 'total_amount', 'first_name', 'last_name', 'country', 'post_code', 'address1', 'address2', 'phone', 'email', 'payment_method', 'payment_status', 'shipping_id', 'coupon'];";
$new = "protected \$fillable = ['user_id', 'order_number', 'sub_total', 'quantity', 'delivery_charge', 'status', 'total_amount', 'first_name', 'last_name', 'country', 'post_code', 'address1', 'address2', 'phone', 'email', 'payment_method', 'payment_status', 'shipping_id', 'coupon', 'city_id', 'area_id'];";
$c = str_replace($old, $new, $c);
file_put_contents($f, $c);
echo "Added city_id and area_id to Order fillable array.\n";
?>
