<?php
include('./components/Header.php');
$itemJson = file_get_contents('./item.json');
$itemJson = json_decode($itemJson, TRUE);
$itemIndex = array_keys(array_column($itemJson, 'category'), 'cakes');
?>

<div class='hero-img baked'></div>
<main class="container">
   <h2 class='categoryTitle'>ケーキ</h2>
   <p class='categoryTitle--sub'>CAKES</p>
   <ul class="itemList">
      <?php foreach ($itemIndex as $i) { ?>
         <li class='itemList__item'>
            <p class='itemList__title'><?= $itemJson[$i]['name'] ?></p>
            <img class='itemList__img' src="<?= imgSrc($itemJson[$i]['id']) ?>">
            <p class='itemList__price'>価格：￥<?= $itemJson[$i]['price'] ?>（税込）</p>
            <form action="cart.php" method="post">
               <select name="count">
                  <?php
                  for ($x = 1; $x <= 9; $x++) {
                     echo "<option value='$x'>$x</option>";
                  }
                  ?>
               </select>個
               <input type="hidden" name="id" value="<?= $itemJson[$i]['id'] ?>">
               <button name="submit" value='submit'>カートに入れる</button>
            </form>
         </li>
      <?php } ?>
   </ul>
</main>

<?php include('./components/Footer.php');
