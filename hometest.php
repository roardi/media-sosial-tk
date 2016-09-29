<?php
	session_start();
	include("connection.php");
	include("function.php");
	
	if($_SESSION['login'] == 'true'){
		include ("memberbar.php");
	}
	elseif($_SESSION['login'] == 'admin'){
		include("adminbar.php");
	}
	else{
		header("location:index.php");
	}
	$id = $_SESSION['member_id'];
		if(isset($_POST['share'])){
			$post = $_POST['textarea'];
			if ($post !="Click here.."){if ($post !=""){
			mysqli_query($con,"INSERT INTO posts(member_id,posts,date,post_to) VALUE ('$id','$post',NOW(),'$id')")or die(mysqli_error());}}
		}
		if(isset($_POST['comment'])){
			$comment = $_POST['textarea'];
			$postid = $_POST['ucantseeme'];
			if ($comment !=""){
			mysqli_query($con,"INSERT INTO postcomments(postid,memberid,date,comment) VALUE ('$postid','$id',NOW(),'$comment')")or die(mysqli_error());}
		}
?>

<div class="art-content-layout">
                <div class="art-content-layout-row">
                    <div class="art-layout-cell art-sidebar1">

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
                    <h3 class="t">Groups</h3>
                </div>
				<div class="art-blockcontent">
                    <div class="art-blockcontent-body">
					<ul>
							<?php
							
								$member_id=$_SESSION['member_id'];							
								$post1 = mysqli_query($con,"SELECT * FROM groupmembers WHERE member_id = '$member_id' AND status='1' ")or die(mysqli_error());
								
								$num_rows  =mysqli_num_rows($post1);
							
							if ($num_rows != 0 ){

								while($rows = mysqli_fetch_array($post1)){
				
								$mygroup = $rows['group_id'];
								//$member_id=$_SESSION['member_id'];
								
									/*if($mygroup == $member_id){
									
										$mygroup1 = $row['member_id'];
										$group = mysqli_query("SELECT * FROM group WHERE member_id = '$mygroup1'")or die(mysqli_error());
										$groupsa = mysqli_fetch_array($group);
									
									echo '<li> <a href=userprofiletest.php?id='.$groupsa["member_id"].' style="text-decoration:none;"><img src="image/members/'. $groupsa['photo'].'" height="50" width="50"><br>'.$groupsa['group_name'].' </a> </li>';
									}else*/{
										
										$group = mysqli_query($con,"SELECT * FROM groups WHERE group_id = '$mygroup'")or die(mysqli_error());
										$row = mysqli_fetch_array($group);
										
										echo '<li> <a href=groups.php?id='.$row["group_id"].' style = "text-decoration:none;"><img src="image/groups/'. $row['photo'].'" height="30" width="30" align="center">'.$row['group_name'].' </a></li>';
									}
								}
								}else{
									echo 'You don\'t have groups </li>';
								}
						
								
							?>
							</ul>
                                		<div class="cleared"></div>
                    </div>
                </div>
                <div class="art-blockheader">
                    <div class="l"></div>
                    <div class="r"></div>
                    <h3 class="t">Friends</h3>
                </div>
				
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
					<ul>
							<?php
							
								$member_id=$_SESSION['member_id'];							
								$post = mysqli_query($con,"SELECT * FROM friends WHERE (friends_with = '$member_id' OR member_id = '$member_id') AND status = 'c' ")or die(mysqli_error());
								
								$num_rows  =mysqli_num_rows($post);
							
							if ($num_rows != 0 ){

								while($row = mysqli_fetch_array($post)){
				
								$myfriend = $row['member_id'];
								$member_id=$_SESSION['member_id'];
								
									if($myfriend == $member_id){
									
										$myfriend1 = $row['friends_with'];
										$friends = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$myfriend1'")or die(mysqli_error());
										$friendsa = mysqli_fetch_array($friends);
									
										echo '<li> <a href=myfriendsprofile.php?id='.$friendsa["member_id"].' style="text-decoration:none;"><img src="image/members/'. $friendsa['photo'].'" height="30" width="30" align="center">'.$friendsa['firstname'].' '.$friendsa['lastname'].' </a> </li>';
									}else{
										$myfriend1 = $row['member_id'];
										$friends = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$myfriend1'")or die(mysqli_error());
										$friendsa = mysqli_fetch_array($friends);
										
										echo '<li> <a href=myfriendsprofile.php?id='.$friendsa["member_id"].' style = "text-decoration:none;"><img src="image/members/'. $friendsa['photo'].'" height="30" width="30" align="center">'.$friendsa['firstname'].' '.$friendsa['lastname'].' </a></li>';
									}
								}
								}else{
									echo 'You don\'t have friends </li>';
								}
						
								
							?>
							</ul>
                                		<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>
