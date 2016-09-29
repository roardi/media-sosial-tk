<?php
	session_start();
	include("connection.php");
	include("function.php");
	
	$userid = $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v3.0.0.39952
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Information</title>
    <meta name="description" content="Description" />
    <meta name="keywords" content="Keywords" />


    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->
</head>
<body>
<div class="art-post">

		<div class="art-post-inner art-article">
			<div class="art-block">
			<div class="art-block-tl"></div>
			<div class="art-block-tr"></div>
			<div class="art-block-bl"></div>
			<div class="art-block-br"></div>
			<div class="art-block-tc"></div>
			<div class="art-block-bc"></div>
			<div class="art-block-cl"></div>
			<div class="art-block-cr"></div>
			<div class="art-block-cc"></div>
			<div class="art-block-body">
						<div class="art-blockheader">
							<div class="l"></div>
							<div class="r"></div>
							<h3 class="t">Personal Information<a href=""><img src="images/del.jpg" style="padding-left:150px;  margin-top: 4px;"></a></h3>
						</div>
						<div class="art-blockcontent">
							<div class="art-blockcontent-body">
							<h2 class="art-postheader">
							</h2>
						<div class="cleared"></div>
							<div>
								
								<form method="post" action="">
									<?php
									$member_id = $_SESSION['member_id'];
									$post = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$userid'")or die(mysqli_error());
									$row = mysqli_fetch_array($post); 
									?>
									<p>&nbsp;&nbsp;Name: &nbsp;<strong><?php echo $row['firstname']." ".$row['lastname'];?>&nbsp;&nbsp;</strong> </p>
									<p>&nbsp;&nbsp;Address:&nbsp; <strong><?php echo $row['address'];?></strong>&nbsp;&nbsp;</p>
									<p>&nbsp;&nbsp;Age:&nbsp;<strong></strong>	&nbsp;&nbsp;</p>
									<p>&nbsp;&nbsp;Gender: <strong>&nbsp; <?php echo $row['gender'];?> </strong>&nbsp;&nbsp;</p>
									<p>&nbsp;&nbsp;Birthdate: <strong>&nbsp; <?php echo $row['birthdate'];?> </strong> &nbsp;&nbsp;</p>
									<br>
									<br>
									<br>
									<br>
									<?php 
									$sql = mysqli_query ($con,"SELECT * FROM friends WHERE (member_id = '$userid' OR friends_with = '$userid') AND status = 'c'")or die(mysqli_error());
									$num_rows = mysqli_num_rows ($sql);
									if ($num_rows==0){
									?>
										<p>&nbsp;&nbsp;Do you want <?php echo $row['firstname'];?> to be your friend?</p>
										<?php
										$id = $row['member_id'];
										?>
										<p>&nbsp;&nbsp;<a href="addfriend.php?id=<?php $row['member_id']; ?>" rel="facebox" style="text-decoration:none;">Add as Friend</a></p>
									<?php
									} else {}
									?>
									</form>
								
								<br />
							</div>
							<div class="cleared"></div>
							</div>
						</div>
				<div class="cleared"></div>
			</div>
		</div>
             
        <div class="cleared"></div>
		</div>

		<div class="cleared"></div>
	
</div>
</body>
</html>
