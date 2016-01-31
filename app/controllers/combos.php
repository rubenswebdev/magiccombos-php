<?php 

Class Combos extends Drk{

	public function __construct(){
		parent::__construct(true,true);
		$this->model('mensagens');
		$this->model('combos');
		$this->model('cartas');
	}

	public function index(){

		$login     = $this->auth->get_data('login');
		
		$num_msgs  = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		$combos = $this->combos->listar_combos();

		$dados =array('combos' => @$combos,'title'=>'Combos cadastrados no site' );


		$this->view("head");
		$this->view("nav",@$dados_lat );

		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat);
		$this->view("front/combos/combos",@$dados);
		$this->view("footer");	

	}

	public function remover(){
		$id_combo = $this->segments(2);
		$id_usuario = $this->auth->get_data('id');

		$criterio = array('id_usuario'=>(int)$id_usuario,'id'=>(int)$id_combo);

		if($this->combos->remove($criterio)){
			redirect(get_url('combos/index/ok'));
		}else{
			redirect(get_url('combos/index/erro'));
		}
	}


	public function ver(){
		$id_combo = $this->segments(2);
		

		$criterio = array('id'=>(int)$id_combo);
		$limitador = array('_id'=>0);

		$cartas = $this->combos->get_combo($criterio,$limitador);



		$login     = $this->auth->get_data('login');
		
		$num_msgs  = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		
		$dados =array('combo' => @$cartas );


		$this->view("head");
		$this->view("nav",@$dados_lat );

		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat);
		$this->view("front/combos/ver",@$dados);
		$this->view("footer");	
		


	}

	public function add(){
		if($this->is_ajax()){
			$nome = $this->post('nome');
			$cartas =  $this->post('cartas');
			$cartas = explode('_', $cartas);
			array_pop($cartas);

			foreach ($cartas as $key => $value) {
				$c = array('cod'=>$value);
				$li = array('mana'=>1,'_id'=>0);
				$manas = $this->cartas->listar_uma($c,$li);

				if (strpos($manas['mana'],'G') !== false) {
				    $m['G'] = true;
				}
				if (strpos($manas['mana'],'B') !== false) {
				    $m['B'] = true;
				}
				if (strpos($manas['mana'],'U') !== false) {
				    $m['U'] = true;
				}
				if (strpos($manas['mana'],'R') !== false) {
				    $m['R'] = true;
				}
				if (strpos($manas['mana'],'W') !== false) {
				    $m['W'] = true;
				}

				

				
			}

			if(count($m) > 0){
				foreach ($m as $key => $value) {
					if($value) $man[] = $key;
				}
			}


			$dados = array('nome'=>$nome,'cartas'=>$cartas,'manas'=>$man,'id_usuario'=>(int)$this->auth->get_data('id'));

			if($this->combos->add($dados)){
				echo 1;
			}else{
				echo 0;
			}

		}
	}

	public function buscar_carta(){
		if($this->is_ajax()){
			$nome = $this->post('nome');
			

			if(strlen($nome) > 2){
					$criterios = array('nome' => new MongoRegex("/$nome/i"));
			

					$dados = iterator_to_array($this->cartas->listar($criterios));
					$ret = '';
					foreach ($dados as $c) {	
						$ret .= '<div class="col-md-2">';
						$ret .= '<div class="">';
						$ret .= "<img title=\"".$c['nome']." - ".$c['edicao']." - ".$c['idioma']."\" alt=\"" . $c['nome'] . "\" src=\"".get_img_carta($c)."\" style=\"height: 100px;\" >";
						$ret .= "<div class=\"caption\"><br/>";
						$ret .= "<a role=\"button\" edicao=\"".$c['edicao']."\"  nome_carta=\"".$c['nome']."\" idioma=\"".$this->get_idioma($c['idioma'])."\" id_carta=\"".$c['cod']."\" class=\"btn btn-primary add_carta btn-xs\" href=\"javascript:\" >+</a>";
						$ret .= '</div></div></div>';

					}
					echo $ret;
			}else{
				echo 'Digite ao menos 3 caracteres.';
			}
			
		}
	}	

	public function novo(){


		$login     = $this->auth->get_data('login');
		
		$num_msgs  = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		
		if($this->is_post()){

		}

		$dados = array('title'=>'Cadastro de novo combo');

		$this->view("head");
		$this->view("nav",@$dados_lat );

		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat);
		$this->view("front/combos/novo",@$dados);
		$this->view("footer");	
	}

}