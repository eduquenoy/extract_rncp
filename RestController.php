<?php

/* Test d'un webservice d'extraction des blocs de compétences à partir des fiches RNCP du site https://certificationprofessionnelle.fr/

	Usage : {url}/rncp/blocs/{n°fiche rcnp}

	Téléchargement sur https://github.com/eduquenoy/extract_rncp

	D'après https://phppot.com/php/php-restful-web-service/ 
	*/

require_once("BlockRestHandler.php");
		
//echo "Hello<br>";
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "all":
		// to handle REST Url /blocks/list/
		$rncp = $_GET["rncp"];
		//echo "Fiche RNCP  : ".$rncp."<br>";
		$blockRestHandler = new BlockRestHandler();
		$blockRestHandler->getAllblocks($rncp);
		
		break;
		
	case "single":
		// to handle REST Url /mobile/show/<id>/
		//$mobileRestHandler = new MobileRestHandler();
		//$mobileRestHandler->getMobile($_GET["id"]);
		$rncp = $_GET["rncp"];
		$block = $_GET["bloc"];
//		echo "Fiche RNCP  : ".$_GET["rncp"]."<br>";
//		echo "Bloc n°  : ".$_GET["bloc"]."<br>";
		$blockRestHandler = new BlockRestHandler();
		$blockRestHandler->getBlock($rncp,$block);
		break;

	case "" :
		//404 - not found;
		break;
}
?>
