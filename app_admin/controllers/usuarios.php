<?php
class Usuarios extends Drk{

	public function __construct(){
		parent::__construct(true,true);
		$this->model('usuarios');
	}

	public function index(){

		$dados = array('title' =>'Usuários');
		$usuarios = array('usuarios'=>$this->usuarios->listar());
		$this->view('head');
		$this->view('nav');
		$this->view('lateral');
		$this->view('opencontainer',@$dados);
		$this->view('admin/usuarios/listar',$usuarios);
		$this->view('footer');	
	}

}