<?php
	$email = $_POST['email'];
	$login = $_POST['login'];
	$password = $_POST['password'];
	$re_password = $_POST['re_password'];
	
	
	if($re_password === $password){
		$pmysqli->query("INSERT INTO accounts (email,login,password) VALUE ('$email','$login','$password')");
		return '{{title: "Успешная регистрация!"}} <strong>Новый пользователь зарегистрирован!</strong>';
	}else {
		return '{{title: "Неудачная попытка регистрации!"}} <strong>Пароли должны сопадать!</strong>';
	}