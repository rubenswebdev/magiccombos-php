<?php if(!defined('SYSTEM')) exit('Acesso Negado!');

class Model{

	public function __construct(){ 
		$this->db = new MongoDrive;//carrega a classe de Mongo
		$this->db->mongo = $this->db->db;
	}


}