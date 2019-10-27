<?php
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
		echo "Fiche RNCP  : ".$_GET["rncp"]."<br>";
		echo "Bloc n°  : ".$_GET["bloc"]."<br>";
		break;

	case "" :
		//404 - not found;
		break;
}
?>
