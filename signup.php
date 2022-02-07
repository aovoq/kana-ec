<?php
include('./components/Header.php');
publicRoute($isLogin);

$token = bin2hex(random_bytes(32));
$_SESSION['token'] = $token;

?>

<h2 class="formTitle">新規会員登録</h2>
<main class="container">
   <form action="_signup.php" method="post">
      <input type="hidden" name="token" value="<?= $token ?>">
      <div class=>
         <h3 class='formTitle--sub'>お客さま情報入力</h3>
      </div>
      <div class='form__item'>
         <p>氏名</p>
         <div class='form__name'>
            <div class='form__name--inner'>
               <label class='name' for="">姓</label>
               <input class='lastName' name='lastName' type="text">
            </div>
            <div class='form__name--inner'>
               <label class='name' for="">名</label>
               <input class='firstName' name='firstName' type="text">
            </div>
         </div>
      </div>
      <div class='form__item'>
         <label for="">メールアドレス</label>
         <input type="email" name="email">
      </div>
      <div class='form__item'>
         <label for="">パスワード</label>
         <input type="password" name="password">
      </div>
      <div class='form__item'>
         <div>
            <label for="">郵便番号</label>
            <input class='zipFirst' name='zipFirst' type="text">
            -
            <input class='zipSecond' name='zipSecond' type="text">
         </div>
         <div>
            <label for="">都道府県</label>
            <input class='pref' name="pref" type="text">
         </div>
         <div>
            <label for="">番地</label>
            <input type="text" name="address">
         </div>
         <div>
            <label for="">建物名</label>
            <input type="text" name="building">
         </div>
      </div>
      <div class='form__item'>
         <label>電話番号</label>
         <input type="tel" name="tel">
      </div>
      <button class='form__button'>会員登録をする</button>
   </form>
</main>

<?php include('./components/Footer.php');
