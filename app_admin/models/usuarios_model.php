<?php if(!defined('SYSTEM')) exit('Acesso Negado!');

class Usuarios_model extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function listar($criterio = array(),$limitadores = array()){
		return $this->db->mongo->usuario->find($criterio,$limitadores);
	}

	public function inserir_usuario($usuario){
			$criterio = array(
						'idioma'=>$edicao['idioma'],
						'sigla'=>$edicao['sigla']
						);

			if(!$this->db->doc_exists('edicao',$criterio)){
				$this->db->mongo->usuario->insert($edicao);
			}
						
			
	}

	public function getName($criterio){
		return $this->db->mongo->usuario->findOne($criterio);
	}

}