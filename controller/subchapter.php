<?php
session_start();

$tmps = ['auth-registration','main'];

foreach ($tmps as $tmp){
	$file = 'view/' . $tmp .'/'. $ARGS[1].'_'.$ARGS[2] . '.php';
	if(is_file($file)){
		$content = file_get_contents($file);
		$template = file_get_contents('tmp/' . $tmp . '.tmp');
	}
}

foreach ($tmps as $tmp){
	$file = 'model/' . $tmp .'/'. $ARGS[1].'_'.$ARGS[2] . '.php';
	if(is_file($file)){
		$content = include $file;
		$template = file_get_contents('tmp/' . $tmp . '.tmp');
	}else if(is_numeric($ARGS[2])){
		$content = BuildSqlContent($ARGS[1],$ARGS[2],$ARGS[3]);
		$template = file_get_contents('tmp/main.tmp');
	}
}


$page = Buildpage($content,$template,$ARGS);
echo $page;