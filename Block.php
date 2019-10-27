<?php
/* 
A domain Class to demonstrate RESTful web services
*/
Class Block {
	
	private $blocs = array(
		1 => 'Apple iPhone 6S',  
		2 => 'Samsung Galaxy S6',  
		3 => 'Apple iPhone 6S Plus',  			
		4 => 'LG G4',  			
		5 => 'Samsung Galaxy S6 edge',  
		6 => 'OnePlus 2',
		7 => '',
		8 => '');
		
	/*
		you should hookup the DAO here
	*/
	public function getAllBlocks($rncp){
		$url="https://certificationprofessionnelle.fr/recherche/rncp/".$rncp."#ancre3";
		//echo "URL : ".$url."<br>";
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
		preg_match_all('#RNCP'.$rncp.'BC(.*)<\/td>[[:cntrl:]](.*)<p(.*)>(.*)<\/p>#',$page,$contenu);
	//$reponse= "<table><tr><td>Titre</td><td>Description</td></tr>";
	//$reponse = $reponse. "<tr>";
		$blocs = array();
		for($i=0;$i<8;$i++){
		//$reponse= $reponse."<td>".$titre[1][$i]."</td>";
		//$reponse= $reponse."<td>".$contenu[4][$i]."</td></tr>";
			/*$blocs[0][$i] = $titre[1][$i];
			$blocs[1][$i] = $contenu[4][$i];*/
			//$blocs[$titre[1][$i]] = $contenu[4][$i];
			$blocs[html_entity_decode($titre[1][$i])] = ltrim(html_entity_decode($contenu[4][$i]),"•");
		//echo "Titre : ".$blocs[0][$i]." Contenu : ".$blocs[1][$i]."<br>";
		}
//var_dump($blocs);
	return($blocs);
}


/*	public function getAllBlocks($rncp){
		return $this->blocs;
	}
*/	
	public function getBlock($id){
		
		$bloc = array($id => ($this->blocks[$id]) ? $this->blocks[$id] : $this->blocks[1]);
		return $mobile;
	}	
}
?>