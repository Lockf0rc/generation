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
$sql = "SELECT * FROM `Products` INNER JOIN `ClientState` ON `Products`.`EQ_ID` = `ClientState`.`EQ_ID`";
$Equipment=array();
$Adapter= @new dbAdapter('lockf0rc_generation',$sql,$Equipment);
$Equipment=$Adapter->getResults();
#debug print_r($Equipment);
?>

<?php for($i=0,$k=count($Equipment);$i<$k;$i++):?>
	<?php if((($Equipment[$i]['isCheckedOut'])&&($_COOKIE['user_id']==$Equipment[$i]['user_id']))||(isset($_SESSION['is_admin_login']))):?>
	<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="heading" >
	  <h4 class="panel-title">
		 <a>
			
			<span class="label label-default"><i class="fa fa-user-o" ><?=$_COOKIE['user_name'];?></i></span>
			<?=$Equipment[$i]['ItemName'];?>
		 </a>
		
	  </div>
	<div>
	 <div class="panel-body">
	 <ul class="list-group">
		<li class="list-group-item" >
			
					 
						
			
			<div class="switch">  
			<input name="item[]" id="cmn-toggle-<?=$i?>" class="cmn-toggle cmn-toggle-round" value="<?=$Equipment[$i]['EQ_ID'];?>" type=checkbox <?=(!$Equipment[$i]['isCheckedOut'])?"checked disabled":"unchecked";?>>
			<label for="cmn-toggle-<?=$i?>"></label>
			</div><!-- /switch -->
			
				
				<div class="row">
					<span for="SN">SN:# <?=$Equipment[$i]['SN']?><span>
					<span for="Identifier">Identifier:<?=$Equipment[$i]['Identifier']?><span>
					<p>Manufacture: <?=$Equipment[$i]['Manufacture']?><p>
					<p>Catagory: <?=$Equipment[$i]['Catagory']?><p>
					<p>Description: <?=$Equipment[$i]['Description'];?></p>	
			<?php if($Equipment[$i]['Image_url'] !== ""):?>
				<a  class="thumbnail">
					<img src="<?=$Equipment[$i]['Image_url'];?>" alt="<?=$Equipment[$i]['EQ_ID']?>" >
				</a>
			<?php endif;?>
		</li><!--li.list-group-->	
				
	 </ul>
	</div><!-- /panel-body -->	
	</div><!-- /collapesGroupName -->
  	
	<?php endif;?>
<?php endfor;?>