<?php
include ("knowfriends.php");
?>

                      <div class="cleared"></div>
                    </div>
                    <div class="art-layout-cell art-content">
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
							<h3 class="t">Share your thought</h3>
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
											$sql=mysqli_query($con,"SELECT * FROM members WHERE member_id='$member_id'") or die(mysqli_error());
											$getpic=mysqli_fetch_array($sql);
											$post = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$member_id'")or die(mysqli_error());
											$row = mysqli_fetch_array($post); 
											echo "<a href='userprofiletest.php?id=$member_id' style='text-decoration:none;'>".$row['firstname']." ".$row['lastname']."</a>"."<br />"."&nbsp;&nbsp;&nbsp;&nbsp;<img src='image/members/".$getpic['photo']."'width='70px' height='70px'>";
											
											
									?>
									
										<p align="left"><textarea name="textarea" style="align:center; width: 360px; height:70px; margin-left: 140px; margin-top: -90px;" onclick="this.value='';" >Click here..</textarea>
										
										<input  style="align:center; width: 80px; height: 36px; margin-left: 275px; margin-top: -15px;" type="submit" id="share" value="Share" name="share" /><br /></p>
								
								</form>
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
			<div class="art-block-body" style="width: 495px;">
						<div class="art-blockheader">
							<div class="l"></div>
							<div class="r"></div>
							<h3 class="t">Recent post</h3>
						</div>
						<div class="art-blockcontent">
							<div class="art-blockcontent-body">
							<h2 class="art-postheader">
							</h2>
						<div class="cleared"></div>
							<div>
							<?php	
										$member_id=$_SESSION['member_id'];
										$poster = mysqli_query($con,"SELECT * FROM posts WHERE member_id = '$member_id' ORDER by date DESC LIMIT 0,2")or die(mysqli_error());
										while($row = mysqli_fetch_array($poster)){
										$id = $row['member_id']; 
										$hu_u = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$id'")or die(mysqli_error());
										$rows = mysqli_fetch_array($hu_u);
										$iyaid = $row['post_id']; 
										$allcomm = mysqli_query($con,"SELECT * FROM postcomments WHERE postid = '$iyaid'")or die(mysqli_error());
											$counters = 0;
											WHILE($stat = mysqli_fetch_array($allcomm)){
											$counters++;
										}
										$allcount = $counters;
										
										$all_like = mysqli_query($con,"SELECT * FROM postlike WHERE postid = '$iyaid'")or die(mysqli_error());
											$counter = 0;
											WHILE($stat = mysqli_fetch_array($all_like)){
											$counter++;
										}
										$allcountlike = $counter;
										$postid = $row['post_id'];
										?>
										<input type='hidden' value='<?php echo $row['post_id'];?>' name='cantseeme'/>
										<div id="<?php echo $postid;?>">
											<div class='pcont'>
												<div class='picofjoke'>
													
													<a href="userprofiletest.php?id=<?php echo $id; ?>" style="text-decoration: none; align:left;"><img src='image/members/<?php echo $rows['photo'];?>' width='30' height ='30' align='center' alt=''/><br><?php echo $rows['firstname']." ".$rows['lastname'];?></a>
												</div>
												
												<div class = 'postcon'>
													
													<?php 
													echo $row['posts'];?><span style='font-size:12px;'>
													<strong><br /><br />Last </strong><?php echo $row['date'];?> <hr /><a href='seeall.php?id=<?php echo $row['post_id'];?>' rel='facebox' style='text-decoration:none;'><img src='image/thumbsup.jpg' width='20' height='15' align='center'></a>(<?php echo $allcountlike;?>)<a href='comment.php?id=<?php echo $row['post_id'];?>' rel='facebox' style='text-decoration:none;'>Comments(<?php echo $allcount;?>)</a></span>
												<?php
												if ($row['member_id'] == $_SESSION['member_id']){
												echo "
												<div style='float:right; margin-top:10px;'>
													<span><a href='deleteposthome.php?id=".$row['post_id']."' style='text-decoration:none;'>Delete
													</a></span>
												</div>";
												}else{
												echo "";
												// <div style='float:right;'>
													// <a href='#'>	Report
													// </a>
												// </div>";
												}
												?>
											</div>
										</div>
									</div>
									<?php }	
									
									$post = mysqli_query($con,"SELECT * FROM friends WHERE friends_with = '$member_id' OR member_id = '$member_id' AND status = 'c' ")or die(mysqli_error());
									
									while($row = mysqli_fetch_array($post)){
				
									$myfriend = $row['member_id'];
									$member_id=$_SESSION['member_id'];
								
									if($myfriend == $member_id){
									
									$myfriend1 = $row['friends_with'];
									
									}else{
									$myfriend1 = $row['member_id'];
									}
									
									
									$poster = mysqli_query($con,"SELECT * FROM posts WHERE member_id = '$myfriend1' ORDER by date DESC LIMIT 0,2")or die(mysqli_error());
									while($row = mysqli_fetch_array($poster)){
										$id = $row['member_id'];
										$hu_u = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$id'")or die(mysqli_error());
										$rows = mysqli_fetch_array($hu_u);
										$iyaid = $row['post_id'];
										$allcomm = mysqli_query($con,"SELECT * FROM postcomments WHERE postid = '$iyaid'")or die(mysqli_error());
											$counters = 0;
											WHILE($stat = mysqli_fetch_array($allcomm)){
											$counters++;
										}
										$allcount = $counters;
										
										$all_like = mysqli_query($con,"SELECT * FROM postlike WHERE postid = '$iyaid'")or die(mysqli_error());
											$counterss = 0;
											WHILE($stat = mysqli_fetch_array($all_like)){
											$counterss++;
										}
										$allcounts = $counterss;
										$postid = $row['post_id']
										?>
										<input type='hidden' value='<?php echo $row['post_id'];?>' name='cantseeme'/>
										<div id="<?php echo $postid;?>">
											<div class='pcont'>
												<div class='picofjoke'>
													
													<a href="myfriendsprofile.php?id=<?php echo $id; ?>" style="text-decoration: none;"><img src='image/members/<?php echo $rows['photo'];?>' width='30' height ='30' align='center' alt=''/><?php echo $rows['firstname']." ".$rows['lastname'];?></a>
												</div>
												
												<div class = 'postcon'>
													<br />
													<?php 
													echo $row['posts'];?><span style='font-size:12px;'><strong><br /><br />Last </strong><?php echo $row['date'];?> <hr /><a href='seeall.php?id=<?php echo $row['post_id'];?>' rel='facebox' style='text-decoration:none;'><img src='image/thumbsup.jpg' width='20' height='15' align='center'></a>(<?php echo $allcounts;?>)<a href='comment.php?id=<?php echo $row['post_id'];?>' rel='facebox' style='text-decoration:none;'>Comments(<?php echo $allcount;?>)</a></span>
												<?php
												if ($row['member_id'] == $_SESSION['member_id']){
												echo "
												<div style='float:right;'>
													<a href='deleteposthome.php?id=".$row['post_id']."'>	Delete
													</a>
												</div>";
												}else{
												echo "";
												}
												?>
											</div>
										</div>
									</div>
					<?php }}
					 ?>
					<script type="text/javascript">
		$(document).ready( function() {
				$(".comment").click( function() {
					var id = $(this).attr("id");
					var comment = $(".comment_txt" + id ).val();
					$('.daw_comment').slideDown().append(
					
					"<p>" + comment + "</p>"
					
					);
					// $(".comment_txt" + id ).val("");	
					
						jQuery.ajax({
							type: "POST",
							data: ({id: id, comment: comment}),
							url: "post_comment.php",
							success: function(response) {
							
							$(".comment_txt" + id ).val("")
							}
						});
				
				});
		
		});
		</script>								
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
			<div class="art-post-body">
			
			</div>
                      <div class="cleared"></div>
                    </div>
                    <div class="art-layout-cell art-sidebar2">
<?php
include ("find.php");
?>

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
                    <h3 class="t">Upcoming Events</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
						<script type="text/javascript" src="gallery2/js/jquery.js"></script>
<script type="text/javascript" src="gallery2/js/swfobject.js"></script>
<script type="text/javascript" src="gallery2/js/flashgallery.js"></script>
<script type="text/javascript">
jQuery.flashgallery('gallery2/gallery2.swf', 'gallery2/config.json', { width: '160px', height: '242px', background: 'transparent' });
</script>
					
                                		<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>

                      <div class="cleared"></div>
                    </div>
                </div>
            </div>
            <div class="cleared"></div>
            <?php
				include ("footer.php");
			?>
    		<div class="cleared"></div>
        </div>
    </div>
    <div class="cleared"></div>
 
</div>


</body>
</html>
<script type='text/javascript'>
			jQuery(".ended").click( function() {
				var id = $(this).attr("id");
				
				jQuery.ajax({
					type: "POST",
					data: ({id: id}),
					url: "test.php",
					success: function(response) {
					jQuery(".ended").fadeIn().html(response);
					}
				});
			})
</script>