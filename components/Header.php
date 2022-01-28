<?php

session_start();
$isLogin = false;

if (isset($_SESSION['email'])) {
   $isLogin = true;
}

function imgSrc($code) {
   $fileName =  (file_exists("./img/$code.jpg")) ? $code : 'noimage';
   return "/img/$fileName.jpg";
}

function publicRoute($isLogin) {
   if ($isLogin) {
      header('Location: /');
      exit();
   }
}

function privateRoute($isLogin) {
   if (!$isLogin) {
      header('Location: /login.php');
      exit();
   }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>xocolate</title>
   <link rel="stylesheet" href="./css/style.css">
</head>

<body>
   <header class="header">
      <div class="header__wrapper">
         <a href="/">
            <img src="./img/logo.png" alt="xocolate">
         </a>
         <ul class="header__nav">
            <?php if ($isLogin) : ?>
               <li class="header__nav--item">
                  <a href="/logout.php">ログアウト</a>
               </li>
            <?php else : ?>
               <li class="header__nav--item">
                  <a href="/signup.php">新規会員登録</a>
               </li>
               <li class='header__nav--item'>
                  <a href="/login.php">ログイン</a>
               </li>
            <?php endif; ?>
            <li class="header__nav--item">
               <a href="/cart.php">カート</a>
            </li>
         </ul>
      </div>
   </header>
