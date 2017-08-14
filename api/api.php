<?php
include_once ('../dependency/dba.php');
include_once ('PhpStringShortener.php');
class api{
//@type string    

//@type string;    
private $query='';
//@type array;    
private $apiResults='DEFALT';
    public function __construct($query=null){
    
	$this->query=$query;
           
    }
#	@return string
    public function getJason(){
	$this->runQuery();
        $jason=json_encode($this->apiResults);
        return $jason; 
        
    }
#	@return void
    public function setQuery($query){
	$this->query=$query;
    }
#	@return array	
    public function getResults(){
	 $this->runQuery();
        return $this->apiResults;
        
    }
#	@return void
    public function runQuery(){
        
        if(!is_null($this->query)){
	$container=array();
        $Adapter= @new dbAdapter('lockf0rc_generation',$this->query,$container);
        $this->apiResults=$Adapter->getResults();
        }
    }
  }

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


?>
