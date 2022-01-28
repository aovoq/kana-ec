<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
   header('Location: /admin/login.php');
   exit();
}

$err = '';
if (@$_POST['submit']) {
   $id = $_POST['id'];
   if (move_uploaded_file($_FILES['image']['tmp_name'], "../img/$id.jpg")) {
      header('Location: index.php');
      exit();
   } else {
      $err .= 'ファイルを選択してください。<br>';
   }
}
