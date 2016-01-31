<?php 

Class Denuncias extends Drk{

	public function __construct(){
		parent::__construct(true,true);
		$this->model('mensagens');
		$this->model('denuncias');

	}

	public function remover(){

		$id_denunciante = $this->auth->get_data('id');
		$id_denunciado = $this->segments(2);

		$criterio = array('id_denunciante'=>(int)$id_denunciante,'id_denunciado'=>(int)$id_denunciado);

		$ret = $this->denuncias->remover($criterio);

		if($ret)
			redirect(get_url('denuncias/feitas/ok'));
		else
			redirect(get_url('denuncias/feitas/erro'));
	
	}


	public function feitas(){
		$login     = $this->auth->get_data('login');
		$id = $this->auth->get_data('id');

		$num_msgs  = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		

		$denunciados = $this->denuncias->get_denunciados($id);


	

		$dados = array('denunciados'=>$denunciados,'title'=>'Denuncias Efetuadas por você');


	

		$this->view("head");
		$this->view("nav",@$dados_lat );

		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat);
		$this->view("front/denuncias/feitas",@$dados);
		$this->view("footer");	
	}

	public function recebidas(){
		$login     = $this->auth->get_data('login');
		$id = $this->auth->get_data('id');

		$num_msgs  = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		

		$denuncias = $this->denuncias->get_denuncias($id);


	

		$dados = array('denuncias'=>$denuncias,'title'=>'Denuncias que você recebeu');


	

		$this->view("head");
		$this->view("nav",@$dados_lat );

		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat);
		$this->view("front/denuncias/recebidas",@$dados);
		$this->view("footer");	

		
	}


	public function denunciar(){
		if($this->is_ajax()){
			$motivos = $this->post('lista');
			$motivos = explode('_', $motivos);
			array_pop($motivos);
			
			$id_denunciante = $this->auth->get_data('id');
			$id_denunciado = $this->post('id_denunciado');
			$cod_carta = $this->post('cod_carta');


			$dados = array('id_denunciado'=>(int)$id_denunciado,'id_denunciante'=>(int)$id_denunciante,'cod_carta'=>$cod_carta,'motivos'=>$motivos);
			if($this->denuncias->denunciar($dados)){
				echo 1;
			}else{
				echo 0;
			}


		}
	}

}