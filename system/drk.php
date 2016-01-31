<?php
session_start();

define('APP',$config['app']);
define('URL', $config['url']);
define('RTD', $config['router_default']);
define('M', APP.'models/');
define('V', APP.'views/');
define('C', APP.'controllers/');
define('CONFIG',APP.'config/');
define('EXT', '.php');
define('LIBS_SYSTEM',SYSTEM.'libs/');
define('LIBS',APP.'libs/');


//load class
include_once(LIBS_SYSTEM.'auth'.EXT);


$drk = new Drk;
$drk->router();

class Drk{

	public function __construct($loged = false,$r = false)
    {
        $this->auth = new Auth;
        if($loged)
        $this->auth->loged($r);
    }

    public function segments($n){
    	
    	$url = str_replace('http://', '', URL);

		$url = str_replace($_SERVER['HTTP_HOST'], '', $url);

		if($url != '/')
			$url = str_replace($url, '', $_SERVER['REQUEST_URI']);
		else{
			$url = $_SERVER['REQUEST_URI'];
		}

		$segments = explode('/', $url);
		if(empty($segments[0])){
			array_shift($segments);
		}
    	if(!empty($segments[$n]))
			return $segments[$n];
    }

    /**
     * Retorna nome do idioma em português baseado na sigla
     * @param  String $s
     * @return String
     */
    public function get_idioma($s){
    	switch ($s) {
    		case 'pt':
    			return 'Português';
    			break;
    		case 'en':
    			return 'Inglês';
    			break;
    		case 'fr':
    			return 'Francês';
    			break;
    		case 'de':
    			return 'Alemão';
    			break;
    		case 'jp':
    			return 'Japonês';
    			break;
    		case 'it':
    			return 'Italiano';
    			break;
    		case 'es':
    			return 'Espanhol';
    			break;
    		case 'cn':
    			return 'Chinês';
    			break;
    		case 'ru':
    			return 'Russo';
    			break;
    		case 'tw':
    			return 'Tailandês';
    			break;
    		case 'ko':
    			return 'Coreano';
    			break;
    		
    		default:
    			return $s;
    			break;
    	}
    }


    public function get_comments_fb($ref){
    	echo '<div class="fb-comments" data-href="'.$ref.'" data-numposts="2" data-colorscheme="light"></div>';
    }

    public function get_like_fb($ref){
    	echo  '<div class="fb-like" data-layout="button_count" data-href="'.$ref.'" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>';
    }

	/***FUNCAO QUE INICIA A LEITURA DA URL E CARREGA A CLASSE E O METODO SOLICIDADO.***/
	public function router(){

		$this->load_lib_system();
		$this->load_lib();
        $this->load_drive();
        $this->load_model();
       
		

		if(!empty($this->segments(0))){
			$class = $this->segments(0);
		}elseif(!empty(RTD)){
			$class = RTD;
		}
		else{
			$this->view('404');
		}
 	
		if(!empty($this->segments(1)) )
			$method = $this->segments(1);
		else
			$method = 'index';


		if(!empty($class) && !empty($method)){
				if(file_exists(C.$class.EXT)){
					include(C.$class.EXT);
					$class = new $class;
				}

				if(method_exists($class, $method)){
					$class->$method();	
				}else{
					$this->view('404');
				}
		}

		
	}




	/* FUNCAO QUE CARREGA A VIEW */
	public function view($file,$vars = null){
		if(!empty($vars))
		foreach ($vars as $key => $value) {

			$$key = $value;

		}
		if(file_exists(V.$file.EXT))
			include(V.$file.EXT);
		else
			$this->view('404');
	}

	/* FUNCAO QUE CARREGA O MODEL */
	public function model($file,$apelido = null){
		if($apelido == null)
			$apelido = $file;
		if(file_exists(M.$file.'_model'.EXT)){
			include(M.$file.'_model'.EXT);
			$classe = $file.'_model';
			$this->$apelido = new $classe;
		}else{
			die('Modelo n&atilde;o encontrado: '.M.$file.'_model'.EXT);
		}
	}

	/*FUNCAO QUE LÊ OS POST*/
	public function post($name){
		if(isset($_POST[$name]))
		return $_POST[$name];
	}

	/* FUNCAO QUE VERIFICA SE É UM METHOD POST */
	public function is_post(){
		if($_SERVER['REQUEST_METHOD'] == 'POST')
			return true;
		else
			return false;
	}

	public function is_ajax(){
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
		    AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
		   return true;
		}
		return false;
	}


	public function load_lib(){
		$files = array();
		foreach (glob(LIBS."*.php") as $file) {
		  $files[] = $file;
		}

		//$files = scandir(LIBS, 1);
		foreach ($files as $key => $value) {
			if($value != '.' && $value != '..')
				include_once($value);
		}


		
	}

	public function load_lib_system(){
		$files = array();
		foreach (glob(LIBS_SYSTEM."*.php") as $file) {
		  $files[] = $file;
		}

		//$files = scandir(LIBS, 1);
		foreach ($files as $key => $value) {
			if($value != '.' && $value != '..')
				include_once($value);
		}


		
	}


	public function load_config(){
		include_once(URL.'config/config.php');
	}

	public function load_drive(){
		$files = array();
		foreach (glob(SYSTEM.'db/'."*.php") as $file) {
		  $files[] = $file;
		}

		//$files = scandir(LIBS, 1);
		foreach ($files as $key => $value) {
			if($value != '.' && $value != '..')
				include_once($value);
		}
		
	}

	public function load_model(){
		$files = array();
		foreach (glob(SYSTEM.'model/'."*.php") as $file) {
		  $files[] = $file;
		}
	
		//$files = scandir(LIBS, 1);
		foreach ($files as $key => $value) {
			if($value != '.' && $value != '..')
				include_once($value);
		}
		
	}

	function get_url($u = null){
		return URL.$u;
	}

	function get_js($script,$url,$tipo = 'js'){

		if($this->segments(0) == $url){
			if($tipo == 'js')
				return '<script src="'.$this->get_url('public/js/'.$url.'/'.$script.'.'.$tipo).'"></script>';
			if($tipo == 'php')
				include('public/js/'.$url.'/'.$script.'.'.$tipo);
		}	
	}

	function get_active($segment){
		if($this->segments(0) == $segment){
			echo 'active';
		}
	}

	function redirect($url){
		header("string");
	}

	function vaseferra(){
		echo 'fuck you';
	}

}


