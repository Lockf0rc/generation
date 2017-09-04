<?php
session_start();
##NESTING ACCORDIONS http://jsfiddle.net/hqL7rz9p/
include_once '../dependency/dba.php';
include_once '../dependency/registry.php';
#CREATE TEMPLATE FOR INSERTING EQUIPMENT
if(empty($_SESSION['is_admin_login'])){
    header("Location: login.php");
    die();
}
?>
<?php
#ESTABLISH DATABASE QUERY FROM TABLE
$query=" SELECT * FROM `Products` p INNER JOIN ClientState s ON p.EQ_ID = s.EQ_ID WHERE s.isCheckedout=1 ORDER BY time DESC, user_name";
$Equipment=array();
$Adapter= @new dbAdapter('lockf0rc_generation',$query,$Equipment);
$Equipment=$Adapter->getResults();

?>
<a href="history.php" class="btn btn-default"><button type="button" class="btn btn-primary btn-sm" >VIEW HISTORY LOG</button></a>
	 <a href="../delete_cookie.php" class="btn btn-default"><button type="button" class="btn btn-primary btn-sm" ><i class="fa fa-user-o" aria-hidden="true"></i>
		<i class="glyphicon glyphicon-log-out">LOG_OUT</i></button>
	</a>
	
	 
<body>

<div class="container content">
 <div class="page-space">

<div class="jumbotron">
  <h1>All Items Checkeout</h1>
  </div>
	<table class="success table table-striped table-condensed table-bordered">
	   <thead>
		  <tr>
			 <th>TIME</th>
			 <th>EQ_ID</th>
			 <th>SN</th>
			 <th>DESCRIPTION</th>
			 <th>ITEM_NAME</th>
			 <th>IDENTIFIER</th>	
			 <th>MANUFACTUER</th>
			 <th>CATAGORY</th>
			 <th>USER</th>
		   </tr>
	   </thead>
	<?php for($i=0,$num = count($Equipment); $i < $num; $i+=1):?>
	<tr>
		<td><?=$Equipment[$i]['time']?></td>
		<td><?=$Equipment[$i]['EQ_ID']?></td>
		<td><?=$Equipment[$i]['SN']?></td>
		<td><?=$Equipment[$i]['Description']?></td>
		<td><?=$Equipment[$i]['ItemName']?></td>
		<td><?=$Equipment[$i]['Identifier']?></td>
		<td><?=$Equipment[$i]['Manufacture']?></td>
		<td><?=$Equipment[$i]['Catagory']?></td>
		<td><?=$Equipment[$i]['user_name']?></td>
		
	</tr> 
	<?php endfor;?>
	</table>
  </div>
</div>
</body>
