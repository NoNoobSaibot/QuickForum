<?php
if(isset($_SESSION['login'])){
	$login = $_SESSION['login'];
	$topic = $_POST['topic'];
	$description = $_POST['description'];
	$userID = $_SESSION['id'];
	
	$pmysqli->query("INSERT INTO topics (user_id,topic,description) VALUE ($userID,'$topic','$description')");
    $content = file_get_contents('view/main/succses_save_topics.php');
	return $content;
}else {
	die('Произошла ошибка создания темы!');
}

