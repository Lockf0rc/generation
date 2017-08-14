<?php

	if(empty($_COOKIE['user_name'])){
		    header("Location: cookie.php");
	    die();
	}

	session_start();
	if((isset($_COOKIE['user_name'])&&isset($_COOKIE['user_id']))||isset($_SESSION['is_admin_login'])){
		$user_id=$_COOKIE['user_id'];
   		$user_name=$_COOKIE['user_name'];
	}else{// redirect
	    header("Location: cookie.php");
	    die();
	}

$isUserAdmin=function(){
   if(isset($_SESSION['is_admin_login'])){
	  $user_id='0000';
	$user_name='Admin_user'; 
   }else{
	$user_id=$_COOKIE['user_id'];
   $user_name=$_COOKIE['user_name'];
   }
};
$get=function($query){
	$query=base62_encode($query);
	$path="http://68.116.41.126:314/api/load.php?query=$query";
	
	$json = file_get_contents($path);
	return json_decode($json,true);
};

$setDefaults=function(){date_default_timezone_set('America/Los_Angeles');};
$setDefaults();
#$isUserLogin();
$isUserAdmin();
include_once('dependency/registry.php');
include_once('api/api.php');


function getManufacture(){
$query="SELECT DISTINCT `Manufacture` FROM `Products`";
$object =new api($query);
#DEBUG print_r ($object->getResults());
return $object->getResults();
}

function getCatagory(){
$query="SELECT DISTINCT `Catagory` FROM `Products`";
$object =new api($query);
#DEBUG 	print_r ($object->getResults());
return $object->getResults();
}


$Manufactures=getManufacture();
$Catagorys=getCatagory();

	foreach($Manufactures as $i=>$m){
		$WHERE="SELECT DISTINCT `Catagory` FROM `Products` WHERE Manufacture='{$m['Manufacture']}'";
		$object =new api($WHERE);
	$menu[]=$object->getResults();
	}

#DEBUG#print_r($menu);

?>
<style>

</style>
</head>
<body>
<div class="container content">	
<nav class="navbar  navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
      </button>
	
      	<a class="navbar-brand" href="#">Generation<span class="sub-brand">&nbsp;&copy;2017</a>
    </div>
	<div id="myNavbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a class="nav-link" href="delete_cookie.php"><i class="glyphicon glyphicon-log-out">LogOut</i></a><li>
            <li><a class="nav-link" href="checkin.php"><i class="fa fa-user-o" aria-hidden="true"><?=$user_name;?>&nbsp;</i><i class="glyphicon glyphicon-list-alt">ItemsCheckedOut</i></a></li>
            <li class="dropdown ">
              <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button">Select Equipment<span class="caret"></span></a>
              <ul class="dropdown-menu">
		  <?php foreach ($Manufactures as $i=>$m): ;?><?php $q1=base62_encode("SELECT * From `Products` WHERE Manufacture='{$m['Manufacture']}'");?>   
                <li><a class="nav-link" href="<?="{$_SERVER['PHP_SELF']}?query=$q1"?>"><?=$m['Manufacture'];?></a></li>
					<ul class="sub-menu">	
					<?php foreach($menu[$i] as $c ):?><!-- nested 1foreach --><?php $q2=base62_encode("Select * From `Products` WHERE Manufacture='{$m['Manufacture']}' AND Catagory='{$c['Catagory']}'");?>
				         <li><a class="nav-link" href="<?="{$_SERVER['PHP_SELF']}?query=$q2";?>"><?=$c['Catagory'];?></a></li>				              
					<?php endforeach;?><!-- (nested 1)end foreach Catagory in Manufacture -->
					</ul> 
         	 <?php endforeach;?><!--end foreach Manufacture -->
              </ul><!--ul.dropdown-menu -->
            </li><!--li.dropdown -->
	   <li class="dropdown ">
              <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button">Catagory<span class="caret"></span></a>
              <ul class="dropdown-menu">
 		<?php foreach ($Catagorys as $i=>$c): ;?><?php $q3=base62_encode("Select * From `Products` WHERE Catagory='{$c['Catagory']}'");?>  	
                <li><a class="nav-link" href="<?="{$_SERVER['PHP_SELF']}?query=$q3";?>"><?=$c['Catagory'];?></a></li>
               <?php endforeach;?><!--end foreach Catagory-->
	      </ul><!--ul.dropdown-menu-->
	  </li><!--li.dropdown -->

          </ul><!--.dropdown-menu-->
          <ul class="nav navbar-nav navbar-right">
           <li class="active"><a href="#"><i class="fa fa-caret-square-o-up fa-3x" aria-hidden="true"></i> <span class="sr-only">(current)</span></a></li>
          </ul><!--ul.nav navbar-nav navbar-right-->
        </div><!--div#myNavbar-->
 </nav><!--nav.navbar navbar-inverse navbar-fixed-top--> 

 <div class="page-space">
     <?php
     $jb= new \bootstrap\jumbotron('<h1>Equipment Checkout</h1>');
     echo $jb;
 ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<div class="panel-group" id="PRODUCTS" role="tablist" aria-multiselectable="true">	
<!-- LOAD_EQUIPMENT load_equipment via jquery-->	
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
/*	
 $.get('api/load.php?query=All', function(data) {
			alert("filter with the dropdown");
			});
                    
                }, "json");
	
*/
$('#accordion').load("data/load_equipment.php?<?=$_SERVER['QUERY_STRING'];?>");
//alert('<?=$_SERVER['QUERY_STRING'];?>');
 });
 $("form").submit(function(){
	 $('#PRODUCTS').load('data/load_equipment.php');
   
	
 });


</script>
<html>
