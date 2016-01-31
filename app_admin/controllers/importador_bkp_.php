<?php

class importador extends Drk{
	
	public $numero;
	public $url;
	public $nome;
	public $link;
	public $mana;
	public $descricao;
	public $mana_convertida;
	public $texto;
	public $lealdade;
	public $regras;
	public $raridade;
	public $idioma;
	public $sigla_edicao;
	public $artista;
	public $ataque;
	public $tipos;
	public $resistencia;
	public $imagem_src;
	public $imagem_local;
	public $edicao;
	public $legalidade;
	public $contador;


	public function __construct(){
		parent::__construct(true,true);
		$this->model('cartas');
		$this->model('edicoes');
		//$this->importador->inserir_cartas(array('teste'=>'valor'));
	}

	public function index(){

		$title = array('title' =>'Importador');
		$subtitle = array('subtitle' => 'Importar via URL');

		$this->view('head');
		$this->view('nav');
		$this->view('lateral');
		$this->view('opencontainer',@$title);
		$this->view('admin/importador/importador',@$subtitle);
		$this->view('footer');	
	}
	
	public function listarEdicoes(){
		if($this->is_ajax()){
			$this->url = $this->post('url');
			$this->idioma = explode('/',$this->url);
			$this->sigla_edicao = strip_tags($this->idioma[3]);
			$this->idioma = explode('.',$this->idioma[4]);
			$this->idioma = strip_tags($this->idioma[0]);
			$dados = $this->getEdicoes();
			echo  json_encode($dados);
		}	
	}
	
	public function pegaEdicao(){
		if($this->is_ajax()){
			$this->url = $this->post('url');	
			$this->idioma = explode('/',$this->url);
			$this->sigla_edicao = strip_tags($this->idioma[3]);
			$this->idioma = explode('.',$this->idioma[4]);
			$this->idioma = strip_tags($this->idioma[0]);
			$dados = $this->getList();
			echo " Arquivo ".$this->sigla_edicao." - ".$this->idioma.".json criado com sucesso! ";
		}
	}
	
	private function getEdicoes(){
		$html = file_get_html($this->url);
		$edicoes_html = $html->find('body > a');
		for($i = 0;$i <= 11;$i++){ //elimina os links que nao sao edicoes
			unset($edicoes_html[$i]);
		}
		$titulo = $html->find('h1');
		$edicoes[0]['nome'] = strip_tags($titulo[0]->outertext);
		$edicoes[0]['link'] = $this->url;
		
		$indice = 1;
		foreach($edicoes_html as $e){
		
			$url = explode('/',$e->href);
			if(count($url) == 3){
				$edicoes[$indice]['nome'] = strip_tags($e->outertext);
				$edicoes[$indice]['link'] = 'http://magiccards.info'.$e->href;
			}
			$indice++;
		}
		$html->clear();
		unset($html);
		unset($titulo);
		unset($edicoes_html);
		return $edicoes;
	}
	
