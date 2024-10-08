<?php

require 'db/connect.php';
require 'global/global.php';
require 'global/function.php';

$uri = $_SERVER['REQUEST_URI'];

if(preg_match('@^(/)$@',$uri,$ARGS)){
	include 'controller/main.php';
}else if(preg_match('@^/([a-z0-9_-]+)$@',$uri,$ARGS)){
	include 'controller/chapter.php';
}else if(preg_match('@^/([a-z0-9_-]+)/([a-z0-9_-]+)$@',$uri,$ARGS)){
	include 'controller/subchapter.php';
}else if(preg_match('@^/([a-z0-9_-]+)/([a-z0-9_-]+)/([a-z0-9_-]+)$@',$uri,$ARGS)){
	include 'controller/subchapter.php';	
}else{
	echo "Некорректный url";
}
