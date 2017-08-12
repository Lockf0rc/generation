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
   if(isset($_SESSION['is_admin_login'])){
	  $user_id='0000';
	$user_name='Admin_user'; 
   }else{
	$user_id=$_COOKIE['user_id'];
   $user_name=$_COOKIE['user_name'];
   }
?>
<style>

</style>

<body>
<div class="container content">	
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Generation<span class="sub-brand">&nbsp;&copy;2017</a>
    </div>
	
	<div class="navbar-collapse collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="delete_cookie.php"><i class="fa fa-user-o" aria-hidden="true"></i><?=$user_name?>&nbsp;<i class="glyphicon glyphicon-log-out">LOG-OUT</i></a></li>
            <li><a href="checkin.php"><i class="glyphicon glyphicon-list-alt">ItemsCheckedOut</i></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Equipment<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">ITEM1</a></li>
                <li><a href="#">ITEM2</a></li>
                <li><a href="#">ITEM3</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Contact</a></li>
            <li class="active"><a href="#">Fixed top <span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
 </nav>  

 <div class="page-space">
     <?php
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
