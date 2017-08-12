<?php
#DATE:7/20/2017@12:34AM
if(empty($_COOKIE['user_name'])){
	    header("Location: cookie.php");
    die();
}
session_start();
if((isset($_COOKIE['user_name'])&&isset($_COOKIE['user_id']))||isset($_SESSION['is_admin_login'])){

  //is ok do nothing
}else{// redirect
    header("Location: cookie.php");
    die();
}
include_once 'dependency/registry.php';

date_default_timezone_set('America/Los_Angeles');
?>
<style>

</style>

<body>

<div class="container content">
 <div class="page-space">
     <?php

		   if(isset($_SESSION['is_admin_login'])){
			  $user_id='0000';
			$user_name='Admin_user'; 
		   }else{
			$user_id=$_COOKIE['user_id'];
		   $user_name=$_COOKIE['user_name'];
		   }
     echo '
	 <a href="delete_cookie.php" class="btn btn-default"><button type="button" class="btn btn-primary btn-sm" ><i class="fa fa-user-o" aria-hidden="true"></i>
'."$user_name 	&nbsp;".'<i class="glyphicon glyphicon-log-out">LOG_OUT</i></button></a>
		<a href="checkin.php" class="btn btn-default"><span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-list-alt">Items Checked Out</i></span></a>
	 ';
     $jb= new \bootstrap\jumbotron('<h1>Equipment Checkout</h1>');
     echo $jb;
 ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">	
<!-- LOAD_EQUIPMENT
load_equipment via jquery
-->	
 </div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Submit
</button>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm Checkout</h4>
      </div>
     <!-- <div class="modal-body">
        
      </div>-->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Close</button>
		<hr>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>

<?php include_once 'form/run_form.php';?>

</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<script type="text/javascript"> 
 $(document).ready(function(){
$('#accordion').load('data/load_equipment.php');
 });
 $("form").submit(function(){
	 $('#accordion').load('data/load_equipment.php');
   
	
 });


</script>
<html>