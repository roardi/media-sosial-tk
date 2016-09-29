<?php
  require ("connection.php");  
?>  
	
<?php
	$id =$_GET['post_id'];
	mysqli_query($con,"DELETE FROM postcomments WHERE postcommentid = '$id'")
	or die(mysqli_error());  	
	header("Location: hometest.php");
?>