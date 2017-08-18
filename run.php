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
.jumbotron{
background-color:rgb(39, 39, 39);
color:white;
}
.big{

  padding: 20.5px 15px;
  font-size: 17px;
  
  height: 64px;
}
.scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
}
</style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class=" container-fluid">
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
           
             <li  class="dropdown ">
              <a href="#" class="dropdown-toggle big" data-toggle="dropdown" role="button">Select Equipment<span class="caret"></span></a>
              <ul style="" class="dropdown-menu scrollable-menu">
		  <?php foreach ($Manufactures as $i=>$m): ;?><?php $q1=base62_encode("SELECT * From `Products` WHERE Manufacture='{$m['Manufacture']}'");?>   
                <li><a class="big" href="<?="{$_SERVER['PHP_SELF']}?query=$q1"?>"><h5><?=$m['Manufacture'];?></h5></a></li>
					<ul >	
					<?php foreach($menu[$i] as $c ):?><!-- nested 1foreach --><?php $q2=base62_encode("Select * From `Products` WHERE Manufacture='{$m['Manufacture']}' AND Catagory='{$c['Catagory']}'");?>
				         <li><a class="nav-link big" href="<?="{$_SERVER['PHP_SELF']}?query=$q2";?>"><?=$c['Catagory'];?></a></li>				              
					<?php endforeach;?><!-- (nested 1)end foreach Catagory in Manufacture -->
					</ul> 
         	 <?php endforeach;?><!--end foreach Manufacture -->
              </ul><!--ul.dropdown-menu -->
            </li><!--li.dropdown -->
	   <li class="dropdown">
              <a href="#" class="dropdown-toggle big " data-toggle="dropdown" role="button">Catagory<span class="caret"></span></a>
              <ul class="dropdown-menu ">
 		<?php foreach ($Catagorys as $i=>$c): ;?><?php $q3=base62_encode("Select * From `Products` WHERE Catagory='{$c['Catagory']}'");?>  	
                <li><a class="nav-link" href="<?="{$_SERVER['PHP_SELF']}?query=$q3";?>"><h5><?=$c['Catagory'];?></h5></a></li>
               <?php endforeach;?><!--end foreach Catagory-->
	      </ul><!--ul.dropdown-menu-->
	  </li><!--li.dropdown -->

          </ul><!--ul.dropdown-menu-->
          <ul class="nav navbar-nav navbar-right">
           <li class="active"><a class="nav-link" href="checkin.php"><i class="fa fa-user-o" aria-hidden="true"><?=$user_name;?>&nbsp;</i></a></li>
          </ul><!--ul.nav navbar-nav navbar-right-->
        </div><!--div#myNavbar-->
 </nav><!--nav.navbar navbar-inverse navbar-fixed-top--> 

 
	<br>
	<br>
     <?php
     $jb= new \bootstrap\jumbotron('<h1>Equipment Checkout</h1>');
     echo $jb;
 ?>
<div class="page-space">
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
 $('#PRODUCTS').load("data/load_equipment.php?<?=$_SERVER['QUERY_STRING'];?>");
//alert('<?=$_SERVER['QUERY_STRING'];?>');
 });
 $("form").submit(function(){
	 $('#PRODUCTS').load('data/load_equipment.php');
 });
   
 $('.dropdown-submenu>a').unbind('click').click(function(e){
 $(this).next('ul').toggle();
		e.stopPropagation();
		e.preventDefault();
 });	
});
//https://www.bootply.com/D2wTP855IG

</script>
<html>
