<?php

class Auth{

	public function loged($r = false){

		if(empty($_SESSION['userdata'])){
			if($r)
				redirect(get_url(URL_LOGIN));
			return false;
		}
		return true;
	}

	public function create($data){
		$_SESSION['userdata'] = $data;
	}

	public function destroy(){
		session_destroy();
	}

	public function get_data($pos = null){
		if(isset($_SESSION['userdata'][$pos]))
			return $_SESSION['userdata'][$pos];
	}

	public function get_md5(){
		$token = md5(uniqid(""));
		return $token;
	}

}