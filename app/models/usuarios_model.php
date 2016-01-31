<?php  

Class Usuarios_model extends Model{

	public function verificar_login($criterio = array(),$limitadores = array()){
		return $this->db->mongo->usuario->find($criterio,$limitadores);
	}

	public function verificar_email($criterio = array(),$limitadores = array()){
		return $this->db->mongo->usuario->find($criterio,$limitadores);
	}

	public function get_usuario($id){
		$criterio = array('id'=>(int)$id);
		$limitador = array('amigos'=>0,'_id'=> 0, 'colecoes'=>0,'mensagens'=>0,'senha'=>0,'data_cadastro'=>0);
		return $this->db->mongo->usuario->findOne($criterio,$limitador);
	}

	public function editar($where,$set,$senha){
		if($senha != ''){
			$senha = crypt($senha);
			$set['$set']['senha'] = $senha;
		}
		
		return $this->db->mongo->usuario->update($where,$set);
	}

	public function cadastrar($usuario){
		return $this->db->mongo->usuario->insert(array(
											            'id' => $this->db->get_next('usuario'),
											            'nome'=>$usuario['nome'],
														'email'=>$usuario['email'],
														'login'=>$usuario['login'],
														'documento'=>$usuario['documento'],
														'ativo'=>1,
														'sexo'=>$usuario['sexo'],
														'senha'=>crypt($usuario['senha']),
														'dtnascimento'=>$usuario['dtnascimento'],
														'receber_novidades'=>$usuario['receber_novidades'],
											            'data_cadastro'=> new MongoDate(),
											            'admin'=>0
														)
												);
	}



}

