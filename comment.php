<?php
	session_start();
	include("connection.php");
	include("function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v3.0.0.39952
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>New Page</title>
    <meta name="description" content="Description" />
    <meta name="keywords" content="Keywords" />
	
	<script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
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
							<h3 class="t"></h3>
						</div>
						<div>
							<div class="art-blockcontent-body">
							<h2 class="art-postheader">
							</h2>
							<div>
								<?php 
				
									$postid = $_GET['id'];
									$post = mysqli_query($con,"SELECT * FROM posts WHERE post_id = '$postid'")or die(mysqli_error());
									$row = mysqli_fetch_array($post);
										$id = $row['member_id'];
										$hu_u = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$id'")or die(mysqli_error());
										$rows = mysqli_fetch_array($hu_u);
											echo "<div class='postcontainer'>
													<div class='picofjoke2'><img src='image/members/".$rows['photo']."' width='40' height ='40' align='center' alt=''/><br>".$rows['firstname']." ".$rows['lastname']."
													</div>
														<div class = 'postconte'>
														".$row['posts']."<br><br>
														<div class='last'>
															<strong>Last</strong> ".$row['date']."
															<br>
														</div>
													</div>
												</div>";
								?>
								<div id="angry">
								<?php 
									echo "<hr/><strong>Comments</strong><hr/>";
									$postid = $_GET['id'];
									$post = mysqli_query($con,"SELECT * FROM postcomments WHERE postid = '$postid'")or die(mysqli_error());
									$member_id = $_SESSION['member_id'];
									echo "<table>";
									while($row = mysqli_fetch_array($post)){
										$id = $row['memberid'];
										$member_id = $_SESSION['member_id']; 
										$hu_u = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$id'")or die(mysqli_error());
										$rows = mysqli_fetch_array($hu_u);
										echo "<tr><td><div>
												<div class='picofjoke3'><img src='image/members/".$rows['photo']."' width='30' height ='30' align='center' alt=''/>&nbsp;&nbsp;".$rows['firstname']." ".$rows['lastname']."<br></div>
												<div class = 'postconte2'>".$row['comment']."<br><br>
												<strong>Last</strong> ".$row['date']."";
										if($id==$member_id){
											echo "<div style='float:right;'><a href='deletepostcommenthome.php?post_id=".$row['postcommentid']."' style='text-decoration:none;' >Delete</a></div>
											<hr />";
										}else{
											echo "<hr/>";
										}
											
										echo "</div></div>";
										echo "</tr></td>";
									}
									echo "</table>";
								?>
								<form method='post' action=''>
									<input type='hidden' name='ucantseeme' value='<?php echo $postid; ?>' />
									<textarea style='float:right;' name='textarea' cols='70' rows='3'></textarea><br />
									<input id='comment' style='float:right;' type='submit'  name='comment' value='Comment'/>
								</form>
							</div>
							<div class="cleared"></div>
							</div>
						</div>
				<div class="cleared"></div>
			</div>
		</div>
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
<script type='text/javascript'>
	jQuery(document).ready( function() {
			jQuery('.comm').hide();
		jQuery('#showcoms').click( function() {
			jQuery('.comm').toggle('fade');
		});
			
			jQuery(".notif").click( function() {
				var id = $(this).attr("id");
				
				jQuery.ajax({
					type: "POST",
					data: ({id: id}),
					url: "bidupdate.php",
					success: function(response) {
					jQuery(".id" + id).hide();
					jQuery("#num_result").fadeIn().html(response);
					}
				});
				
			})
	});
</script>