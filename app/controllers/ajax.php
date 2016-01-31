<?php

Class Ajax extends Drk{

	public function __construct(){

		//parent::__construct();
		$this->model('cartas');
		$this->model('usuarios');
	}

	public function buscar_cartas(){

		$nome = $this->post('term');

		$criterios = array('nome' => new MongoRegex("/$nome/i"));
			
		$dados = iterator_to_array($this->cartas->listar_limite($criterios));

		foreach ($dados as $c) {
			$cartas[] = $c['nome'];
		}
		

		$ret = json_encode($cartas);

		echo $ret;

	}

	public function verificar_login(){
		$login = $this->post('login');
		$criterios = array('login' => "$login");

		$dados = iterator_to_array($this->usuarios->verificar_login($criterios));
		if(count($dados)>0)
			echo 'true';
		else
			echo 'false';
		
	}

	public function verificar_email(){
		$email = $this->post('email');
		$criterios = array('email' => "$email");

		$dados = iterator_to_array($this->usuarios->verificar_email($criterios));
		if(count($dados)>0)
			echo 'true';
		else
			echo 'false';
		
	}

}