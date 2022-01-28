<?php
include('components/Header.php');
privateRoute($isLogin);

if (!isset($_SESSION['cart'])) {
   header('Location: /');
   exit();
}

$orderJson = file_get_contents('order.json');
$orderJson = json_decode($orderJson);
$orderJson[] = array(
   "email" => $_SESSION['email'],
   "order" => $_SESSION['cart'],
   "todo" => false
);
$orderJson = json_encode($orderJson);
file_put_contents('order.json', $orderJson);

$_SESSION['cart'] = null;

?>

<main class="container">
   <h1 class="done__text">ご注文が完了しました。</h1>
   <h2 class="done__text--small">商品の到着をお待ちください。</h2>
   <a href="/" class="done__back">もどる</a>
</main>
