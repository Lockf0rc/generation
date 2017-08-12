<?php
// set the cookies https://video.search.yahoo.com/yhs/search;_ylt=A86.JycEalxZknYAocMnnIlQ?p=php7+cookies&fr=yhs-mozilla-002&fr2=piv-web&hspart=mozilla&hsimp=yhs-002#id=2&vid=c9cca3dd36092b8682f95fe571ddb6ce&action=view

//redirects  if cookie is active
if (isset($_COOKIE['user'])){
  header("Location: ../run.php");
  die();
}
//SETS COOKIE After Clicking Submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['u'];
  setcookie("user", "$username", time() + 86400 * 30);
}
include_once 'codeDependency.php';

?>
<h1>USER LOGIN</h1>
  <form method="post" action="<?=$_SERVER['PHP_SELF']?>" >
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-tags"></i></span>
  <input id="tag" class="form-control" type="text" name="u" placeholder="USER-ID" value="<?=isset($_COOKIE['user'])?$_COOKIE['user']:''?>" id="u"  />
</div>
    <br>
    <br>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
<?=isset($_COOKIE['user'])?
'<a href="run.php"><button type="button" class="btn btn-default btn-lg">
  <span class="glyphicon glyphicon-task" aria-hidden="true">Double Click</span>
</button></a>':"";?>

