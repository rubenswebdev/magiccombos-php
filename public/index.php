<?php
date_default_timezone_set('America/Sao_Paulo');
ini_set('display_errors', 'off');
error_reporting(E_ALL);

//pasta padrão para o site
$config['app'] = '../app/';

//pasta onde se encontra a base do framework
$config['system'] = '../system/';
$config['router_default'] = 'home';

//url do site
$config['url'] = 'http://magicold.dev/';

define('SYSTEM',$config['system']);

define('URL_LOGIN','home');

define('URL_IMAGENS','local');
require_once(SYSTEM.'drk.php');//core






