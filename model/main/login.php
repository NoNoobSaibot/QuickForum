<?php
session_start();
require 'db/connect.php';

$login = $_POST['login'];
$password = $_POST['password'];


$result = $pmysqli->query("SELECT * FROM accounts WHERE login = '$login' and password = '$password'");
$user = $result->fetch_assoc();
if($user){
	$_SESSION['login'] = $login;
	$_SESSION['logout'] = '<a href="/out">выйти</a>';
	$_SESSION['id'] = $user['id'];
	header('Location: /');
}else {
	die('Произошла ошибка входа! Неверный логин или пароль.');
}