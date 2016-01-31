<?php

class Cartas_model extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function get_wants($cod){
		$cod = explode('_', $cod);
		$cod = $cod[0];		

		$criterio = array("colecoes.cartas.cod" => new MongoRegex("/$cod/^"),"colecoes.tipo"=>"want");
		
		return $this->db->mongo->usuario->find($criterio);
	}


	public function get_haves($cod){
		$cod = explode('_', $cod);
		$cod = $cod[0];

		$criterio = array("colecoes.cartas.cod" => new MongoRegex("/$cod/^"),"colecoes.tipo"=>"have");
		

		return $this->db->mongo->usuario->find($criterio);
	}


	public function count_hws($login,$cod){

		$agreg = $this->db->mongo->usuario->aggregate(
										array('$unwind'=>'$colecoes'),
										array('$match'=> array('login'=>array('$ne'=>$login),'colecoes.tipo'=>'have','colecoes.cartas.cod'=> new MongoRegex("/$cod/i"))),
										array('$group'=>array('_id'=>null,'count'=>array('$sum'=>1)))
									 );
		$have = @$agreg['result'][0]['count'];
		
		$agreg = $this->db->mongo->usuario->aggregate(
										array('$unwind'=>'$colecoes'),
										array('$match'=> array('login'=>array('$ne'=>$login),'colecoes.tipo'=>'want','colecoes.cartas.cod'=> new MongoRegex("/$cod/i"))),
										array('$group'=>array('_id'=>null,'count'=>array('$sum'=>1)))
									 );
		$want = @$agreg['result'][0]['count'];

		$ret['want'] = (int)$want;
		$ret['have'] = (int)$have;

		return $ret;
	}


	public function listar($criterio = array(),$limitadores = array()){
		return $this->db->mongo->carta->find($criterio,$limitadores);
	}
	public function listar_limite($criterio = array(),$limitadores = array(),$limitador = 20){
		return $this->db->mongo->carta->find($criterio,$limitadores)->limit($limitador);
	}

	public function listar_uma($criterio = array(),$limitadores = array()){
		return $this->db->mongo->carta->findOne($criterio,$limitadores);
	}

	public function get_carta($criterio){
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