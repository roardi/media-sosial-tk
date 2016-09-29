<?php
  require ("connection.php");  
?>  
	
<?php
	$id =$_GET['id'];
	$group_id = $_GET['gid'];
	mysqli_query($con,"DELETE FROM groupposts WHERE grouppost_id = '$id'")
	or die(mysqli_error());  
		
	header("Location: groups.php?id=".$group_id);
?>