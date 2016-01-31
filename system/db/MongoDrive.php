<?php if(!defined('SYSTEM')) exit('Acesso Negado!');

class MongoDrive{
     
	public $db;
	private $conn;

    public function __construct() {
        $this->conn = new MongoClient("mongodb://root:8uijkm90@localhost/mgc");
  		$this->db = $this->conn->mgc;
    }

   	public function doc_exists($colecao,$criterio = array()){
		if($this->db->$colecao->findOne($criterio))
			return true;
		else
			return false;
	}	

	public function count($colecao){
		return $this->db->$colecao->count();
	}

	public function create_table($colecao,$dados){
		$this->db->$colecao->remove(array('table'=>$dados['table']));
		return $this->db->$colecao->insert($dados);
	}

	public function get_next($table){
		$criterio = array('table'=>$table);
		$limitador = array('next_id'=>1);

		
		$id = $this->db->inc->findOne($criterio,$limitador);
		foreach ($id as $key => $value) {
			$id = @$value;
		}
		
		$this->db->inc->update(array("table" => $table), array('$inc' => array("next_id" => 1)));
		return $id;
	}

	public function create_inc(){
			$colecao = 'inc';
			$dados = array('table'=>'combos','next_id'=>1);
			$this->db->create_table($colecao,$dados);

			$dados = array('table'=>'mensagens','next_id'=>1);
			$this->db->create_table($colecao,$dados);

			$dados = array('table'=>'colecao','next_id'=>1);
			$this->db->create_table($colecao,$dados);

			$dados = array('table'=>'usuario','next_id'=>1);
			$this->db->create_table($colecao,$dados);

			$dados = array('table'=>'carta_colecao','next_id'=>1);
			$this->db->create_table($colecao,$dados);
	}
 
}