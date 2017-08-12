<?php
include_once '../dependency/dba.php';
include_once 'api.php';


$query="SELECT * FROM `users`";
$object = new api($query);

print_r($object->getResults());
$object->setQuery('SELECT * FROM `equipment`');

print_r($object->getResults());

?>
