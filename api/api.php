<?php
include_once '../dependency/dba.php';
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
?>
