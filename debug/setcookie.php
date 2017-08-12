<?php
// set the cookies https://video.search.yahoo.com/yhs/search;_ylt=A86.JycEalxZknYAocMnnIlQ?p=php7+cookies&fr=yhs-mozilla-002&fr2=piv-web&hspart=mozilla&hsimp=yhs-002#id=2&vid=c9cca3dd36092b8682f95fe571ddb6ce&action=view
$name=$_GET['name'];
$value=$_GET['value'];
setcookie($_GET['name'],$_GET['value'],time() - 86400*30*12);




?>