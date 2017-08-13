
<?php
#ESTABLISH DATABASE QUERY FROM TABLE
$query=$_GET['query'];

$query=urlencode($query);
$path="http://68.116.41.126:314/api/load.php?query=$query";

$json = file_get_contents($path);
$Products=json_decode($json,true);


?>
<ul class="list-group">
<?php foreach($Products as $i=>$item):?>
		<li class="list-group-item" >
				
				<span class="switch">
					<h3><?=$item['ItemName']?></h3>  
				<input name="item[]" id="cmn-toggle-<?=$i?>" class="cmn-toggle cmn-toggle-round" value="<?=$item['EQ_ID'];?>" type=checkbox >
				<label for="cmn-toggle-<?=$i?>"></label>
					<span for="SN">SN:# <?=$item['SN']?><span>
					<span for="Identifier">Identifier:<?=$item['Identifier']?><span>
					<p>Manufacture: <?=$item['Manufacture']?><p>
					<p>Catagory: <?=$item['Catagory']?><p>
					<p>Description: <?=$item['Description'];?></p>
				</span><!-- /switch -->
			<?php if($item['Image_url'] !== ""):?>
				<a  class="thumbnail">
					<img src="<?=$item['Image_url'];?>" alt="<?=$item['EQ_ID']?>" >
				</a>
			<?php endif;?>	
		
	 
			
		</li>
	
<?php endforeach;?>
</ul>