	function getList(){

			$html = file_get_html($this->url);
			$rows = $html->find('tr');

			$dados = array();
			foreach ($rows as $row) {
				$cells = $row->find('td');
				$cellData = array();
				foreach ($cells as $cell) {											
					$cellData[] = $cell->outertext;
				}
				$dados[] = $cellData;	
			}

			$limite = 4;
			if(count($dados) > 4){//edicoes sem paginacao nao precisao remover
				unset ($dados[count($dados)-1]);//elimina contagem das paginas e lista e...
			}else{
				$limite = 3;
			}

			

			for ($i=0;$i < $limite;$i++){
				unset ($dados[$i]);//elimina menu, lista etc...
			}
			
			//for ($i=5;$i < 300;$i++){
			//	unset ($dados[$i]);//elimina menu, lista etc...
			//}
			
			
			 

			foreach($dados as $d){
				
				$link = str_get_html($d[1]);
				$link = $link->find('a');
				
				$this->link = 'http://magiccards.info'.$link[0]->href;
				$this->numero = strip_tags($d[0]);
				$informacoes = $this->pega_informacoes($this->link);

				$this->descricao = $informacoes['descricao'];
				$this->mana_convertida = $informacoes['mana_convertida'];
				$this->texto = $informacoes['texto'];
				$this->lealdade = $informacoes['lealdade'];
				$this->legalidade = $informacoes['legalidade'];
				$this->regras = $informacoes['regras'];
				$this->ataque = $informacoes['ataque'];
				$this->tipos = $informacoes['tipos'];
				$this->resistencia = $informacoes['resistencia'];
				$this->nome = strip_tags($d[1]);
				$this->mana = strip_tags($d[3]);
				$this->raridade = strip_tags($d[4]);
				$this->artista = strip_tags($d[5]);
				$this->edicao = $this->preg_trim(strip_tags($d[6]));
				$this->imagem_src = 'http://magiccards.info/scans/'.$this->idioma.'/'.$this->sigla_edicao.'/'.$this->numero.'.jpg';
				$this->imagem_local = $this->sigla_edicao.'/'.$this->idioma.'/'.$this->numero.'.jpg';
				
						
				$cartas['cartas'][$this->numero]['numero'] = 			(int)$this->numero;	
				$cartas['cartas'][$this->numero]['sigla_edicao'] = 		(string)$this->sigla_edicao;	
				$cartas['cartas'][$this->numero]['edicao'] = 			(string)trim($this->edicao);	
				$cartas['cartas'][$this->numero]['cod'] = 				(int)$this->numero.$this->sigla_edicao.$this->idioma;
				$cartas['cartas'][$this->numero]['idioma'] = 			(string)$this->idioma;
				$cartas['cartas'][$this->numero]['nome'] = 				(string)$this->nome;	
				$cartas['cartas'][$this->numero]['ataque'] = 			(string)$this->ataque;
				$cartas['cartas'][$this->numero]['resistencia'] = 		(string)$this->resistencia;
				$cartas['cartas'][$this->numero]['lealdade'] = 			(string)$this->lealdade;
				$cartas['cartas'][$this->numero]['mana'] = 				(string)$this->mana;
				$cartas['cartas'][$this->numero]['mana_convertida'] = 	(string)$this->mana_convertida;
				$cartas['cartas'][$this->numero]['raridade'] = 			(string)$this->raridade;
				$cartas['cartas'][$this->numero]['artista'] = 			(string)$this->artista;
				$cartas['cartas'][$this->numero]['link'] = 				(string)$this->link;
				$cartas['cartas'][$this->numero]['imagem_src'] = 		(string)$this->imagem_src;
				$cartas['cartas'][$this->numero]['imagem_local'] = 		(string)$this->imagem_local;
				$cartas['cartas'][$this->numero]['descricao'] = 		(string)$this->descricao;
				$cartas['cartas'][$this->numero]['texto'] = 			(string)$this->texto;
				$cartas['cartas'][$this->numero]['tipos'] = 			(array)$this->tipos;
				$cartas['cartas'][$this->numero]['legalidade'] = 		(array)$this->legalidade;	
				$cartas['cartas'][$this->numero]['regras'] = 			(array)$this->regras;
				
				
			}

			$edicao['nome'] = trim($this->edicao); 
			$edicao['sigla'] = $this->sigla_edicao;
			$edicao['idioma'] = $this->idioma;
			$edicao['qtd_cartas'] = count($cartas['cartas']);

			$this->cartas->inserir_cartas($cartas['cartas']);
			$this->edicoes->inserir_edicao($edicao);

			$html->clear();
			unset($html);
			unset($rows);
			unset($dados);
			$fp = fopen('public/jsons/'.strtoupper($this->sigla_edicao)."_".$this->idioma.".json", "w");
			fwrite($fp, json_encode($cartas));
			fclose($fp);
			return $cartas;
	
	}
	
