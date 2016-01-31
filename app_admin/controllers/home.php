<?php

class Home extends Drk{

	public function __construct(){
		parent::__construct(true,true);
		

		$this->model('edicoes');
		$this->model('usuarios');
	}

	public function index(){

		$dados = array('title' =>'Home');
		$total = array(
			'edicoes' =>$this->edicoes->db->count('edicao'),
			'usuarios' =>$this->edicoes->db->count('usuario'),
			'combos' =>$this->edicoes->db->count('combos'),
			'cartas' =>$this->edicoes->db->count('carta')
			

			);

		$this->view('head');
		$this->view('nav');
		$this->view('lateral');
		$this->view('opencontainer',@$dados);
		$this->view('admin/home/body',@$total);
		$this->view('footer');	
	}

}