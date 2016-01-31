<?php

class Cartas_model extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function listar($criterio = array(),$limitadores = array()){
		return $this->db->mongo->carta->find($criterio,$limitadores);
	}

	public function listar_uma($criterio = array(),$limitadores = array()){
		return $this->db->mongo->carta->findOne($criterio,$limitadores);
	}

	public function getCarta($criterio){
		return $this->db->mongo->carta->findOne($criterio);
	}

	public function inserir_cartas($cartas){

		foreach ($cartas as $key => $c) {
			$criterio = array(
						'cod'=>$c['cod']
						);

			if(!$this->db->doc_exists('carta',$criterio)){
				$this->db->mongo->carta->insert($c);
			}			
			
		}
		
	}

}