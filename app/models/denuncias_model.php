<?php

Class Denuncias_model extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function denunciar($dados){

		$criterio = $dados;
		unset($criterio['motivos']);
		$ver = $this->db->mongo->denuncias->find($criterio,array('_id'=>0));

		$ver = iterator_to_array($ver);	
		if(count($ver) > 0){
			return false;
		}else{
			$dados['id'] = $this->db->get_next('denuncias');
			$ret  = $this->db->mongo->denuncias->insert($dados);
			return $ret;
		}

	}

	public function count_denuncias($id){

		$agreg = $this->db->mongo->denuncias->aggregate(
										array('$match'=> array('id_denunciado'=>(int)$id)),
										array('$group'=>array('_id'=>null,'count'=>array('$sum'=>1)))
									 );

		$ret = @(int)$agreg['result'][0]['count'];



		return $ret;

	



	}

	public function get_texto($id){
		$ret = $this->db->mongo->tipo_denuncia->findOne(array('id'=>(int)$id));
		return $ret;
	}

	public function get_user($id){
		$ret = $this->db->mongo->usuario->findOne(array('id'=>(int)$id));
		return $ret;
	}

	public function get_denuncias($id){

		$ret = $this->db->mongo->denuncias->find(array('id_denunciado'=>(int)$id),array('_id'=>0));
		$ret = iterator_to_array($ret);

	

		foreach ($ret as $i => $denuncia) {
			
			foreach ( $denuncia['motivos'] as $value) {
				$motivo           = $this->get_texto($value);
				$ret[$i]['motivos_texto'][] = $motivo['texto'];
			}

			$usuario                     = $this->get_user( $denuncia['id_denunciante']);
			$ret[$i]['usuario']['nome']  = $usuario['nome'];
			$ret[$i]['usuario']['email'] = $usuario['email'];


		}



		
		

		return $ret;

	}

	public function remover($criterio){
		return $this->db->mongo->denuncias->remove($criterio);
	}


	public function get_denunciados($id){

		$ret = $this->db->mongo->denuncias->find(array('id_denunciante'=>(int)$id),array('_id'=>0));
		$ret = iterator_to_array($ret);

	

		foreach ($ret as $i => $denuncia) {
			
			foreach ( $denuncia['motivos'] as $value) {
				$motivo           = $this->get_texto($value);
				$ret[$i]['motivos_texto'][] = $motivo['texto'];
			}

			$usuario                     = $this->get_user( $denuncia['id_denunciado']);
			$ret[$i]['usuario']['nome']  = $usuario['nome'];
			$ret[$i]['usuario']['email'] = $usuario['email'];


		}



		
		

		return $ret;

	}

}