<?php
require_once("SimpleRest.php");
require_once("Block.php");
		
class BlockRestHandler extends SimpleRest {


	function getAllblocks($rncp) {	

		$bloc = new Block();
		$rawData = $bloc->getAllBlocks($rncp);
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No blocks found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}
	}
	
	public function encodeHtml($responseData) {
	
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><bloc></bloc>');
		$i = 0;
		foreach($responseData as $key=>$value) {
			$numero = $xml->addChild($i++);
			$numero->addChild("Titre",$key);
			$numero->addChild("Description", $value);
		}
		return $xml->asXML();
	}
	
	public function getBlock($id) {

		$block = new Block();
		$rawData = $block->getBlock($id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No blocks found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}
	}
}
?>