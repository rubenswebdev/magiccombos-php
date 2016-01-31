
<?php

class Mensagens_model extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function listar_msgs($login){

		$criterio = array('login'=>$login);
		$limitador = array('mensagens' => 1,'_id'=>0);


		$ret = $this->db->mongo->usuario->find($criterio,$limitador);


		return iterator_to_array($ret);
	}

	public function count_mensagens($login){

		$agreg = $this->db->mongo->usuario->aggregate(
										array('$unwind'=>'$mensagens'),
										array('$match'=> array('login'=>$login,'mensagens.lida'=>0)),
										array('$group'=>array('_id'=>null,'count'=>array('$sum'=>1)))
									 );

		$ret = @$agreg['result'][0]['count'];


		return $ret;

	



	}


	public function update_lida($id){

		$id = (int)$id;
		$this->db->mongo->usuario->findAndModify(
		     array("mensagens.id" => $id,"mensagens.lida" => 0),
		     array('$set' => array('mensagens.$.lida' => 1, "mensagens.$.lida_dia" => new MongoDate())),
		     null,
		     null
		);

	}

	
	public function excluir($login,$id){			
			$where = array('login'=>$login);
			$delete = array('$pull'=>array('mensagens'=>array('id' =>(int)$id)));

			return $this->db->mongo->usuario->update($where,$delete);
	}

	public function enviar_msg($nome,$email,$msg,$id_remetente,$para,$cod_carta,$cod_colecao){


			/*$verificar = $this->db->mongo->usuario->findOne(array(	'mensagens.id_remetente'=>(int)$id_remetente,
																	'mensagens.cod_carta'=>$cod_carta,
																	'mensagens.cod_colecao'=>(int)$cod_colecao,
																	'mensagens.lida'=>0
																	),
															array( 'mensagens.$'=>1)
															);*/
														
			//if(!empty(@$verificar)){
			//	return 'ja';
			//}else{

				return $this->db->mongo->usuario->update(array('id'=>(int)$para),
														array('$push' => 
															array('mensagens' =>
															  	array(
															             'id' => $this->db->get_next('mensagens'),
															             'lida'=> 0,
															             'msg'=> $msg,
															             'id_remetente'=>(int)$id_remetente,
															             'ativa'=>1,
															             'nome'=>$nome,
															             'email'=>$email,
															             'cod_carta'=>$cod_carta,
															             'cod_colecao'=>(int)$cod_colecao,
															             'enviada_dia'=> new MongoDate()
															         )
															     )
															)
														);
			//}
	}




	

}