<?php
include('components/Header.php');
publicRoute($isLogin);
$msg = '';

if (@$_POST['submit']) {
   $email = $_POST['email'];
   $userJson = file_get_contents('user.json');
   $userJson = json_decode($userJson, TRUE);
   $agreeIndex = array_search($email, array_column($userJson, 'email'));

   if ($agreeIndex === false) {
      $msg = 'アカウントが存在しません。';
   } else {
      $agreeJson = $userJson[$agreeIndex];

      if (password_verify($_POST['password'], $agreeJson['password'])) {
         $_SESSION['email'] = $agreeJson['email'];
         header('Location: index.php');
         exit();
      } else {
         $msg = 'パスワードが間違っています。';
      }
   }
}

?>

<h2 class="formTitle">ログイン</h2>
<main class="container">
   <form method="post">
      <div>
         <h3 class='formTitle--sub'>会員登録されている方</h3>
      </div>
      <div class='form__item login'>
         <label for="">メールアドレス</label>
         <input type="email" name="email">
      </div>
      <div class='form__item login'>
         <label for="">パスワード</label>
         <input type="password" name="password">
      </div>
      <?php if ($msg) echo "<div class='err'>$msg</div>" ?>
      <button name='submit' value='submit' class='form__button'>ログイン</button>
   </form>
   <div>
      <h3 class="formTitle--sub">会員登録されていない方</h3>
      <button class="form__button">新規会員登録</button>
   </div>
</main>
