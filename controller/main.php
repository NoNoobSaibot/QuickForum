<?php
session_start();
require_once 'global/function.php';

$template = file_get_contents('tmp/main.tmp');
$content = file_get_contents('view/main/top.php');

if(isset($_SESSION['login'])){
	$content = str_replace('Гость',$_SESSION['login'],$content);
	$content = str_replace('войти',$_SESSION['logout'],$content);
}

$page = Buildpage($content,$template,$ARGS);

echo $page;