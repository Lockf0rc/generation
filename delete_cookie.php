<?php
// set the cookies https://video.search.yahoo.com/yhs/search;_ylt=A86.JycEalxZknYAocMnnIlQ?p=php7+cookies&fr=yhs-mozilla-002&fr2=piv-web&hspart=mozilla&hsimp=yhs-002#id=2&vid=c9cca3dd36092b8682f95fe571ddb6ce&action=view
session_start();

if ((!empty($_COOKIE['user_id'])||!empty($_COOKIE['user_name']))||isset($_SESSION['is_admin_login'])){
    setcookie("user_id",null,time() - 86400*30*12);
    setcookie("user_name",null,time() - 86400*30*12);
	unset($_SESSION['is_admin_login']);
		session_destroy();
	
     header("Location: cookie.php");
    die();
}else{
	 header("Location: cookie.php");
    die();
}


?>