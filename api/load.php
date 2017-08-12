<?php
include_once '../dependency/dba.php';
class api{

//$api= $_GET['q'];
//@type string    
protected $table;
//@type string;    
public $query='';
//@type array;    
private $apiResults='';
    public function __construct($table=null){
$this->table=$table;    
$this->query= "SELECT * FROM `$this->table`";
           
    }
    public function getJason(){
        $jason=json_encode($this->api);
        return $jason; 
        
    }
    public function getResults(){
        return $this->apiResults;
        
    }
    public function runQuery(){
        #ESTABLISH DATABASE ADAPTER
        if(!is_null($this->table)){
	#unset($dbAdapter);unset($dbc);unset($db);
        $container=array();
        $Adapter= @new dbAdapter('lockf0rc_generation',$this->query,$container);
        $this->apiResults=$Adapter->getResults();
    
        }
      }
  }

?>

<?php
$table= $_GET['table'];
$object = new api($table);
$object->runQuery();
print_r($object->getResults());
$object->query='SELECT * FROM `products`';
$object->runQuery();
print_r($object->getResults());

?>
