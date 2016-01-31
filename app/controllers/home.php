<?php

class Home extends Drk{

	public function __construct(){
		parent::__construct();
		$this->model("login");
		$this->model("mensagens");
	}

	public function index(){

		if($this->is_post()){
				$login = $this->post("login");
				$senha = $this->post("senha");

				$criterio = array("login"=>$login,"ativo"=>1);


				$s = $this->login->logar($criterio,$senha);

				if(!$s){
					$erro = "Senha ou login incorretos!";
				}else{
					$this->auth->create($s);

					if($this->segments(2) == 'want' || $this->segments(2) == 'have'){
						redirect(get_url("cartas/".$this->segments(2)."/".$this->segments(3)));
					}else{
						redirect(get_url("colecoes"));
					}
					
				}
		}

		if($this->auth->loged()){
			$login =  $this->auth->get_data("login");
			$num_msgs = $this->mensagens->count_mensagens($login);
		}

		$dados = array("title" =>"Home",
						"erro" => @$erro,
						'num_msgs'=>@$num_msgs);


	
		$this->view("head");
		$this->view("nav",@$dados);	
		$this->view("opencontainer",@$dados);
		$this->view("front/home/busca");
		$this->view("front/home/marketing");
		$this->view("front/home/body");
		$this->view("footer");	
	}

	public function sair(){
		$this->auth->destroy();
		redirect(get_url());
	}


}