<?php
  require ("connection.php");  
?>  
	
<?php
	$post_id =$_REQUEST['post_id'];
	$id=$_GET['id'];
	mysqli_query($con,"DELETE FROM posts WHERE post_id = '$post_id'")
	or die(mysqli_error());
	//echo $id;
	header("Location: userprofiletest.php?id=".$id);
?>