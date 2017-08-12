<?php
include_once '../api/api.php';
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<?php
$itemcode=$_GET['ic'];
	if(isset($itemcode)){
	$query="SELECT * FROM `general_inventory` WHERE item_code=$itemcode";
	$object=new api($query);
	
	$item=$object->getResults();
print_r($item);
	}

?>
<?php
//After Clicking Submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$q=$_POST['q'];
	$newQuantity= intval($item[0]['quantity'])+intval($q);
	$query="UPDATE `general_inventory` SET quantity=$newQuantity WHERE item_code='$itemcode' ";
	$obj=new api($query);
	$obj->runQuery();


}

?>

<div class="container content">
<form method="post" action=<?=$_SERVER['PHP_SELF']?> >
	<div class="panel-group">
	<h5><?=(isset($item[0][item_name]))?$item[0]['item_name']:'ITEM_NAME'?></h5>
	<p>ADD ITEM</p><p>ITEM COUNT: <?= $item[0]['quantity'] ?></p>
	<lable>Quantity</lable><input id='q'  name="q" type="number"></input>
	
	<br>
	<br>
	<button type="submit" class="btn btn-default">Submit</button>
	</div> 
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">

<script type="text/javascript"> 

 $(document).ready(function(){
	alert('testing');
	$('#mybtn').on('click',function(){
	alert('testing');
	});
});
</script>
</div>
</body>
</html>
