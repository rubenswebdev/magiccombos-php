<?php


/**
 * função que resgata a forma como será carregada a imagem no front-end e se a imagem ainda não existir no servidor ele faz dowload da mesma
 * @param  Array $carta
 * @return String
 */
 function get_img_carta($carta){


 	if(isset($carta['imagem_src'])):
			$url     = explode('http://magiccards.info/', $carta['imagem_src']);
			$url     = explode('/', $url[1]);
			
			$pasta   = $url[2].'/'.$url[1].'/';
			$arquivo = $url[2].'/'.$url[1].'/'.$url[3];

			if(!file_exists('public/cartas/'.$pasta)){
				mkdir('public/cartas/'.$pasta, 0777, true);
			}
			
			if( ! file_exists('public/cartas/'.$arquivo)){
				file_put_contents("public/cartas/".$arquivo, fopen($carta['imagem_src'], 'r'));
			}else{
			
			}
	endif;

	if(URL_IMAGENS == 'local'){
		return get_url('public/cartas/').$carta['imagem_local'];
	}else{
		return $carta['imagem_src'];
	}	
}

