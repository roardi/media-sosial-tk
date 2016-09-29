<?php
  require ("connection.php");  
?>  
	
<?php
	$gpc_id =$_GET['gpc_id'];
	$gid = $_GET['gid'];
	mysqli_query($con,"DELETE FROM grouppostcomments WHERE gpc_id = '$gpc_id'")
	or die(mysqli_error());  	
	header("Location: groups.php?id=".$gid);
?>