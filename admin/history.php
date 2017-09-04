<?php
session_start();
include_once '../dependency/registry.php';
if(empty($_SESSION['is_admin_login'])){
    header("Location: login.php");
    die();
}
?>
<a href="list.php" class="btn btn-default"><button type="button" class="btn btn-primary btn-sm" >CURRENT DATABASE</button></a>
	 <a href="../delete_cookie.php" class="btn btn-default"><button type="button" class="btn btn-primary btn-sm" ><i class="fa fa-user-o" aria-hidden="true"></i>
		<i class="glyphicon glyphicon-log-out">LOG_OUT</i></button>
	</a>
<body>

<div class="container content">
 <div class="page-space">
<?php
if (($handle = fopen("../history.csv", "r")) !== FALSE) {
	$results=array();
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        for ($c=0,$num = count($data); $c < $num; $c++) {
            $results[]=$data[$c];
        }
    }
    fclose($handle);
}?>
<div class="jumbotron">
  <h1>EQUIPMENT LOG</h1>
  </div>
	<table class="success table table-striped table-condensed table-bordered">
	   <thead>
		  <tr>

                         <th>TIME_STAMP</th>
                	  <th>ITEMS</th>
			  <th>USER</th>

		   </tr>
	   </thead>
	<?php for($i=0,$num = count($results); $i < $num; $i+=3):?>
	<tr>
		<td><?=$results[$i]?></td><td><?=$results[$i+1]?></td><td><?=$results[$i+2]?></td>
	</tr> 
	<?php endfor;?>
	</table>
  </div>
</div>
</body>
