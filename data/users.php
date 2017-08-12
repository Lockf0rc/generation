
#PATH INHERITED BY cookie.php/
include_once 'dependency/dba.php';


#CREATE TEMPLATE FOR INSERTING EQUIPMENT
#ESTABLISH DATABASE QUERY FROM TABLE
$query= "SELECT * FROM `users` WHERE user_id=$user_id";
$USER=array();
$Adapter= @new dbAdapter('lockf0rc_generation',$query,$USER);
$USER=$Adapter->getResults();
#debug
print_r($USER);
