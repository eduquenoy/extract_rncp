<?php
/* 
A domain Class to demonstrate RESTful web services
*/
Class Block {
	
		
	/*
		you should hookup the DAO here
	*/
	public function getAllBlocks($rncp){
		$url="https://certificationprofessionnelle.fr/recherche/rncp/".$rncp."#ancre3";
		//echo "URL : ".$url."<br>";
		echo "Résultat : <br>";
		$timeout = 10;
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

		if (preg_match('`^https://`i', $url)){
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		}

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Récupération du contenu retourné par la requête
		$page = curl_exec($ch);

		curl_close($ch);
		//$numero_rncp="24533";
		preg_match_all("#RNCP".$rncp."BC\d\d<br\/><br\/>(.*)<\/td>#",$page,$titre);
		//print_r($titre);
		preg_match_all('#RNCP'.$rncp.'BC(.*)<\/td>[[:cntrl:]](.*)<p(.*)>(.*)<\/p>#',$page,$contenu);
		//print_r($contenu[]);
		$blocks = array();
		for($i=0;$i<8;$i++){
			$blocks[rtrim(html_entity_decode($titre[1][$i]))] = rtrim(ltrim(html_entity_decode($contenu[4][$i]),"•"));
		//echo "Titre : ".$blocs[0][$i]." Contenu : ".$blocs[1][$i]."<br>";
		}
		print_r($blocks);
	return($blocks);
}


/*	public function getAllBlocks($rncp){
		return $this->blocs;
	}
*/	
	public function getBlock($rncp,$id){
		
		$blocks = $this->getAllBlocks($rncp);
		$titles = array_keys($blocks);
		$descriptions = array_values($blocks);
		$block[$titles[$id]] = $descriptions[$id];
		return $block;
	}	
}
?>