	private function pega_informacoes($url){
	
			$html = file_get_html($url);
		
			$ataque = '';
			$resistencia = '';
			$lealdade = '';
			$tipos = '';
			$retorno['lealdade'] = '';
			$retorno['ataque'] = '';
			$retorno['resistencia'] = '';
			$retorno['tipos'] = '';
			$retorno['mana_convertida'] = '';
			$retorno['regras'] = '';
			$retorno['legalidade'] = '';
			
			$mana_c = $html->find('p');
			//verificar antes
			$mana_c = @$mana_c[0]->plaintext;
			if(strpos($mana_c,')')){
				$mana_c  = explode(',',$mana_c);
				$mana_c = $mana_c[1];
				$mana_c = explode('(',$mana_c);
				if(isset($mana_c[1]))
					$mana_c = explode(')',$mana_c[1]);
				$mana_convertida = $mana_c[0];
				if(isset($mana_convertida))
				$retorno['mana_convertida'] = $mana_convertida;
			}
			
			
			
			
			$descricao = $html->find('p > b');
			$descricao = array_reverse($descricao);
			
			unset($descricao[0]);
			
			$descricao = array_reverse($descricao);
			if(isset($descricao[0]))
			$descricao = $descricao[0]->plaintext;
			//verificar antes
			if(strpos(@$descricao,'Missing')){
				$descricao = $html->find('.otext');
				$descricao = $descricao[0]->plaintext;
			}
			
			$texto = $html->find('p > i');
			if(isset($texto[0]))
			$texto = $texto[0]->plaintext;
			
			$regras = $html->find('ul > li');
			
			if(isset($regras[0])){
				$i = 0;
				foreach($regras as $r){
					if(strpos($r->plaintext,':')){
						
						$str = explode(':',$r->plaintext);
						$data = $str[0];
						$texto_r = $str[1];
						
						$reg[$i]['data'] = $data;
						$reg[$i]['texto'] = $texto_r;
						++$i;
					}else{
						$ret[] = $r->plaintext;	
					}
				}
			}
			if(isset($descricao))
			$retorno['descricao'] = $descricao;
			if(isset($texto))
			$retorno['texto'] = $texto;
			if(isset($reg))
			$retorno['regras'] = $reg;
			if(isset($ret))
			$retorno['legalidade'] = $ret;
			
			
			
			$descricao = $html->find('p');
			//verificar antes 
			$descricao = trim(@$descricao[0]->plaintext);
			if(strpos($descricao,'Missing')){
				$url  = str_replace('pt','en',$url);
				$url  = str_replace('de','en',$url);
				$url  = str_replace('fr','en',$url);
				$url  = str_replace('it','en',$url);
				$url  = str_replace('es','en',$url);
				$url  = str_replace('jp','en',$url);
				$url  = str_replace('cn','en',$url);
				$url  = str_replace('ru','en',$url);
				$url  = str_replace('tw','en',$url);
				$url  = str_replace('ko','en',$url);
				//echo $url;
				$html = file_get_html($url);
				$descricao = $html->find('p');
				$descricao = trim($descricao[0]->plaintext);
			}
			
			
			
			$descricao = explode(',',$descricao);

			//tricks for DE
			if($this->idioma == 'de')
				$tipoDE = @$descricao[1];
			


			$descricao = $descricao[0];
			$at = explode(' ',$descricao);
			$at = array_reverse($at);

			if(strpos( $at[0],'/')){
				
				$atqres = explode('/',$at[0]);	
				$ataque = $atqres[0];			
				$resistencia = $atqres[1];
				$retorno['ataque'] = $ataque;
				$retorno['resistencia'] = $resistencia;
				unset($at[0]);
				
			}
			
			
					
					
			if(strpos($descricao,'—')  || strpos($descricao,':') || strpos($descricao,'―') || strpos($descricao, '～')  || strpos($descricao,'/')){
				
				$pontos = explode(' ',$descricao);

				$pontos = array_reverse($pontos);
				
				if(strpos( $pontos[0],'/')){
					$atqres = explode('/',$pontos[0]);
					
					$ataque = $atqres[0];
					$resistencia = $atqres[1];
					$retorno['ataque'] = $ataque;
					$retorno['resistencia'] = $resistencia;
					unset($pontos[0]);
				}else{
					if(strpos($descricao,')')){
						$lealdade = explode(')',$pontos[0]);
						$retorno['lealdade'] = $lealdade[0];
						unset($pontos[0]);
						unset($pontos[1]);
					}
				
				}





				//tricks for DE
				if($this->idioma == 'de'){
					$tipoDE = explode(' ', $tipoDE);
					if(isset($tipoDE[1]) && $tipoDE[1] != null && $tipoDE[1] != '' ){
						$tipoDE = $tipoDE[1];
						$pontos[] = $tipoDE;
					}
				}

				//tricks for JP
				if($this->idioma == 'jp'){
					foreach ($pontos as $key => $value) {
						if(strpos($value, "・")){
							$tipoJP = explode('・', $value);
							unset($pontos[$key]);
							foreach ($tipoJP as $k => $v) {
								$pontos[] = $v;
							}

						}

					}
				}

				//tricks for CN and TW
				if($this->idioma == 'cn' || $this->idioma == 'tw'){
					foreach ($pontos as $key => $value) {
						if(strpos($value, "～")){
							$tipoCN = explode('～', $value);
							unset($pontos[$key]);
							foreach ($tipoCN as $k => $v) {
								$pontos[] = $v;
							}

						}
					}

					foreach ($pontos as $key => $value) {
						if(strpos($value, "／")){
							$tipoCN = explode('／', $value);
							unset($pontos[$key]);
							foreach ($tipoCN as $k => $v) {
								$pontos[] = $v;
							}

						}
					}
				}

				
				

				$pontos = array_flip($pontos);
				
				unset($pontos['—']);
				unset($pontos['—']);
				unset($pontos['―']);//japones apesar do caracter ser extramente parecido a codificação é outra, por isso precisa dar unset neste caracter tbm
				unset($pontos[':']);//frances usa : em vez de —
				
				$pontos = array_flip($pontos);
				
				foreach ($pontos as $key => $value) {
					if($value == 'et' || $value == ':' || $value == '(Loyalty:' || strpos($value, ')'))
						unset($pontos[$key]);
				}

				/*if($this->contador == $this->uri->segment(5)){
					echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
					print_r($pontos);
					//print_r($pontos);
					die();
				}
				
				$this->contador++;
				*/
				
				
				

				
				foreach($pontos as $p){
					$tipos[] = $p;
					$retorno['tipos'] = $tipos;
				}
				
			}else{
				$tipos = explode(' ',$descricao);
				$retorno['tipos'] = $tipos;
			}
			
			if(!isset($tipos) || count($tipos) == 0){
				$tipos[] = 'verificar';
				$retorno['tipos'] = $tipos;
			
			}
			
			
			
			
			$html->clear();
			unset($html);
			unset($regras);
			unset($descricao);
			unset($texto);
			return $retorno;
	}
		
