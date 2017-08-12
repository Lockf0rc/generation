<?php
session_start();
if(isset($_SESSION['is_admin_login'])){
    header("Location: list.php");
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once '../dependency/registry.php';
    $query= "SELECT * FROM `admin`
ORDER BY `admin`.`user` ASC";
    $Results=array();
    $Adapter= new dbAdapter('lockf0rc_generation',$query,$Results);
    if(($_POST['user']==$Results['user'])and($_POST['pass']==$Results['pass'])){
        $_SESSION['is_admin_login']=true;
		 # setcookie("user_id", "0000", time() + 86400 * 30,'/');
		 # setcookie("user_name", "Admin_User", time() + 86400 * 30,'/');
        if($_SESSION['is_admin_login']){
            header("Location: list.php");
            die();
        }

    }else{
        echo '<p class="alert danger">USERNAME OR PASSWORD IS INCORRECT</p>';
    }
}
?>
<?php
include_once  '../dependency/registry.php';

?>
    <h1>USER LOGIN</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-log-in"></i></span>
            <input id="tag" maxlength="10" class="form-control" type="text" name="user" placeholder="username" value="" id="u"  />
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-asterisk"></i></span>
            <input id="tag" maxlength="10" type="password" class="form-control" type="text" name="pass" placeholder="password" value="" id="u"  />
        </div>
        <br>
        <button type="submit" class="btn btn-default">double click</button>
    </form>
