<?php

session_start();
if (!isset($_SESSION['admin_id'])) {
   header('Location: /admin/login.php');
   exit();
}


if (@$_POST['submit']) {
   $id = $_POST['id'];
   $name = $_POST['name'];
   $price = $_POST['price'];
   $category = $_POST['category'];
   $itemJson = file_get_contents('../item.json');
   $itemJson = json_decode($itemJson, TRUE);
   $updateIndex = array_search($id, array_column($itemJson, 'id'));
   var_dump($itemJson[$updateIndex]);
   echo '<br>';
   if (!$name) $error .= '商品名を入力してください。<br>';
   if (!$price) $error .= '価格を入力してください。<br>';
   if (preg_match('/\D/', $price)) $error .= '価格を正確に入力してください。<br>';
   $itemJson[$updateIndex] = array(
      "id" => $itemJson[$updateIndex]['id'],
      "name" => $name,
      "price" => $price,
      "category" => $category,
   );
   var_dump($itemJson[$updateIndex]);
   $itemJson = json_encode($itemJson);
   file_put_contents('../item.json', $itemJson);
   header('Location: index.php');
   exit();
}
