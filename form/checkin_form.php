<?php
#DATABASE CONNECTION
#INHERITED WHEN INCLUDED IN FILE
?>
<?php
 
#######################
//PROCESS FORM ON SUBMIT
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&(isset($_POST['item']))){
   $filename = 'history.csv';
   
   if (isset($_COOKIE['user_id'])&&isset($_COOKIE['user_name'])) {
   $user_id=$_COOKIE['user_id'];
   $user_name=$_COOKIE['user_name'];
   }else{
   $user_id='';
   $user_name='';
   }

   $dateStamp=date("Y-m-d h:i A");	
  $itemsChecked= implode(',', $_POST['item']);	
unset($dbAdapter);
unset($dbc);
unset($db);
$Results=array();
$itemsCheckedOut= "('".implode("','",$_POST['item'])."')";
$query= "UPDATE ClientState SET isCheckedOut=0,user_id='',user_name='',time='' WHERE EQ_ID IN $itemsCheckedOut";
##DEBUG echo $query;

$dbAdapter= @new dbAdapter('lockf0rc_generation',$query,$Results);
######################################################################

$list = array
(
 array("$user_name","CHECK-IN:$itemsChecked","$dateStamp")
);

$file = fopen("$filename","a");

foreach ($list as $fields)
  {
  fputcsv($file,$fields);
  }
fclose($file);
// FORMATING CHECK-IN TABLE
    $tablefm='<table class="success table table-striped">
  <tr>
    <th>USER</th>
    <th>ITEMS</th>		
   <th>TIME_STAMP</th>
  </tr>
%s
</table>';

    $tr='<tr>
	<td>%s</td><td>%s</td><td>%s</td>
</tr>';

 //BINDING TABLE TO BOOTSTRAP PANEL
    $pn=new \bootstrap\panel("panel-primary","ITEMS CHECKED BACK IN",sprintf($tablefm,sprintf($tr,$_COOKIE['user_name'],$itemsChecked,$dateStamp)));
    echo $pn;

  // debug print_r($list);
   }
   ?>