<?php

class Login_model extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function logar($criterio,$pass){


		$ret = $this->db->mongo->usuario->findOne($criterio);

		$senha_enviada = $pass;
		$senha = $ret['senha'];
		
		if(count($ret) > 0){
			
			if(crypt($senha_enviada,@$senha)==@$senha){
			
				
				unset($ret['senha']);
				return $ret;	
				
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}



}