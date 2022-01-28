<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
   header('Location: /admin/login.php');
   exit();
}

$orderJson = file_get_contents('../order.json');
$orderJson = json_decode($orderJson, TRUE);

$userJson = file_get_contents('../user.json');
$userJson = json_decode($userJson, TRUE);

$itemJson = file_get_contents('../item.json');
$itemJson = json_decode($itemJson, TRUE);

foreach ($orderJson as $order) {
   $agreeIndex = array_search($order['email'], array_column($userJson, 'email'));
   foreach ($order['order'] as $id => $count) {
      $cartItem = $itemJson[array_search($id, array_column($itemJson, 'id'))];
      $cartItem['count'] = $count;
      $cartItems[] = $cartItem;
   }
   $json[] = array(
      "user" => $userJson[$agreeIndex],
      "order" => $cartItems,
      "todo" => $order['todo'],
   );
   $cartItems = array();
}

?>

<a href="/admin">もどる</a>

<table>
   <?php foreach ($json as $index => $j) { ?>
      <tr>
         <td><?= $j['user']['email'] ?></td>
         <td><?= $j['user']['lastName'] . $j['user']['firstName'] ?></td>
         <td><?= $j['user']['zip'] ?></td>
         <td><?= $j['user']['pref'] ?></td>
         <td><?= $j['user']['address'] ?></td>
         <td><?= $j['user']['building'] ?></td>
         <td><?= $j['user']['tel'] ?></td>
         <td>
            <form action="todo.php" method="POST">
               <input type="hidden" name="index" value="<?= $index ?>">
               <input type="checkbox" name="todo" onchange="submit(this.form)" <?php if ($j['todo']) echo 'checked' ?>>
               配送
            </form>
         </td>
      </tr>
      <tr>
         <?php foreach ($j['order'] as $i) { ?>
            <td><?= $i['name'] ?></td>
            <td><?= $i['count'] ?>個</td>
         <?php } ?>
      </tr>
      <tr>
         <td>&nbsp;</td>
      </tr>
   <?php } ?>
</table>
