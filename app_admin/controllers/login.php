<?php

class Login extends Drk{

	public function __construct(){
		parent::__construct();
		$this->model('login');
	}

	public function index(){
		$dados = array('title' =>'Login');

		if($this->is_post()){
				$login = $this->post('login');
				$senha = $this->post('senha');

				$criterio = array('login'=>$login,'admin'=>1,'ativo'=>1);


				$s = $this->login->logar($criterio,$senha);

				if(!$s){
					$erro = 'Senha ou login incorretos!';
					$dados = array('erro'=>$erro);
				}else{

					$this->auth->create($s);
					redirect(get_url('home'));
				}
		}


		$this->view('admin/login/login',@$dados);

	}

	public function sair(){
		$this->auth->destroy();

		redirect(get_url());
	}


	public function gerarSenha(){
		echo crypt($this->segments(2));
	}

	public function gerar_md5(){
		$token = md5(uniqid(""));
		echo $token;
	}

}