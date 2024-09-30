<?php 
require 'db/connect.php';

$result = $pmysqli->query('SELECT * FROM topics');
$list = '';
for($topics = []; $row = $result->fetch_assoc();$topics[] = $row);

foreach($topics as $top) {
	$result = $pmysqli->query('SELECT login FROM accounts where id=' . $top['user_id'] .''); 
	$authors = $result->fetch_assoc(); 
	$name = $authors['login'];
	$topic = $top['topic'];
	$id = $top['user_id'];
	$top_id = $top['id'];
	$list .= "<li><div><b>Автор</b>: $name</div><div></b>Тема</b>: <a href='ads/$id/$top_id'>$topic</a></div></li><hr>";
}

return $list;
			
			

