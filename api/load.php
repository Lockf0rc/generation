<?php
include_once '../dependency/dba.php';
include_once 'api.php';
include_once 'PhpStringShortener.php';

function base62_decode($hash){
	
	$phpSS = new PhpStringShortener();
	#print_r($phpSS->getStringByHash($hash));
            $encoded64_string = $phpSS->getStringByHash($hash);
	return $encoded64_string;
}
function base62_encode($string){
            $phpSS = new PhpStringShortener();
            $hash = $phpSS->addHashByString($string);
	return $hash;
}

$client =function(){
$query =base64_decode(base62_decode($_GET['query']));
echo $query;

$object = new api($query);
header('Content-type: application/json');
print_r($object->getJason());
};

$client();

?>