	private function preg_trim( $string) {
		return preg_replace('/\s+/', ' ', $string);
    }
	
	
	
	
	
	private function prettyPrint( $json )
	{
		$result = '';
		$level = 0;
		$prev_char = '';
		$in_quotes = false;
		$ends_line_level = NULL;
		$json_length = strlen( $json );

		for( $i = 0; $i < $json_length; $i++ ) {
			$char = $json[$i];
			$new_line_level = NULL;
			$post = "";
			if( $ends_line_level !== NULL ) {
				$new_line_level = $ends_line_level;
				$ends_line_level = NULL;
			}
			if( $char === '"' && $prev_char != '\\' ) {
				$in_quotes = !$in_quotes;
			} else if( ! $in_quotes ) {
				switch( $char ) {
					case '}': case ']':
						$level--;
						$ends_line_level = NULL;
						$new_line_level = $level;
						break;

					case '{': case '[':
						$level++;
					case ',':
						$ends_line_level = $level;
						break;

					case ':':
						$post = " ";
						break;

					case " ": case "\t": case "\n": case "\r":
						$char = "";
						$ends_line_level = $new_line_level;
						$new_line_level = NULL;
						break;
				}
			}
			if( $new_line_level !== NULL ) {
				$result .= "\n".str_repeat( "\t", $new_line_level );
			}
			$result .= $char.$post;
			$prev_char = $char;
		}

		return $result;
	}
	
	
	
	
	
	
	public function simu(){
		
			$this->contador = 1;
			$start = microtime(true);
			
			$this->url = 'http://magiccards.info/'.$this->segments(2).'/'.$this->segments(3).'.html';
			
			$this->idioma = explode('/',$this->url);
			$this->sigla_edicao = strip_tags($this->idioma[3]);
			$this->idioma = explode('.',$this->idioma[4]);
			$this->idioma = strip_tags($this->idioma[0]);
			$retorno = $this->getList();
			$retorno = json_encode($retorno);
		
			echo "<meta charset=\"utf-8\"><pre>";
			$time_taken = (microtime(true) - $start) / 60;
			echo $time_taken.' - Tempo de execução.<br><br><br>';
			echo $this->prettyPrint($retorno);
			
		
	}
	
	
	
}