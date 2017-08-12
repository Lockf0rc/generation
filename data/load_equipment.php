<?php
##NESTING ACCORDIONS http://jsfiddle.net/hqL7rz9p/
include_once '../dependency/dba.php';
#phpnet str-replace user wes foster
include_once '../dependency/str_replace_assoc.php';
#CREATE TEMPLATE FOR INSERTING EQUIPMENT
?>
<?php
#ESTABLISH DATABASE QUERY FROM TABLE
$query= "SELECT * FROM `equipment`ORDER BY  group_name ASC";
$Equipment=array();
$Adapter= @new dbAdapter('lockf0rc_generation',$query,$Equipment);
$Equipment=$Adapter->getResults();

?>

<?php 

for($i=0,$k=count($Equipment);$i<$k;$i++){	
#isgroupNameEqual is used to determin if the next item is the same group name

		if(($i+1)<$k){
		$isgroupNameEqual[]=($Equipment[$i]['group_name']==$Equipment[$i+1]['group_name'])?true:false;
		}
	
}

#since we need to loop twice for every true the offset help in a wile logic statement($isgroupNameEqual[$i]||$isnextgroupNameEqual[$i-1])
#when loop for $i and $i-1
#then we apend false to correct the offset in the end of loop and to halt on last element
$isgroupNameEqual[]=false;

?>

<?php for($i=0,$k=count($Equipment);$i<$k;$i++):?>
  <?php if(!$isgroupNameEqual[$i]){?>
	<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="heading" >
	   <h4 class="panel-title"  >
		 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?=str_replace(' ','_',$Equipment[$i]['group_name']);?>" aria-expanded="false" aria-controls="<?=str_replace(' ','_',$Equipment[$i]['group_name']);?>">
			<?=$Equipment[$i]['group_name'];?>
			<span  class="label label-default"><i data-toggle="tooltip" data-placement="left" title="User" class="fa fa-user-o" aria-hidden="true"><?=(!empty($Equipment[$i]['user_name']))?$Equipment[$i]['user_name']:"";?></i></span>
		 </a>
		</h4>
	  </div><!-- /panel-heading -->
	<div id="<?=str_replace(' ','_',$Equipment[$i]['group_name']);?>" class="panel-collapse collapse <?=($Equipment[$i]['isCheckedOut'])?"":"in";?>" role="tabpanel" aria-labelledby="heading">
	 <div class="panel-body">
			<div class="row">
			<div class="col-xs-4 col-md-4">
			<div class="row">
			<div class="switch">
			<input name="item[]" id="cmn-toggle-<?=$i?>" class="cmn-toggle cmn-toggle-round" value="<?=$Equipment[$i]['id_name'];?>" type=checkbox <?=($Equipment[$i]['isCheckedOut'])?"checked disabled":"unchecked";?>>
			<label for="cmn-toggle-<?=$i?>"></label>
			</div><!-- /switch -->
			</div><!-- /row -->	
			</div><!-- /col-xs-6 col-md-4 -->	
			 <div class="col-xs-8 col-md-8">
				
				<div class="row">
						
						<a  class="thumbnail">
						<img  src="<?=$Equipment[$i]['image_link'];?>" alt="<?=$Equipment[$i]['id_name']?>" >
					   </a>
					 
				<?=$Equipment[$i]['description'];?>
				</div><!-- /row -->	 
			</div>
			</div><!-- /row -->	
	</div><!-- /panel-body -->	
	</div><!-- /collapesGroupName -->
	<?php }else{?>
	<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="heading" >
	  <h4 class="panel-title"  >
		 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?=str_replace(' ','_',$Equipment[$i]['group_name']);?>" aria-expanded="false" aria-controls="<?=str_replace(' ','_',$Equipment[$i]['group_name']);?>">
			<?=$Equipment[$i]['group_name'];?>
		 </a>
		</h4>
	  </div><!-- /panel-heading -->
	<div id="<?=str_replace(' ','_',$Equipment[$i]['group_name']);?>" class="panel-collapse collapse <?=($Equipment[$i]['isCheckedOut'])?"":"in";?>" role="tabpanel" aria-labelledby="heading">
	 <div class="panel-body">
	 <ul class="list-group">
	 <h6>
<!-- Here we insert another nested accordion -->	
	<?php while($isgroupNameEqual[$i]||$isgroupNameEqual[$i-1]){?>
	 <?php#debug'$isgroupNameEqual[$i]||$isnextgroupNameEqual[$i]='."$isgroupNameEqual[$i]||$isnextgroupNameEqual[$i]::$i"
	 ?>
  <li class="list-group-item">
<span  class="label label-default"><i data-toggle="tooltip" data-placement="left" title="User" class="fa fa-user-o" aria-hidden="true"><?=(!empty($Equipment[$i]['user_name']))?$Equipment[$i]['user_name']:"";?></i></span>
						<div class="row">
			<div class="col-xs-4 col-md-4">
			<div class="row">
			<div class="switch">  
			<input name="item[]" id="cmn-toggle-<?=$i?>" class="cmn-toggle cmn-toggle-round" value="<?=$Equipment[$i]['id_name'];?>" type=checkbox <?=($Equipment[$i]['isCheckedOut'])?"checked disabled":"unchecked";?>>
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
	<?php $i++ ;}?>
	</h6>
	</ul>
<!-- Here we insert another nested accordion -->
	</div><!-- /panel-body -->	
	</div><!-- /collapesGroupName -->		

   <?php } ?> 
  	
<?php endfor;?>
