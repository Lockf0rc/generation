<?php
session_start();
// set the cookies https://video.search.yahoo.com/yhs/search;_ylt=A86.JycEalxZknYAocMnnIlQ?p=php7+cookies&fr=yhs-mozilla-002&fr2=piv-web&hspart=mozilla&hsimp=yhs-002#id=2&vid=c9cca3dd36092b8682f95fe571ddb6ce&action=view
if ((!empty($_COOKIE['user_id']))&&(!empty($_COOKIE['user_name']))) {
	//redirects  if cookie is active
	if ((!empty($_COOKIE['user_id']))){
	  header("Location: run.php");
	  die();
	}
}

// After Clicking Submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $posted_user_id =$_POST['user_id'];
	#PATH INHERITED BY cookie.php/dependency/dba.php
	include_once 'dependency/dba.php';
	unset($dbAdapter);
	unset($dbc);
	unset($db);
	unset($Adapter);
	#ESTABLISH DATABASE QUERY FROM TABLE
	$query= "SELECT * FROM `users` WHERE `user_id`=$posted_user_id";
	$USER=array();
	$Adapter= @new dbAdapter('lockf0rc_generation',$query,$USER);
	$USER=$Adapter->getResults();
	##############
	##SETS COOKIE
  $user_name=(!null==$USER[0]['user_name'])?$USER[0]['user_name']:false;
  if($user_name){
  setcookie("user_id", "{$USER[0]['user_id']}", time() + 86400 * 30);
  setcookie("user_name", "{$USER[0]['user_name']}", time() + 86400 * 30);
   header('location: ' . $_SERVER['PHP_SELF']);
  }
}
include_once  'dependency/registry.php';

?>
<style>


</style>
 <a href="admin/login.php" class="btn btn-default"><button type="button" class="btn btn-primary btn-sm" >Admin Login</button></a>
 <h2>USER LOGIN</h2>
  <form id="myForm" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-log-in"></i></span>
   <input class="form-control" placeholder="ENTER PIN ****" type="password" name="user_id" pattern="[0-9]{4}" maxlength="4" >
  </div>
    <br>
   <button type="submit" class="btn btn-default btn-block">Submit</button>
</form>
<?php echo (!empty($_COOKIE['user_id']))?
'<a href="run.php"><button type="button" class="btn btn-default btn-lg">
  <span class="glyphicon glyphicon-task" aria-hidden="true">Double Click</span>
</button></a>':"";?>
