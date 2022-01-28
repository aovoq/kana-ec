<?php
session_start();
$error = $name = $category = $price = '';
if (!isset($_SESSION['admin_id'])) {
   header('Location: /admin/login.php');
   exit();
}


if (@$_POST['submit']) {
   $name = $_POST['name'];
   $price = $_POST['price'];
   $category = $_POST['category'];
   if (!$name) $error .= '商品名を入力してください。<br>';
   if (!$price) $error .= '価格を入力してください。<br>';
   if (preg_match('/\D/', $price)) $error .= '価格を正確に入力してください。<br>';
   if (!$error) {
      $itemJson = file_get_contents('../item.json');
      $itemJson = json_decode($itemJson);
      $itemJson[] = array(
         //NOTE: UUIDの方がいいかも
         "id" => date('YmdHis'),
         "name" => $name,
         "price" => $price,
         "category" => $category,
      );
      $itemJson = json_encode($itemJson);
      file_put_contents('../item.json', $itemJson);
      header('Location: index.php');
      exit();
   }
} else {
   echo 'ERROR';
}
