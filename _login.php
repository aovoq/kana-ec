<?php

session_start();
$email = $_POST['email'];
$userJson = file_get_contents('user.json');
$userJson = json_decode($userJson, TRUE);
$agreeIndex = array_search($email, array_column($userJson, 'mail'));
$agreeJson = $userJson[$agreeIndex];

if (password_verify($_POST['password'], $agreeJson['password'])) {
   $_SESSION['mail'] = $agreeJson['mail'];
   header('Location: index.php');
} else {
   header('Location: login.php');
}
