<?php  if ( ! defined('SYSTEM')) exit('No direct script access allowed');



function converte_mana($m,$tudo = true){
		$mana = $m;
		$mana = str_replace('{WP}', "<span class=\"mana-wp\"> </span>", $mana);
		$mana = str_replace('{UP}', "<span class=\"mana-up\"> </span>", $mana);
		$mana = str_replace('{BP}', "<span class=\"mana-bp\"> </span>", $mana);
		$mana = str_replace('{RP}', "<span class=\"mana-rp\"> </span>", $mana);
		$mana = str_replace('{GP}', "<span class=\"mana-gp\"> </span>", $mana);
		
		$mana = str_replace('{2/W}', "<span class=\"mana-2w\"> </span>", $mana);
		$mana = str_replace('{2/U}', "<span class=\"mana-2u\"> </span>", $mana);
		$mana = str_replace('{2/B}', "<span class=\"mana-2b\"> </span>", $mana);
		$mana = str_replace('{2/R}', "<span class=\"mana-2r\"> </span>", $mana);
		$mana = str_replace('{2/G}', "<span class=\"mana-2g\"> </span>", $mana);
		
		$mana = str_replace('{W/U}', "<span class=\"mana-wu\"> </span>", $mana);
		$mana = str_replace('{U/B}', "<span class=\"mana-ub\"> </span>", $mana);
		$mana = str_replace('{B/R}', "<span class=\"mana-br\"> </span>", $mana);
		$mana = str_replace('{R/G}', "<span class=\"mana-rg\"> </span>", $mana);
		$mana = str_replace('{G/W}', "<span class=\"mana-gw\"> </span>", $mana);
		
		$mana = str_replace('{U/W}', "<span class=\"mana-wu\"> </span>", $mana);
		$mana = str_replace('{B/U}', "<span class=\"mana-ub\"> </span>", $mana);
		$mana = str_replace('{R/B}', "<span class=\"mana-br\"> </span>", $mana);
		$mana = str_replace('{G/R}', "<span class=\"mana-rg\"> </span>", $mana);
		$mana = str_replace('{W/G}', "<span class=\"mana-gw\"> </span>", $mana);
		
		$mana = str_replace('{W/B}', "<span class=\"mana-wb\"> </span>", $mana);
		$mana = str_replace('{B/G}', "<span class=\"mana-bg\"> </span>", $mana);
		$mana = str_replace('{G/U}', "<span class=\"mana-gu\"> </span>", $mana);
		$mana = str_replace('{U/R}', "<span class=\"mana-ur\"> </span>", $mana);
		$mana = str_replace('{R/W}', "<span class=\"mana-rw\"> </span>", $mana);
		
		
		$mana = str_replace('{B/W}', "<span class=\"mana-wb\"> </span>", $mana);
		$mana = str_replace('{G/B}', "<span class=\"mana-bg\"> </span>", $mana);
		$mana = str_replace('{U/G}', "<span class=\"mana-gu\"> </span>", $mana);
		$mana = str_replace('{R/U}', "<span class=\"mana-ur\"> </span>", $mana);
		$mana = str_replace('{W/R}', "<span class=\"mana-rw\"> </span>", $mana);
		
		
		$mana = str_replace('{X}',"<span class=\"mana-x\"> </span>", $mana);
		$mana = str_replace('{Y}', "<span class=\"mana-y\"> </span>", $mana);
		$mana = str_replace('{Q}', "<span class=\"mana-q\"> </span>", $mana);
		$mana = str_replace('{T}', "<span class=\"mana-t\"> </span>", $mana);
		$mana = str_replace('{S}', "<span class=\"mana-s\"> </span>", $mana);
		
		if($tudo){
			$mana = str_replace('X', "<span class=\"mana-x\"> </span>", $mana);
			$mana = str_replace('Y', "<span class=\"mana-y\"> </span>", $mana);
		}
		
		$mana = str_replace('{U}', "<span class=\"mana-u\"> </span>", $mana);
		$mana = str_replace('{G}', "<span class=\"mana-g\"> </span>", $mana);
		$mana = str_replace('{B}', "<span class=\"mana-b\"> </span>", $mana);
		$mana = str_replace('{W}', "<span class=\"mana-w\"> </span>", $mana);
		$mana = str_replace('{R}', "<span class=\"mana-r\"> </span>", $mana);
		
		$mana = str_replace('{0}', "<span class=\"mana-0\"> </span>", $mana);
		$mana = str_replace('{1}', "<span class=\"mana-1\"> </span>", $mana);
		$mana = str_replace('{2}', "<span class=\"mana-2\"> </span>", $mana);
		$mana = str_replace('{3}', "<span class=\"mana-3\"> </span>", $mana);
		$mana = str_replace('{4}', "<span class=\"mana-4\"> </span>", $mana);
		$mana = str_replace('{5}', "<span class=\"mana-5\"> </span>", $mana);
		$mana = str_replace('{6}', "<span class=\"mana-6\"> </span>", $mana);
		$mana = str_replace('{7}', "<span class=\"mana-7\"> </span>", $mana);
		$mana = str_replace('{8}', "<span class=\"mana-8\"> </span>", $mana);
		$mana = str_replace('{9}', "<span class=\"mana-9\"> </span>", $mana);
		$mana = str_replace('{10}', "<span class=\"mana-10\"> </span>", $mana);
		$mana = str_replace('{11}', "<span class=\"mana-11\"> </span>", $mana);
		$mana = str_replace('{12}', "<span class=\"mana-12\"> </span>", $mana);
		$mana = str_replace('{13}', "<span class=\"mana-13\"> </span>", $mana);
		$mana = str_replace('{14}', "<span class=\"mana-14\"> </span>", $mana);
		$mana = str_replace('{15}', "<span class=\"mana-15\"> </span>", $mana);
		$mana = str_replace('{16}', "<span class=\"mana-16\"> </span>", $mana);
		$mana = str_replace('{17}', "<span class=\"mana-17\"> </span>", $mana);
		$mana = str_replace('{18}', "<span class=\"mana-18\"> </span>", $mana);
		$mana = str_replace('{19}', "<span class=\"mana-19\"> </span>", $mana);
		$mana = str_replace('{20}', "<span class=\"mana-20\"> </span>", $mana);
		
		if($tudo){
			$mana = str_replace('U', "<span class=\"mana-u\"> </span>", $mana);
			$mana = str_replace('G', "<span class=\"mana-g\"> </span>", $mana);
			$mana = str_replace('B', "<span class=\"mana-b\"> </span>", $mana);
			$mana = str_replace('W', "<span class=\"mana-w\"> </span>", $mana);
			$mana = str_replace('R', "<span class=\"mana-r\"> </span>", $mana);
		}
		
		if($tudo){
			for($i=0; $i<=20;$i++ ){
				$mana = str_replace($i, "<span class=\"mana-".$i."\"> </span>", $mana);
			}
		}

		return $mana;
	}
	

