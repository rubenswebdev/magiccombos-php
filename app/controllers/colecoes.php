<?php

class Colecoes extends Drk{


	public function __construct(){
		parent::__construct(true,true);

		$this->model("colecoes");
		$this->model("cartas");
		$this->model("mensagens");
		
	}

	public function renomear(){
		if($this->is_ajax()){
			$nome = $this->post('nome');
			$tipo =$this->post('tipo');
			$publico = $this->post('publico');
			$id_colecao = $this->post('id_colecao');
			$id_usuario = $this->auth->get_data('id');


			$where = array('colecoes.id'=>(int)$id_colecao,'id'=>(int)$id_usuario);
			$set = array('$set'=>array('colecoes.$.nome'=>$nome,'colecoes.$.tipo'=>$tipo,'colecoes.$.publico'=>(int)$publico));

			if($this->colecoes->renomear($where,$set)){
				echo 1;
			}

		}
	}

	public function index(){


		$login    =  $this->auth->get_data("login");
		$criterio = array("login"=>$login);
		$cursor   = $this->colecoes->listar_colecoes($criterio);
		$cursor   = iterator_to_array($cursor);

		foreach ($cursor as $c) {
			if(isset($c['colecoes']))
			$dados = @$c['colecoes'];

			if(isset($dados))
			if(count($dados) > 0)
			foreach ($dados as $key => $value) {
				unset($cartas);

				foreach ($value['cartas'] as $carta) {
					$cod               = explode('_', $carta['cod']);
					$criterio          = array('cod'=>$cod[0]);
					$carta_only        = $this->cartas->get_carta($criterio);
					$carta_only['cod'] = $carta['cod'];
					$cartas[]          = $carta_only;
				}

				$colecoes[$value['id']]['nome']    = ($value['nome']);
				$colecoes[$value['id']]['publico'] = (@$value['publico']);
				$colecoes[$value['id']]['tipo']    = ucwords($value['tipo']);
				$colecoes[$value['id']]['cartas']  = @$cartas;
				$colecoes[$value['id']]['capa']    = !empty($cartas[0]['imagem_local']) ? get_img_carta($cartas[0]) : get_url('public/imgs/capa.jpg');
			}
		}

		$colecoes  = array("colecoes"=>@$colecoes,'title'=>'Minhas Coleções');		
		$num_msgs  = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		$this->view("head");
		$this->view("nav",@$dados_lat);
		$this->view("container-fluid");
		
		$this->view("lateral",@$dados_lat);
		$this->view("front/colecoes/colecoes",@$colecoes);
		$this->view("footer");	
	}

	public function ver(){

		$id       = (int) $this->segments(2);
		$login    =  $this->auth->get_data("login");
		$criterio = array('login'=>$login,'colecoes.id'=>$id);
		$cursor   = $this->colecoes->listar_colecoes($criterio);
		$cursor   = iterator_to_array($cursor);

		foreach ($cursor as $c) {
			$dados = $c['colecoes'];
			foreach ($dados as $key => $value) {
				if($value['id'] == $id){
					foreach ($value['cartas'] as $carta) {
						$cod               = explode('_', $carta['cod']);
						$criterio          = array('cod'=>$cod[0]);
						$carta_only        = $this->cartas->get_carta($criterio);
						$carta_only['cod'] = $carta['cod'];
						$cartas[]          = $carta_only;
					}
					$cartas = array('cartas'=>@$cartas);
				}

			}
			
			
		}

		$num_msgs  = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);
		

