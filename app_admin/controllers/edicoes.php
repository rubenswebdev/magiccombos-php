<?php
class Edicoes extends Drk{

	public function __construct(){
		parent::__construct(true,true);
		$this->model('edicoes');
	}

	public function index(){

		$dados = array('title' =>'Edições');
		$edicoes = array('edicoes'=>$this->edicoes->listar());
		$this->view('head');
		$this->view('nav');
		$this->view('lateral');
		$this->view('opencontainer',@$dados);
		$this->view('admin/edicoes/listar',$edicoes);
		$this->view('footer');	
	}

}