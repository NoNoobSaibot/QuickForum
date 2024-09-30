<?php
session_start();
require_once 'global/function.php';

$tmps = ['auth-registration','main'];

foreach ($tmps as $tmp){
	$file = 'view/' . $tmp . '/' . $ARGS[1] . '.php';
	if(is_file($file)){
		$template = file_get_contents('tmp/' . $tmp . '.tmp');
		$content = file_get_contents($file);
	}
}

foreach ($tmps as $tmp){
	$file = 'model/' . $tmp . '/' . $ARGS[1] . '.php';
	if(is_file($file)){
		$template = file_get_contents('tmp/' . $tmp . '.tmp');
		$content = include $file;
	}
}

$page = Buildpage($content,$template,$ARGS);
echo $page;