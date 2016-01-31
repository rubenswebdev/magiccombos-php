<?php 

Class Perfil extends Drk{

	public function __construct(){
		parent::__construct(true,true);
		$this->model('mensagens');
		$this->model('usuarios');
	}

	public function index(){
		$id_usuario = $this->auth->get_data('id');
		$login = $this->auth->get_data('login');

		$num_msgs = $this->mensagens->count_mensagens($login);
		$dados_lat = array('num_msgs'=>$num_msgs);

		$usuario = $this->usuarios->get_usuario($id_usuario);
		


		$perfil = array('title'=>'Meu Perfil','usuario'=>@$usuario);




		$this->view("head");
		$this->view("nav",@$dados_lat);
		$this->view("container-fluid");
		
		$this->view("lateral",@$dados_lat);
		$this->view("front/perfil/perfil",@$perfil);
		$this->view("footer");
	}

	public function editar(){
		if($this->is_post()){

			$id = $this->auth->get_data('id');
			$login = $this->auth->get_data('login');

			$nome = $this->post('nome');
			$email = $this->post('email');
			$login_new = $this->post('login');
			$senha = $this->post('senha');
			$documento = $this->post('documento');
			$sexo = $this->post('sexo');
			$dtnascimento = $this->post('dtnascimento');
			$receber_novidades = $this->post('receber_novidades');



			$where = array('id'=>(int)$id,'login'=>$login);
			$set = array('$set'=>array(
					 		           'nome'=>$nome,
					 		           'email'=>$email,
					 		           'login'=>$login_new,
					 		           'documento'=>$documento,
					 		           'sexo'=>$sexo,
					 		           'dtnascimento'=>$dtnascimento,
					 		           'receber_novidades'=>$receber_novidades)
					 		           

			);

			if($this->usuarios->editar($where,$set,$senha)){
				if($senha != ''){
					redirect(get_url('home/sair'));
				}else{
					redirect(get_url('perfil//ok'));
				}
			}

		}
	}

}