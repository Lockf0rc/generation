<?php
#######################
#DATABASE CONNECTION
#INHERITED WHEN INCLUDED IN FILE
##PROCESS FORM ON SUBMIT
if (($_SERVER['REQUEST_METHOD'] == 'POST')&&(isset($_POST['item']))){
	   if (isset($_COOKIE['user_name'])&&isset($_COOKIE['user_id'])) {
		   $user_id=$_COOKIE['user_id'];
		   $user_name=$_COOKIE['user_name'];
	   }else{
		 $user_id='';
		 $user_name='';
	   }
	$dateStamp=date("Y-m-d h:i A");	
	$itemsChecked= implode("','", $_POST['item']);$itemsCheckedOut= "('".$itemsChecked."')";   
	unset($dbAdapter);unset($dbc);unset($db);$Results=array();
	$query= "UPDATE ClientState SET isCheckedOut=1,user_id='$user_id',user_name='$user_name' ,time='$dateStamp' WHERE EQ_ID IN $itemsCheckedOut";
	#debug# echo $query;
	$dbAdapter= @new dbAdapter('lockf0rc_generation',$query,$Results);
######################################################################
    $filename = 'history.csv';
	$list = array
	(
	 array("$user_name","CHECK-OUT:$itemsChecked","$dateStamp")
	);
	// Open the file to get existing content
   $current=file_get_contents($filename);
   // Append a new person to the file
		foreach ($list as $fields)
		  {
		  $current.='"'.implode('","',$fields).'"'."\n";
		  }
	file_put_contents($filename, $current);
}
?>
<?php if(($_SERVER['REQUEST_METHOD'] == 'POST')&&(isset($_POST['item']))):?>
  		<table class="success table table-striped">
		<thead>
		  <tr>
			<th>USER</th>
			<th>ITEMS</th>		
		   <th>TIME_STAMP</th>
		  </tr>
		 </thead>
		 <tr>
			<td><?=$_COOKIE['user_name'];?></td><td><?=$itemsChecked;?></td><td><?=$dateStamp;?></td>
		</tr>
		</table>   
<?php endif;?>

 