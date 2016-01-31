<?php

class Amigos_model extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function listar($login){

		$criterio = array('login'=>$login);
		$limitador = array('amigos' => 1,'_id'=>0);


		$ret = $this->db->mongo->usuario->find($criterio,$limitador);


		return iterator_to_array($ret);
	}

	public function find($criterio,$limitador = array()){

		$ret = $this->db->mongo->usuario->find($criterio,$limitador);

		return iterator_to_array($ret);

	}


	public function desfazer_amizade($login,$id_usuario_amigo,$id_usuario){			
			$where = array('login'=>$login);
			$delete = array('$pull'=>array('amigos'=>array('id_usuario' =>(int)$id_usuario_amigo)));
			if($this->db->mongo->usuario->update($where,$delete)){
				$where = array('id'=>(int)$id_usuario_amigo);
				$delete = array('$pull'=>array('amigos'=>array('id_usuario' =>(int)$id_usuario)));
			}
			return $this->db->mongo->usuario->update($where,$delete);
	}


	public function buscar($nome_email,$id_usuario,$login){
		
			$criterio = array('ativo'=>1,'id'=>array('$ne'=>$id_usuario),'$or'=>array(array('nome'=>$nome_email),array('email'=>$nome_email)));
			$limitador = array('colecoes'=>0,'mensagens'=>0,'amigos'=>0,'senha'=>0,'_id'=>0,'admin'=>0,'documento'=>0,'ativo'=>0);
			$ret = $this->db->mongo->usuario->find($criterio,$limitador);

			$p = iterator_to_array($ret);
		

			foreach ($p as $key => $value) {
				
			
			$verificar = $this->db->mongo->usuario->findOne(array('login'=>$login,'id'=>(int)$id_usuario,'amigos.id_usuario'=>(int)$value['id']),
														array( 'amigos.$'=>1)
													 );
				if(!empty($verificar)){
					unset($p[$key]);
				}
			
			}

						

			return $p;
		

		return false;
	}


	public function buscar_one($id){
		$criterio = array('ativo'=>1,'id'=>(int)$id);
		$limitador = array('colecoes'=>0,'mensagens'=>0,'amigos'=>0,'senha'=>0,'_id'=>0,'admin'=>0,'documento'=>0,'ativo'=>0);
		$ret = $this->db->mongo->usuario->findOne($criterio,$limitador);

		return $ret;

	}

	public function add_amigo($pessoa,$usuario){

				 $this->db->mongo->usuario->update(array('id'=>$usuario['id']),
														array('$push' => 
															array('amigos' =>
															  	array(
															             'id_usuario' => (int)$pessoa['id'],
															             'aceito'=> 1,
															             'nome'=> $pessoa['nome'],
															             'sobrenome'=>@$pessoa['sobrenome'],
															             'email'=>$pessoa['email'],
															             'url_perfil'=>@$pessoa['url_perfil'],
															             'imagem'=>$pessoa['imagem'],
															             'capa'=>$pessoa['capa'],
															             'adicionado_dia'=> new MongoDate()
															         )
															     )
															)
														);
				return $this->db->mongo->usuario->update(array('id'=>(int)$pessoa['id']),
														array('$push' => 
															array('amigos' =>
															  	array(
															             'id_usuario' => (int)$usuario['id'],
															             'aceito'=> 0,
															             'nome'=> $usuario['nome'],
															             'sobrenome'=>@$usuario['sobrenome'],
															             'email'=>$usuario['email'],
															             'url_perfil'=>@$usuario['url_perfil'],
															             'imagem'=>$usuario['imagem'],
															             'capa'=>$usuario['capa'],
															             'adicionado_dia'=> new MongoDate()
															         )
															     )
															)
														);

	}

}