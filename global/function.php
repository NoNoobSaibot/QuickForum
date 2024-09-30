<?php


function Buildpage($content,$template, $args) {
	
	preg_match('@{{title: "(?<title>.+?)"}}@', $content, $args);
	
	$content = preg_replace('@{{title: "(?<title>.+?)"}}@', '', $content);

	$title = $args['title'];

	$template = str_replace('{{title}}', $title, $template);
	
	if(preg_match('@{{login: "(?<login>.+?)"}}@',$content,$args)){
		$content = preg_replace('@{{login: "(.+?)"}}@','', $content);
		if(isset($_SESSION['login']))
		{$args['login'] = $_SESSION['login'];}
	
		$template = str_replace('{{login}}',$args['login'],$template);
	}
	
	if(preg_match('@{{logout: "(?<logout>.+?)"}}@',$content,$args)){
		$content = preg_replace('@{{logout: "(.+?)"}}@','', $content);
		if(isset($_SESSION['logout']))
		{$args['logout'] = $_SESSION['logout'];}
	
		$template = str_replace('{{logout}}',$args['logout'],$template);
	}
	if(preg_match('@{{script: "(?<script>.+?)"}}@',$content,$args)){
		$php = 'model/'. $args['script'] . '.php';
		$buffer = include $php;
		$content = preg_replace('@{{script: "(.+?)"}}@',$buffer, $content);
	}
		
	
	$template = str_replace('{{content}}', $content, $template);
	
	return $template;
}

function BuildSqlContent($table,...$arg){
require 'db/connect.php';

	if($table == 'ads'){
		$request = "SELECT * from topics WHERE user_id = " . $arg[0] . " and id = " . $arg[1] . ";";
		$result = $pmysqli->query($request);
		$top = $result->fetch_assoc();
		$comments = GetComments($top['id'],$top['user_id']);
		
		$request = "SELECT * from accounts WHERE id = {$top['user_id']}";
		$result = $pmysqli->query($request);
		$account = $result->fetch_assoc();	
		
		$head = "<h3>Тема пользователя: {$account['login']} </h3>";
		$content = '{{title: "Объявления"}}'.' {{logout: "<a href="/auth">войти</a>"}}'.' {{login: "Гость"}} ' . $head . $top['description'] . $comments . "<br><a href='/'>Вернуться на главную страницу</a>";
		return $content;
	}

}

function GetComments($top_id,$user_top_id){
require 'db/connect.php';

	$request = "SELECT * from comments WHERE top_id = $top_id";
	$result = $pmysqli->query($request);
	$answer = '<br><div><form action="/write_comment" method="post"><label for="comment">Вы можете оставить комментарий</label><br><textarea id="comment" name="comment" type="text" rows=10 cols=40></textarea><input type="hidden" name="top_id" value=' . $top_id . ' /><input type="hidden" name="user_top_id" value=' . $user_top_id . ' /><br><input type="submit" value="Отправить"/></form>';
	
	for($comments = []; $row = $result->fetch_assoc(); $comments[] = $row);
	$content = "<div><h3>Комментарии:</h3><div>";
	foreach($comments as $comment){
		$request = "SELECT * from accounts WHERE id = {$comment['user_id']}";
		$result = $pmysqli->query($request);
		$account = $result->fetch_assoc();	
		$content .= "<h5>Пользователь: {$account['login']}</h5><small>{$comment['create_date']}</small><div><p>{$comment['comment']}</p></div></div></div><hr>";
	}
	
	if(empty($content)){
		$content = "<div><h3>Комментарии:</h3> комментариев нет </div>";
	}
	$content .= $answer;
	
	return $content;
}