		$this->view("head");
		$this->view("nav",@$dados_lat );
		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat);
		$this->view("front/colecoes/cartas",@$cartas);
		$this->view("footer");	
	}

	public function excluir(){
		$login = $this->auth->get_data('login');
		$id_colecao = (int)$this->segments(2);

		$this->colecoes->excluir($login,$id_colecao);
		redirect(get_url('colecoes'));

	}

	public function add(){

		$login = $this->auth->get_data('login');
		$nome = $this->post('nome_colecao');

		$tipo = $this->post('tipo');
		
		if($nome != null){
				if($this->colecoes->add($login,$nome,$tipo))
					redirect(get_url('colecoes'));
				else echo 'erro';
		}else{
			redirect(get_url('colecoes'));
		}
		
	}

	public function carta(){
		$login = $this->auth->get_data('login');
		$id_usuario = $this->auth->get_data('id');
		$id_colecao = (int) $this->segments(3);
		$cod_carta = $this->segments(4);
		$acao = $this->segments(2);


		if($acao == 'excluir'){
			$ret = $this->colecoes->excluir_carta($login,$id_colecao,$cod_carta);
			redirect(get_url('colecoes/ver/'.$id_colecao));
		}

		if($acao == 'ver'){
			$cod = explode('_', $cod_carta);
			$criterio = array('cod'=>$cod[0]);
			$carta = $this->cartas->listar_uma($criterio);
			$count_want_have =  $this->cartas->count_hws($login,$carta['cod']);
			$carta['hws'] = $count_want_have;
			

			$dados = array('carta'=>$carta);


				$num_msgs = $this->mensagens->count_mensagens($login);
				$dados_lat = array('num_msgs'=>$num_msgs);

			$this->view("head");
			$this->view("nav",@$dados_lat);
			$this->view("container-fluid");
			$this->view("lateral",@$dados_lat);
			$this->view("front/colecoes/carta_only",@$dados);
			$this->view("footer");	

			
		}

		if($acao == 'add'){
			$id_carta = $this->post('id_carta');
			$id_colecao = (int)$this->post('id_colecao');



			$count = $this->colecoes->qtd_carta($id_carta,$id_colecao,$login);
			$tipo = $this->colecoes->get_tipo($id_colecao,$id_usuario);


			/*if($tipo == 'deck'){
					if($count < 4){*/
					
					


							$add = $this->colecoes->add_carta($this->auth->get_data('login'),$id_colecao,$id_carta);
							$ret = '';
							if($add){
								$ret .= '<div class="col-sm-3 col-md-2">
				                  			<div class=""><img style="height: 160px;" src="';
				                $ret .= get_img_carta($add);
				                $ret .= '" alt="'.$add['nome'].'" title="'.$add['nome'].' - '.$add['edicao'].' '.$add['idioma'].'">';
				                $ret .= '<div class="caption">
						                      	<br>
						                      	<a href="'.get_url('colecoes/carta/ver/'.$id_colecao.'/'.$id_carta.'_'.$add['token']).'" class="btn btn-primary btn-xs" role="button">Ver</a>';
						        $ret .= 		'<a href="'.get_url('colecoes/carta/excluir/'.$id_colecao.'/'.$id_carta.'_'.$add['token']).'" class="btn btn-danger btn-xs" role="button">Excluir</a> </div>
						                  <br/><br/></div>
						                </div>';
								echo $ret;


							}else{
								echo 'erro';
							}

						/*}else{
							echo 4;
						}
					
				}else{
					$add = $this->colecoes->add_carta($this->auth->get_data('login'),$id_colecao,$id_carta);
					$ret = '';
					if($add){
						$ret .= '<div class="col-sm-3 col-md-2">
		                  			<div class=""><img style="height: 160px;" src="';
		                $ret .= get_img_carta($add);
		                $ret .= '" alt="'.$add['nome'].'" title="'.$add['nome'].' - '.$add['edicao'].' '.$add['idioma'].'">';
		                $ret .= '<div class="caption">
				                      	<br>
				                      	<a href="'.get_url('colecoes/carta/ver/'.$id_colecao.'/'.$id_carta.'_'.$add['token']).'" class="btn btn-primary btn-xs" role="button">Ver</a>';
				        $ret .= 		'<a href="'.get_url('colecoes/carta/excluir/'.$id_colecao.'/'.$id_carta.'_'.$add['token']).'" class="btn btn-danger btn-xs" role="button">Excluir</a> </div>
				                  <br/><br/></div>
				                </div>';
						echo $ret;


					}else{
						echo 'erro';
					}
				}*/
			}
	}


	public function buscar_carta(){
		if($this->is_ajax()){
			$nome = $this->post('nome');
			$colecao = $this->post('id_colecao');

			if(strlen($nome) > 2){
					$criterios = array('nome' => new MongoRegex("/$nome/i"));
			

					$dados = iterator_to_array($this->cartas->listar($criterios));
					$ret = '';
					foreach ($dados as $c) {	
						$ret .= '<div class="col-md-1">';
						$ret .= '<div class="">';
						$ret .= "<img title=\"".$c['nome']." - ".$c['edicao']." - ".$c['idioma']."\" alt=\"" . $c['nome'] . "\" src=\"".get_img_carta($c)."\" style=\"height: 100px;\" >";
						$ret .= "<div class=\"caption\"><br/>";
						$ret .= "<a role=\"button\" id_carta=\"".$c['cod']."\" class=\"btn btn-primary add_carta btn-xs\" href=\"javascript:(void)\" >+</a>";
						$ret .= '</div></div></div>';

					}
					echo $ret;
			}else{
				echo 'Digite ao menos 3 caracteres.';
			}
			
		}
	}	
		




}