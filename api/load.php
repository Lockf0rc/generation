<?php
include_once '../dependency/dba.php';
include_once 'api.php';
include_once 'PhpStringShortener.php';

$hash = isset($_GET['hash']) ? $_GET['hash'] : null;

$query = isset($_GET['query']) ? $_GET['query'] : null;

$clientQuery =function($q){
	
	$query =urldecode(base62_decode($q));
        $object = new api($query);
        header('Content-type: application/json');
        echo	$object->getJason();
};

if ($query !== null) {
	$clientQuery($query);
}
?>
