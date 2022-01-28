<?php
session_start();
$err = '';

if (isset($_POST['id']) && isset($_POST['password'])) {
   if ($_POST['id'] == 'admin' && $_POST['password'] == 'password') {
      session_regenerate_id();
      $_SESSION['admin_id'] = $_POST['id'];
      header('Location: index.php');
      exit();
   } else {
      $err = 'パスワードと名前が一致しません';
   }
} else {
   $err = 'IDとパスワードを入力してください。';
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin</title>
</head>

<body>
   <form action="/admin/login.php" method="post">
      <p><?= $err ?></p>
      <div>
         <label>id</label>
         <input name="id" type="text">
      </div>
      <div>
         <label>password</label>
         <input name="password" type="password">
      </div>
      <input type="submit" value="login">
   </form>

</body>

</html>
