<?php

class Mensagens extends Drk{

	public function __construct(){
		parent::__construct(true,true);
		$this->model('mensagens');
		$this->model('cartas');
	}

	public function index(){
		$login =  $this->auth->get_data("login");
		$num_msgs = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		$msg_ = $this->mensagens->listar_msgs($login);

		

		$msgs = $msg_;
		if(isset($msgs[0]['mensagens']))
		if(count($msgs[0]['mensagens']) > 0 )
		foreach ($msgs[0]['mensagens'] as $key => $value) {
		

			$criterio = array('cod'=>$value['cod_carta']);
			$carta = $this->cartas->listar_uma($criterio);

			$msg_[0]['mensagens'][$key]['imagem_local'] = $carta['imagem_local'];
			
			$id = (int)$value['id'];
			$this->mensagens->update_lida($id);//atualiza que a mensagem foi visualizada
		}

		$msg = array('msgs'=>$msg_,'title'=>'Minhas mensagens');

		$this->view("head");
		$this->view("nav",@$dados_lat);
		$this->view("container-fluid");
		$this->view("lateral",@$dados_lat );
		$this->view('front/mensagens/mensagens',@$msg);
		$this->view("footer");	
	}


	public function excluir_msg(){
		$id = $this->segments(2);
		$login = $this->auth->get_data('login');
		if((int)$id != 0){
			$this->mensagens->excluir($login,$id);
		}

		redirect(get_url('mensagens'));
		
	}


	public function enviar_msg(){
		$msg = $this->post('msg');
		$para = $this->post('id_usuario');
		$id_remetente = $this->auth->get_data('id');
		$email = $this->auth->get_data('email');
		$nome = $this->auth->get_data('nome');
		$cod_carta = $this->post('cod_carta');
		$cod_colecao = $this->post('cod_colecao');

		$msg = $this->mensagens->enviar_msg($nome,$email,$msg,$id_remetente,$para,$cod_carta,$cod_colecao);
		
		echo $msg;
	}

}