<?php
include('components/Header.php');
$total = 0;

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();

if (@$_POST['delete']) {
   deleteItem($_POST['id']);
}

if (@$_POST['changeCount']) {
   $_SESSION['cart'][$_POST['id']] = (int)$_POST['changeCount'];
}

if (@$_POST['submit']) {
   @$_SESSION['cart'][$_POST['id']] += $_POST['count'];
}


$itemJson = file_get_contents('./item.json');
$itemJson = json_decode($itemJson, TRUE);

foreach ($_SESSION['cart'] as $id => $count) {
   $cartItem = $itemJson[array_search($id, array_column($itemJson, 'id'))];
   $cartItem['count'] = $count;
   $total += $count * $cartItem['price'];
   $cartItems[] = $cartItem;
}

function deleteItem($deleteId) {
   unset($_SESSION['cart'][$deleteId]);
}

// TODO: 個数が9個以上にならないようにする

?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>カート</title>
</head>

<body class="cart">
   <div>
      <h2 class="cart__title">ショッピングカート</h2>
   </div>
   <div class="container">
      <div class="cart__wrapper">
         <?php if (isset($cartItems)) : foreach ($cartItems as $cartItem) { ?>
               <div class="cart__item">
                  <div>
                     <img src="<?= imgSrc($cartItem['id']) ?>">
                  </div>
                  <div class="cart__item--detail">
                     <p class="cart__item--name"><?= $cartItem['name'] ?></p>
                     <p class="cart__item--price">価格 : ￥<?= $cartItem['price'] ?> (税込)</p>
                     <p>
                     <form method="post">
                        <input type="hidden" name="id" value="<?= $cartItem['id'] ?>">
                        <select name="changeCount" onchange="submit(this.form)">
                           <?php
                           for ($x = 1; $x <= 9; $x++) {
                              if ($x == $cartItem['count']) {
                                 echo "<option value='$x' selected>$x</option>";
                              } else {
                                 echo "<option value='$x'>$x</option>";
                              }
                           }
                           ?>
                        </select>個 小計 : ￥<?= $cartItem['price'] * $cartItem['count'] ?> (税込)
                     </form>
                     </p>
                  </div>
                  <div>
                     <form method="post">
                        <input type="hidden" name="id" value="<?= $cartItem['id'] ?>">
                        <button name="delete" value="delete" class="cart__deleteButton">削除</button>
                     </form>
                  </div>
               </div>
         <?php }
         else : echo "<div class='cart__empty'>カートに商品がありません。</div>";
         endif;
         ?>

      </div>
      <div class="cart__total">
         <p>ご注文合計</p>
         <p>￥<?= $total ?> (税込)</p>
      </div>
      <div><a href="buy.php" class="cart__button">レジに進む</a></div>
      <div><a href="clear.php" class="cart__button">カートを空にする</a></div>
      <div><a href="/" class="cart__button">お買い物を続ける</a></div>
   </div>
</body>

</html>
