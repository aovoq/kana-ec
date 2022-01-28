<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
   header('Location: /admin/login.php');
   exit();
}

$itemJson = file_get_contents('../item.json');
$itemJson = json_decode($itemJson, TRUE);

function imgSrc($code) {
   $fileName =  (file_exists("../img/$code.jpg")) ? $code : 'noimage';
   return "/img/$fileName.jpg";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin</title>
   <link rel="stylesheet" href="/admin/style.css">
</head>

<body>
   <h1>管理画面</h1>
   <p><a href="/">ショップページへ</a></p>
   <p><a href="/admin/order.php">オーダーを確認</a></p>

   <!-- <h2>Add</h2>
   <form action="/admin/add.php" method="post">
      <div>
         <label>カテゴリー</label>
         <select name="category">
            <option value="baked">焼き菓子</option>
            <option value="cakes">ケーキ</option>
            <option value="chocolate">チョコレート</option>
         </select>
      </div>
      <div>
         <label>商品名</label>
         <input type="text" name="name">
      </div>
      <div>
         <label>値段</label>
         <input type="number" name="price">
      </div>
      <div>
         <button name="submit" value="add">追加する</button>
      </div>
   </form> -->

   <!-- TODO: カテゴリーでのフィルター機能 -->

   <table>
      <thead>
         <tr>
            <td></td>
            <td>商品名</td>
            <td>カテゴリー</td>
            <td>価格</td>
            <td>追加/編集/削除</td>
            <td>画像アップロード</td>
         </tr>
         <tr>
            <td>
               <h2>Add</h2>
            </td>
            <form action="/admin/add.php" method="post">
               <td><input type="text" name="name"></td>
               <td>
                  <select name="category">
                     <option value="baked">焼き菓子</option>
                     <option value="cakes">ケーキ</option>
                     <option value="chocolate">チョコレート</option>
                  </select>
               </td>
               <td><input type="number" name="price"></td>
               <td>
                  <button name="submit" value="add">追加する</button>
               </td>
            </form>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($itemJson as $item) { ?>
            <tr>
               <form action="/admin/update.php" method="post">
                  <td>
                     <img class="itemImage" src="<?= imgSrc($item['id']); ?>">
                  </td>
                  <td>
                     <input type="text" name='name' value="<?= $item['name']; ?>">
                  </td>
                  <td>
                     <select name="category">
                        <option value="baked" <?php if ($item['category'] == 'baked') echo 'selected'; ?>>焼き菓子</option>
                        <option value="cakes" <?php if ($item['category'] == 'cakes') echo 'selected'; ?>>ケーキ</option>
                        <option value="chocolate" <?php if ($item['category'] == 'chocolate') echo 'selected'; ?>>チョコレート</option>
                     </select>
                  </td>
                  <td>
                     <div class='priceInput'>
                        <label class='yen'>￥</label>
                        <input name='price' type="number" value="<?= $item['price'] ?>">
                     </div>
                  </td>
                  <td>
                     <input type="hidden" name='id' value="<?= $item['id'] ?>">
                     <div>
                        <button name='submit' value='submit'>編集完了</button>
                     </div>
               </form>
               <button onclick="return confirm('削除してよろしいですか？')">
                  <a href="/admin/remove.php?id=<?= $item['id']; ?>">削除</a>
               </button>
               </td>

               <td>
                  <div>
                     <form action="/admin/upload.php" method='post' enctype="multipart/form-data">
                        <div>
                           <input type="file" name="image">
                           <input type="hidden" name="id" value="<?= $item['id']; ?>">
                        </div>
                        <div><button name='submit' value='submit'>画像アップロード</button></div>
                     </form>
                  </div>
               </td>
            </tr>
         <?php } ?>
      </tbody>
   </table>
</body>

</html>
