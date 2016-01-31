<?php

Class Cartas extends Drk{

	public function __construct(){
		parent::__construct();
		$this->model('cartas');
		$this->model('mensagens');
		$this->model('denuncias');

	}

	public function buscar(){

		if($this->is_post()){
			$nome = $this->post('busca');
			$criterio = array('nome'=> new MongoRegex("/$nome/i"));

			$login =  $this->auth->get_data("login");

			$dados = iterator_to_array($this->cartas->listar($criterio));

			
			foreach ($dados as $id => $d) {
				$count_want_have =  $this->cartas->count_hws($login,$d['cod']);
				$dados[$id]['hws'] = $count_want_have;
			}

			
			
			$num_msgs = $this->mensagens->count_mensagens($login);
			$dados_lat = array('num_msgs'=>$num_msgs);

			$d = array('cartas' => $dados);

			$this->view("head");
			$this->view("nav",@$dados_lat);
			$this->view("container-fluid");
			$this->view("lateral",@$dados_lat);
			$this->view("front/cartas/carta_busca",@$d);
			$this->view("footer");	
		}else{
			if($this->segments(2) != ''){
				$cod = $this->segments(2);
				$criterio = array('cod'=> new MongoRegex("/$cod/i"));
				$dados = iterator_to_array($this->cartas->listar($criterio));
				
				$login =  $this->auth->get_data("login");
				$num_msgs = $this->mensagens->count_mensagens($login);
				$dados_lat = array('num_msgs'=>$num_msgs);

				foreach ($dados as $id => $d) {
					$count_want_have =  $this->cartas->count_hws($login,$d['cod']);
					$dados[$id]['hws'] = $count_want_have;
				}
				$d = array('cartas' => $dados);



				$this->view("head");
				$this->view("nav",@$dados_lat);
				$this->view("container-fluid");
				$this->view("lateral",@$dados_lat);
				$this->view("front/cartas/carta_busca",@$d);
				$this->view("footer");	
			}else{
				redirect(get_url('home'));
			}
		}
	}

	public function want(){
		
		$cod = $this->segments(2);
		$dados = iterator_to_array($this->cartas->get_wants($cod));
	
		foreach ($dados as  $usuario) {
		
			foreach ($usuario['colecoes'] as $colecao) {
				
				if($colecao['tipo']=='want' && $usuario['id'] != $this->auth->get_data('id')){	
					$usuarios[$usuario['id']]['qtd'] = 0;
					$usuarios[$usuario['id']]['id'] = $usuario['id'];
					$usuarios[$usuario['id']]['denuncias'] = $this->denuncias->count_denuncias($usuario['id']);
					$usuarios[$usuario['id']]['nome'] = $usuario['nome'];
					$usuarios[$usuario['id']]['cod_colecao'] = $colecao['id'];
					$usuarios[$usuario['id']]['email'] = $usuario['email'];
					$usuarios[$usuario['id']]['login'] = $usuario['login'];
					$usuarios[$usuario['id']]['want'] = 'Quer Comprar ou Trocar';
					foreach ($colecao['cartas'] as $carta) {

						$cod_c = explode('_', $carta['cod']);
						

						if($cod_c[0] == $cod){
							$usuarios[$usuario['id']]['qtd'] += 1;
						}
					}
				}
			}
		}

		$dados = array('usuarios' => @$usuarios);

		$login =  $this->auth->get_data("login");
		$num_msgs = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		$this->view("head");
		$this->view("nav",@$dados_lat);
		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat);
		$this->view("front/cartas/lista_want_have",@$dados);
		$this->view("footer");	
	
		
	}

	public function have(){
		
		
		$cod = $this->segments(2);
		$dados = iterator_to_array($this->cartas->get_haves($cod));
	
		foreach ($dados as  $usuario) {
		
			foreach ($usuario['colecoes'] as $colecao) {
				
				if($colecao['tipo']=='have'  && $usuario['id'] != $this->auth->get_data('id')){	
					$usuarios[$usuario['id']]['qtd'] = 0;
					$usuarios[$usuario['id']]['denuncias'] = $this->denuncias->count_denuncias($usuario['id']);
					$usuarios[$usuario['id']]['id'] = $usuario['id'];
					$usuarios[$usuario['id']]['nome'] = $usuario['nome'];
					$usuarios[$usuario['id']]['email'] = $usuario['email'];
					$usuarios[$usuario['id']]['login'] = $usuario['login'];
					$usuarios[$usuario['id']]['have'] = 'Quer Vender ou Trocar';
					foreach ($colecao['cartas'] as $carta) {

						$cod_c = explode('_', $carta['cod']);
						

						if($cod_c[0] == $cod){
							$usuarios[$usuario['id']]['qtd'] += 1;
							

						}
					}
					if($usuarios[$usuario['id']]['qtd'] == 0){
						unset($usuarios[$usuario['id']]);
					}
				}
			}
		}

		$dados = array('usuarios' => @$usuarios);

		$login =  $this->auth->get_data("login");
		$num_msgs = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		$this->view("head");
		$this->view("nav",@$dados_lat);
		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat);
		$this->view("front/cartas/lista_want_have",@$dados);
		$this->view("footer");	
		
	
	}

}