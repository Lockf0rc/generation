<?php

$root=dirname(dirname(dirname(dirname(__FILE__))));
$Path_to_bin = $root."/generationapps_bin";

require "$Path_to_bin".'/PHP/Registry.php';
Registry::set('~',"$Path_to_bin");
Registry::set('LINK',
    '
     <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
	 <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
     <link rel="stylesheet" href="vendor/switch/css/style.css">
     <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css">-->
     <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">		
     <link rel="stylesheet" href="vendor/bootswatch/paper-style.css">
     <!-- jqueryui -->
     	
     <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>	
'
);
Registry::set('BOOTSTRAPCDN','<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css">');
#Registry::set('BOOTSTRAPCDN','');

Registry::set('STYLE','
*{  body {
      position: relative;
  }

  }
  div.col-sm-9 div {
      height: 250px;
      font-size: 28px;
	  }
	  div.page-space{
		  top: 100px;
	  }}');
Registry::set('TITLE','EQUIPMENT CHECKOUT');
include_once ("$Path_to_bin".'/SQL/dbAdapter.php');
include_once "$Path_to_bin".'/PHP/Inc/STD_HD.inc.php';

$dir_r=scandir("$Path_to_bin".'/PHP/bootstrap',1);
$dir= array_pop($dir_r);
$dir= array_pop($dir_r);
foreach($dir_r as $bootstrapOBJ){
    include_once "$Path_to_bin".'/PHP/bootstrap'.'/'."$bootstrapOBJ";
    echo " <!--[include]bootstrap/$bootstrapOBJ -->\n";
}


?>