<?php

ini_set('display_errors', 'off');
error_reporting(E_ALL);

//pasta padrão para o site
$config['app'] = '../../app_admin/';

//pasta onde se encontra a base do framework
$config['system'] = '../../system/';
$config['router_default'] = 'home';

//url do site
$config['url'] = 'http://magiccombos.com.br/admin/';

define('SYSTEM',$config['system']);
define('URL_LOGIN','login');
require_once(SYSTEM.'drk.php');//core






