<?php
session_start();
if(!empty($_COOKIE['user_name'])&&!empty($_COOKIE['user_id'])){
  //is ok do nothing

}else{// redirect
    header("Location: cookie.php");
    die();
}
include_once '../dependency/dba.php';

#CREATE TEMPLATE FOR INSERTING EQUIPMENT
?>
<?php
#ESTABLISH DATABASE QUERY FROM TABLE
$query= "SELECT * FROM `equipment`";
$Equipment=array();
$Adapter= @new dbAdapter('lockf0rc_generation',$query,$Equipment);
$Equipment=$Adapter->getResults();
#debug print_r($Equipment);
?>

<?php for($i=0,$k=count($Equipment);$i<$k;$i++):?>
	<?php if((($Equipment[$i]['isCheckedOut'])&&($_COOKIE['user_id']==$Equipment[$i]['user_id']))||(isset($_SESSION['is_admin_login']))):?>
	<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="heading" >
	  <h4 class="panel-title">
		 <a>
			Check In Items
			<span class="label label-default"><i class="fa fa-user-o" ><?=$_COOKIE['user_name'];?></i></span>
		 </a>
		</h4>
	  </div>
	<div>
	 <div class="panel-body">
	 <ul class="list-group">
			<h4><?=$Equipment[$i]['group_name'];?>
					  <li class="list-group-item">
						<div class="row">
			<div class="col-xs-4 col-md-4">
			<div class="row">
			<div class="switch">  
			<input name="item[]" id="cmn-toggle-<?=$i?>" class="cmn-toggle cmn-toggle-round" value="<?=$Equipment[$i]['id_name'];?>" type=checkbox <?=(!$Equipment[$i]['isCheckedOut'])?"checked disabled":"unchecked";?>>
			<label for="cmn-toggle-<?=$i?>"></label>
			</div><!-- /switch -->
			</div><!-- /row -->	
			</div><!-- /col-xs-6 col-md-4 -->	
			 <div class="col-xs-8 col-md-8">
				
				<div class="row">
						
						<a  class="thumbnail">
						<img src="<?=$Equipment[$i]['image_link'];?>" alt="<?=$Equipment[$i]['id_name']?>" >
					   </a>
					 
				<?=$Equipment[$i]['description'];?>
				</div><!-- /row -->	 
			</div>
			</div><!-- /row -->	
			</li>
		</h4>	
			</div><!-- /row -->	
		</ul>
	</div><!-- /panel-body -->	
	</div><!-- /collapesGroupName -->
  	
	<?php endif;?>
<?php endfor;?>
