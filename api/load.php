<?php
include_once '../dependency/dba.php';
include_once 'api.php';

$client =function(){
$query =urldecode($_GET['query']);


$object = new api($query);
header('Content-type: application/json');
print_r($object->getJason());
};

$client();

?>
