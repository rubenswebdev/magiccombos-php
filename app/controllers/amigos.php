<?php 
class Amigos extends Drk{


	public function __construct(){
		parent::__construct(true,true);
		$this->model("mensagens");
		$this->model("amigos");
		$this->model("cartas");
	}

	public function index(){
		$login     = $this->auth->get_data('login');
		$num_msgs  = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		$dados = array('amigos'=>$this->amigos->listar($login),'title'=>'Meus Amigos');


		$this->view("head");
		$this->view("nav",@$dados_lat );

		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat);

		$this->view("front/amigos/amigos",@$dados);

		$this->view("footer");	

	}

	public function decks(){
		$login     = $this->auth->get_data('login');
		$id_usuario = $this->auth->get_data('id');

		$id_amigo = $this->segments(2);

		$criterio = array('login'=>$login,'id'=>(int)$id_usuario,'amigos.id_usuario'=>(int)$id_amigo);
		$limitador = array('_id'=>0,'colecoes'=>1);

		$eh_amigo = $this->amigos->find($criterio,$limitador);

		

		if(count($eh_amigo) > 0){
					$criterio = array('id'=>(int)$id_amigo,'colecoes.publico'=>(int)1,'amigos.id_usuario'=>(int)$id_usuario);
					$limitador = array('_id'=>0,'colecoes'=>1);
					$colecoes = $this->amigos->find($criterio,$limitador);
		}
		if(isset($colecoes[0]))
		foreach ($colecoes[0]['colecoes'] as $key => $value) {
			unset($cartas);
			if(!isset($value['publico']) && @$value['publico'] != 1){
					unset($colecoes[0]['colecoes'][$key]);
					continue;
			}
			foreach ($value['cartas'] as $carta) {

				$cod = explode('_', $carta['cod']);

				$criterio = array('cod'=>$cod[0]);
				$carta_only = $this->cartas->get_carta($criterio);
				$carta_only['cod'] = $carta['cod'];
				$cartas[] = $carta_only;

			}
			$c[$value['id']]['nome'] = ($value['nome']);
			$c[$value['id']]['id_usuario'] = $id_amigo;
			$c[$value['id']]['tipo'] = ucwords($value['tipo']);
			$c[$value['id']]['cartas'] = @$cartas;
			$c[$value['id']]['capa'] = !empty($cartas[0]['imagem_local']) ? get_img_carta($cartas[0]) : get_url('public/imgs/capa.jpg');
		}


		$num_msgs  = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		$dados = array('colecoes'=>@$c);


	

		$this->view("head");
		$this->view("nav",@$dados_lat );

		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat);

		if($this->segments(3) == 'ver'){
			$id = $this->segments(4);
			$colecao = $c[$id];

			$cartas  = array('cartas'=>$colecao['cartas']);
			$this->view("front/amigos/cartas",@$cartas);
			
		}else{
			$this->view("front/amigos/decks_publico",@$dados);
		}

		

		$this->view("footer");	

	}




	public function desfazer(){
		$login = $this->auth->get_data('login');
		$id_usuario = $this->auth->get_data('id');
		$id_usuario_amigo = $this->segments(2);

		$this->amigos->desfazer_amizade($login,$id_usuario_amigo,$id_usuario);
		redirect(get_url('amigos'));
	}



	public function add(){
		$id = $this->segments(2);
		$id_usuario = $this->auth->get_data('id');
		
		
		$login = $this->auth->get_data('login');
		$pessoa = $this->amigos->buscar_one($id);
		$usuario = $this->amigos->buscar_one($id_usuario);
		
		$this->amigos->add_amigo($pessoa,$usuario);
		
		redirect(get_url('amigos'));
		
	}

	public function buscar_amigos(){
		if($this->is_ajax()){
			$nome_email = $this->post('nome_email');
			$id_usuario = $this->auth->get_data('id');
			$login = $this->auth->get_data('login');

			$retorno = $this->amigos->buscar($nome_email,$id_usuario,$login);
			$ret = '';
			foreach ($retorno as $key => $pessoa) {

				$img = (isset($pessoa['imagem']) ? $pessoa['imagem'] : 'default.jpg' );

				$ret .= "<div class=\"col-xs-2 col-md-2\">
											<div href=\"#\" class=\"thumbnail\">
											  <img width=\"140px\" src=\"".get_url('public/perfis/'.$img)."\" alt=\"...\">
											
											 <div class=\"caption\">
												<p>".$pessoa['nome']."</p>
												<div class=\"btn-group\">
												  <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\">
												    Ações <span class=\"caret\"></span>
												  </button>
												  <ul class=\"dropdown-menu\" role=\"menu\">
												    <li><a href=\"".get_url('amigos/add/').$pessoa['id']."\">Adicionar</a></li>
												    <li><a href=\"".get_url('amigos/perfil/').$pessoa['id']."\">Ver Perfil</a></li>
												  </ul>
												</div>
											 </div>
										</div>
						</div>";
			}
			print_r($ret);
		
		}
	}



}