<?php
require __DIR__ . "/../config/config.php";

$result = $conn->query("SELECT orders.id, users.name, orders.course_name, orders.order_date 
    FROM orders 
    JOIN users ON orders.user_id = users.id 
    ORDER BY orders.order_date DESC");

// Nechta satr borligini tekshiramiz
var_dump($result->num_rows);
exit; 
?>
