<?php
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$zip = $_POST['zipFirst'] . $_POST['zipSecond'];
$pref = $_POST['pref'];
$address = $_POST['address'];
$building = $_POST['building'];
$tel = $_POST['tel'];

// TODO: validation めんどいからやらん
$userJson = file_get_contents('user.json');
$userJson = json_decode($userJson);

$userJson[] = array(
   "email" => $email,
   "password" => $password,
   "lastName" => $lastName,
   "firstName" => $firstName,
   "zip" => $zip,
   "pref" => $pref,
   "address" => $address,
   "building" => $building,
   "tel" => $tel,
);

$userJson = json_encode($userJson);
file_put_contents('user.json', $userJson);
var_dump($userJson);
header('Location: login.php');
