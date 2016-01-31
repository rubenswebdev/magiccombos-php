<?php

Class Cadastre_se extends Drk{

	public $erro;
	public $erros;

	public function __construct(){
		parent::__construct(false,false);
		$this->model('usuarios');
		$this->model('login','login_model');
	}

	public function get_post(){
		
			$this->nome  = $this->post('nome');
			$this->email  = $this->post('email');
			$this->login  = $this->post('login');
			$this->documento  = $this->post('documento');
			$this->sexo  = $this->post('sexo');
			$this->senha  = $this->post('senha');
			$this->senhac  = $this->post('senhac');
			$this->dtnascimento  = $this->post('dtnascimento');
			$this->receber_novidades  = $this->post('receber_novidades');
		
	}

	public function valida(){
		
		if($this->nome == null){
			$this->erro['nome'] = true;
		}
		if($this->email == null){
			$this->erro['email'] = true;
		}
		if($this->existe_email()){
			$this->erro['email_existe'] = true;
		}
		if($this->existe_login()){
			$this->erro['login_existe'] = true;
		}
		if($this->login == null){
			$this->erro['login'] = true;
		}
		if($this->documento != null && !$this->validaCPF($this->documento)){
			$this->erro['documento'] = true;
		}
		if($this->sexo == null){
			$this->erro['sexo'] = true;
		}
		if($this->senha == null){
			$this->erro['senha'] = true;
		}
		if($this->senha != $this->senhac){
			$this->erro['senhac'] = true;
		}
		if($this->dtnascimento != null && !$this->ValidaData($this->dtnascimento)){
			$this->erro['dtnascimento'] = true;
		}

		if(isset($this->erro)){
			$this->erros = true;
			return false;
		}

		return true;


	}

	public function index(){
		


		if($this->is_post()){
			$this->get_post();
			if($this->valida()){
				
				if(!isset($this->erro)){

					$usuario = array(
										'nome'=>$this->nome,
										'email'=>$this->email,
										'login'=>$this->login,
										'documento'=>$this->documento,
										'sexo'=>$this->sexo,
										'senha'=>$this->senha,
										'dtnascimento'=>$this->dtnascimento ,
										'receber_novidades'=>$this->receber_novidades
						        	 );
								     
					if($this->usuarios->cadastrar($usuario)){
							if($this->is_post()){
									$login = $this->post("login");
									$senha = $this->post("senha");

									$criterio = array("login"=>$login,"ativo"=>1);


									$s = $this->login_model->logar($criterio,$senha);

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
					};
				}
			}
		}


		


		
		if(@$this->erros){
			$erro = array('erros'=>@$this->erro);
		}

		$this->view("head");
		$this->view("nav");
		$this->view("opencontainer");
		$this->view("front/cadastre_se/cadastre_se",@$erro);
		$this->view("footer");
	}





	function validaCPF($cpf)
	{	// Verifiva se o número digitado contém todos os digitos
		$cpf = str_replace('.', '', $cpf);
		$cpf = str_replace('-', '', $cpf);
		
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if(strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
		{
			return false;
		}
		else
		{ // Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
		 
			$d = ((10 * $d) % 11) % 10;
			 
			if ($cpf{$c} != $d) {
				return false;
			}
		}
		 
		return true;
		}
	}


	function ValidaData($dat){
		$data = explode("/","$dat"); // fatia a string $dat em pedados, usando / como referência
		$d = @$data[0];
		$m = @$data[1];
		$y = @$data[2];

		if($d == '' || $m == '' || $y == '')
			return false;
		 
		// verifica se a data é válida!

		if (checkdate($m,$d,$y)){
			return true;
		} else {
			return false;
		}
	}

	public function existe_login(){
		$login = $this->login;
		$criterios = array('login' => "$login");

		$dados = iterator_to_array($this->usuarios->verificar_login($criterios));
		if(count($dados)>0)
			return true;
		else
			return false;
		
	}

	public function existe_email(){
		$email = $this->email;
		$criterios = array('email' => "$email");

		$dados = iterator_to_array($this->usuarios->verificar_email($criterios));
		if(count($dados)>0)
			return true;
		else
			return false;
		
	}

}