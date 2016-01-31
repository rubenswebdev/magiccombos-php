<?php

class Cartas extends Drk{
	public function __construct(){
		parent::__construct(true,true);

		
		$this->model('cartas');
		$this->model('edicoes');
	}

	public function listar(){

		$sigla = $this->segments(2);
		$idioma = $this->segments(3);
		$cod = $sigla.$idioma;

		$criterios = array('cod' => new MongoRegex("/$cod/"));
		$criterio_edicao = array('sigla'=>$sigla,'idioma'=>$idioma);


		$cartas = array('cartas'=>$this->cartas->listar($criterios),
						'subtitle'=>$this->edicoes->getName($criterio_edicao));

		$title = array('title' =>'Cartas');


		$this->view('head');
		$this->view('nav');
		$this->view('lateral');
		$this->view('opencontainer',@$title);
		$this->view('admin/cartas/listar',@$cartas);
		$this->view('footer');	

	}

	public function exibir(){

		$cod = $this->segments(2);

		$criterios = array('cod'=>$cod);

		$c = $this->cartas->getCarta($criterios);

		$carta = array('carta'=>$c,
			'title'=>$c['nome']);

		$this->view('head');
		$this->view('nav');
		$this->view('lateral');
		$this->view('opencontainer',@$carta);
		$this->view('admin/cartas/exibir',@$carta);
		$this->view('footer');	
	}
}