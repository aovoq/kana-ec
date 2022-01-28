<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
   header('Location: /admin/login.php');
   exit();
}

$orderJson = file_get_contents('../order.json');
$orderJson = json_decode($orderJson, TRUE);

$orderJson[$_POST['index']]['todo'] = !$orderJson[$_POST['index']]['todo'];

$orderJson = json_encode($orderJson);
file_put_contents('../order.json', $orderJson);

header('Location: /admin/order.php');
exit();
