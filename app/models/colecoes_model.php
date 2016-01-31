<?php

class Colecoes_model extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function listar_colecoes($criterio = array()){
		$ret = $this->db->mongo->usuario->find($criterio);
		
		return $ret;
	}

	public function get_tipo ($id_colecao,$id_usuario){
		$c = array('colecoes.id'=>(int)$id_colecao,'id'=>(int)$id_usuario);
		$l = array('_id'=>0,'colecoes.tipo'=>1,'colecoes.id'=>1);
		$col = iterator_to_array($this->db->mongo->usuario->find($c,$l));

		
		return @$col[0]['colecoes'][0]['tipo'];
	}

	public function add($login,$nome,$tipo){

		$colecao = array('id'=> $this->db->get_next('colecao'),'nome'=>$nome,'tipo'=>$tipo,'cartas'=>array(),'publico'=>($tipo == 'want' || $tipo == 'have' ? 1 : 0));

		if($this->db->mongo->usuario->update(array('login'=>$login),
													array( '$push' => array( 'colecoes' =>$colecao))
											)
		){
			return true;
		}else{
			return false;
		}

	}

	public function renomear($where,$set){
		
		return $this->db->mongo->usuario->update($where,$set);
	}

	public function excluir($login,$id_colecao){
			return $this->db->mongo->usuario->update(
				array('login'=>$login,'colecoes.id'=>$id_colecao),
			    array( '$pull' =>
			        array( 'colecoes' =>
			            array(
			                'id' => $id_colecao
			            )
			        )
			    )

			);
	}

	public function excluir_carta($login,$id_colecao,$cod_carta){
			return $this->db->mongo->usuario->update(
				array('login'=>$login,'colecoes.id'=>$id_colecao),
			    array( '$pull' =>
			        array( 'colecoes.$.cartas' =>
			            array(
			                'cod' => $cod_carta
			            )
			        )
			    )

			);

	}

	public function add_carta($login,$id_colecao,$cod_carta){
		$token = $this->db->get_next('carta_colecao');
		$carta = $this->db->mongo->carta->findOne(array('cod'=>$cod_carta),array('cod'=>1));

		if(count($carta) > 0 ){

				if($this->db->mongo->usuario->update(array('login'=>$login,'colecoes.id'=>$id_colecao),
													array( '$push' => 
														array( 'colecoes.$.cartas' =>
														  	array(
														             'cod' => $cod_carta.'_'.$token
														            )
														        )
														    )
				)){
					$carta = $this->db->mongo->carta->findOne(array('cod'=>$cod_carta));
					$carta['token'] = $token;
					return $carta;
				}
		}

		return false;

		

		
	}



	public function qtd_carta($cod,$id_colecao,$login){
			$agreg = $this->db->mongo->usuario->aggregate(
											array('$unwind'=>'$colecoes'),
											array('$unwind'=>'$colecoes.cartas'),
											array('$match'=> array('login'=>$login,'colecoes.id'=>(int)$id_colecao,'colecoes.cartas.cod'=>new MongoRegex("/$cod/^"))),
											array('$group'=>array('_id'=>null,'count'=>array('$sum'=>1)))
										 );

			$ret = @$agreg['result'][0]['count'];


			return $ret;
	}

}