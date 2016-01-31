<?php if(!defined('SYSTEM')) exit('Acesso Negado!');

class Edicoes_model extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function listar($criterio = array(),$limitadores = array()){
		return $this->db->mongo->edicao->find($criterio,$limitadores);
	}

	public function inserir_edicao($edicao){
			$criterio = array(
						'idioma'=>$edicao['idioma'],
						'sigla'=>$edicao['sigla']
						);

			if(!$this->db->doc_exists('edicao',$criterio)){
				$this->db->mongo->edicao->insert($edicao);
				return true;
			}

			return false;
						
			
	}

	public function getName($criterio){
		return $this->db->mongo->edicao->findOne($criterio);
	}

	public function ver_se_existe($edicao){
		$criterio = array(
						'idioma'=>$edicao['idioma'],
						'sigla'=>$edicao['sigla']
						);


		if($this->db->doc_exists('edicao',$criterio)){
				return true;
		}

		return false;
						
	}

}