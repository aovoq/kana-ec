<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
   header('Location: /admin/login.php');
   exit();
}

$id = $_GET['id'];
$itemJson = file_get_contents('../item.json');
$itemJson = json_decode($itemJson);
$removeIndex = array_search($id, array_column($itemJson, 'id'));


array_splice($itemJson, $removeIndex, 1);
$itemJson = json_encode($itemJson);
file_put_contents('../item.json', $itemJson);
header('Location: index.php');
exit();
