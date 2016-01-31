<?php 

Class Combos_model extends Model{

	public function __construct(){
		parent::__construct();
	}


	public function get_user($id){
		$ret = $this->db->mongo->usuario->findOne(array('id'=>(int)$id));
		return $ret;
	}

	public function listar_uma($criterio = array(),$limitadores = array()){
		return $this->db->mongo->carta->findOne($criterio,$limitadores);
	}

	public function remove($criterio){

		return $this->db->mongo->combos->remove($criterio);
	}

	public function add($dados){
		$id = $this->db->get_next('combos');
		$dados['id'] = (int)$id;

		return $this->db->mongo->combos->insert($dados);

	}

	public function get_combo($criterio,$limitador){
		$retorno = $this->db->mongo->combos->findOne($criterio,$limitador);


		foreach ($retorno['cartas'] as $i => $carta) {
			$cri = array('cod'=>$carta);
			$lim = array('tipos' => 0,'legalidade'=>0,'regras'=>0,'_id'=>0 );
			$c = $this->listar_uma($cri,$lim);
			$retorno['cartas'][$i] = $c;
			
			

		}
		foreach ($retorno['manas'] as $e => $mana) {
			$m = converte_mana($mana);
			$retorno['manas'][$e] = $m;
		}

		return $retorno;
	}

	public function listar_combos(){
		$combos = $this->db->mongo->combos->find(array(),array('_id'=>0));
		$combos = iterator_to_array($combos);


		foreach ($combos as $i => $combo) {
			$usuario = $this->get_user($combo['id_usuario']);
			$combos[$i]['usuario']['nome'] = $usuario['nome'];
			$combos[$i]['usuario']['email'] = $usuario['email'];


			foreach ($combo['manas'] as $e => $mana) {
				$m = converte_mana($mana);
				$combos[$i]['manas_img'][] = $m;
			}
		}

		return $combos;
	}

}