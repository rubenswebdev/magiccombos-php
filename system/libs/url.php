<?php

function get_url($u = null){
	return URL.$u;
}

function redirect($url){
	header('Location:'.$url);
	exit();
}


