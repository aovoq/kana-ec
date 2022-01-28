<?php
include('components/Header.php');
privateRoute($isLogin);
$total = 0;

$email = $_SESSION['email'];
$userJson = file_get_contents('user.json');
$userJson = json_decode($userJson, TRUE);
$agreeIndex = array_search($email, array_column($userJson, 'email'));
if ($agreeIndex === false) {
   echo 'error';
   exit();
}
$user = $userJson[$agreeIndex];

$itemJson = file_get_contents('./item.json');
$itemJson = json_decode($itemJson, TRUE);

foreach ($_SESSION['cart'] as $id => $count) {
   $cartItem = $itemJson[array_search($id, array_column($itemJson, 'id'))];
   $cartItem['count'] = $count;
   $total += $count * $cartItem['price'];
   $cartItems[] = $cartItem;
}

?>

<main class="container">
   <div>
      <h2 class="buy__headline">発送先住所</h2>
      <div class="address__wrapper">
         <table class="address__table">
            <tr class="address__table--item">
               <td>名前</td>
               <td>:</td>
               <td><?= $user['lastName'] . $user['firstName'] ?></td>
            </tr>
            <tr class="address__table--item">
               <td>郵便番号</td>
               <td>:</td>
               <td><?= substr($user['zip'], 0, 3) . '-' . substr($user['zip'], 3, 4); ?></td>
            </tr>
            <tr class="address__table--item">
               <td>住所</td>
               <td>:</td>
               <td><?= $user['pref'] . $user['address'] . $user['building'] ?></td>
            </tr>
         </table>
      </div>
   </div>
   <div>
      <h2 class="buy__headline">ご注文内容 </h2>
      <div class="cart__wrapper">
         <?php if (isset($cartItems)) : foreach ($cartItems as $cartItem) { ?>
               <div class="cart__item">
                  <div>
                     <img src="<?= imgSrc($cartItem['id']) ?>">
                  </div>
                  <div class="cart__item--detail">
                     <p class="cart__item--name"><?= $cartItem['name'] ?></p>
                     <p class="cart__item--price">価格 : ￥<?= $cartItem['price'] ?> (税込)</p>
                     <p class="cart__item--count">個数 : <?= $cartItem['count'] ?>個</p>
                     <p class="cart__item--subtotal">小計 : <?= $cartItem['price'] * $cartItem['count'] ?></p>
                  </div>
               </div>
         <?php }
         else : echo "<div class='cart__empty'>カートに商品がありません。</div>";
         endif;
         ?>
      </div>
   </div>
   <div class="cart__total">
      <p>ご注文合計</p>
      <p>￥<?= $total ?> (税込)</p>
   </div>
   <div>
      <a href="done.php" class="cart__button">ご注文確定</a>
   </div>
</main>
