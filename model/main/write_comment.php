<?php

require 'db/connect.php';
date_default_timezone_set('Europe/Moscow');

if(isset($_SESSION['id'])){
	$user_id = $_SESSION['id'];
	$comment = $_POST['comment'];
	$top_id = $_POST['top_id'];
	$user_top_id = $_POST['user_top_id'];
	$create_date = date('Y-m-d H:i:s');
	$out = "<br><a href=ads/$user_top_id/$top_id>вернуться</a>";
	
	$request = "INSERT INTO comments (user_id,comment,create_date,top_id) VALUE ($user_id,'$comment','$create_date',$top_id);";
	$result = $pmysqli->query($request);
	
	$content = '{{title: "Объявления"}}{{logout: "<a href="/auth">войти</a>"}}{{login: "Гость"}}Комментарий отправлен!' . $out;
	
	return $content;
}else{
	$content = '{{title: "Объявления"}}{{logout: "<a href="/auth">войти</a>"}}{{login: "Гость"}}Вам необходимо авторизоваться!!!';
	
	return $content;
}
