<?php
	session_start();
	include("connection.php");
	include("function.php");
	
	$userid = $_GET['id'];
	
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
			mysqli_query($con,"INSERT INTO posts(member_id,posts,date,post_to) VALUE ('$id','$post',NOW(),'$id')")or die(mysqli_error());
		}
		if(isset($_POST['comment'])){
			$comment = $_POST['textarea'];
			$postid = $_POST['ucantseeme'];
			mysqli_query($con,"INSERT INTO postcomments(postid,memberid,date,comment) VALUE ('$postid','$id',NOW(),'$comment')")or die(mysqli_error());
		}
?>

<div class="art-content-layout">
                <div class="art-content-layout-row">
                    <div class="art-layout-cell art-sidebar1">
<!--<div class="art-vmenublock">
    <div class="art-vmenublock-tl"></div>
    <div class="art-vmenublock-tr"></div>
    <div class="art-vmenublock-bl"></div>
    <div class="art-vmenublock-br"></div>
    <div class="art-vmenublock-tc"></div>
    <div class="art-vmenublock-bc"></div>
    <div class="art-vmenublock-cl"></div>
    <div class="art-vmenublock-cr"></div>
    <div class="art-vmenublock-cc"></div>

</div> -->
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
				<?php
						$member_id = $_SESSION['member_id'];
						$post = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$userid'")or die(mysqli_error());
						$row = mysqli_fetch_array($post); 
						
				?>					
                    <div class="l"></div>
                    <div class="r"></div>
                    <h3 class="t"><?php echo $row['firstname'];?>'s Profile</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">

				<?php
					$sql=mysqli_query($con,"SELECT * FROM members WHERE member_id='$userid'") or die(mysqli_error());
					$getpic=mysqli_fetch_array($sql);
					echo "<center><img src='image/members/".$getpic['photo']."' width='130px' height='230px' alt='Image cannot be dispalyed'></center>";
					?>
		
					<p align='left'><a href="myfriendsprofile.php?id=<?php echo $userid; ?>" style="text-decoration:none;"><?php echo $row['firstname']." ".$row['lastname'];?></a></p>
					<p align='left'><a href="infofriend.php?id=<?php echo $userid; ?>" style="text-decoration:none;" rel='facebox' >Info</a></p>
					<p align='left'><a href="photo1.php?id=<?php echo $userid; ?>" style="text-decoration:none;">Photos of <?php echo $row['firstname'];?></a></p>
					<p align='left'><a href="messages.php?id=<?php echo $userid; ?>&stat=1" style="text-decoration:none;" >Send a message</a></p> 
					
                    <div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>
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
                    <h3 class="t"><a href="friendsoffriend.php?id=<?php echo $member_id;?>" rel='facebox' style="text-decoration:none;"><?php echo $row['firstname'];?>'s Friends</a></h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
						<ul>
							<?php
							
								$member_id=$_SESSION['member_id'];							
								$post = mysqli_query($con,"SELECT * FROM friends WHERE (friends_with = '$userid' OR member_id = '$userid') AND status = 'c' ")or die(mysqli_error());
								
								$num_rows  =mysqli_num_rows($post);
							
							if ($num_rows != 0 ){

								while($row = mysqli_fetch_array($post)){
				
								$myfriend = $row['member_id'];
								$member_id=$_SESSION['member_id'];
								
									if($myfriend == $userid){
									
										$myfriend1 = $row['friends_with'];
										$friends = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$myfriend1'")or die(mysqli_error());
										$friendsa = mysqli_fetch_array($friends);
										if($myfriend == $member_id){
											echo "";
										}else{
											echo '<li> <a href=infofriend.php?id='.$friendsa["member_id"].' rel="facebox" style="text-decoration:none;"><img src="image/members/'. $friendsa['photo'].'" height="50" width="50"><br>'.$friendsa['firstname'].' '.$friendsa['lastname'].' </a> </li>';
										}
									}
									else{
										$myfriend1 = $row['member_id'];
										$friends = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$myfriend1'")or die(mysqli_error());
										$friendsa = mysqli_fetch_array($friends);
										if($myfriend == $member_id){
											echo "";
										}else{
										echo '<li> <a href=infofriend.php?id='.$friendsa["member_id"].' rel="facebox" style = "text-decoration:none;"><img src="image/members/'. $friendsa['photo'].'" height="50" width="50"><br>'.$friendsa['firstname'].' '.$friendsa['lastname'].' </a></li>';
										}
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

                      <div class="cleared"></div>
                    </div>

<div class="art-layout-cell art-content">
<div class="art-post">
		<div align="left" style="margin-top: 20px;"> 
		
		</div>
		<div class="art-post-inner art-article" style="margin-top: 20px;">
		
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
							<h3 class="t">Share your thoughts </h3>
						</div>
						<div class="art-blockcontent">
							<div class="art-blockcontent-body">
							<h2 class="art-postheader">
							</h2>
						<div class="cleared"></div>
							<div>
								<form method="post" action="">
										<textarea name="textarea" cols="50" rows="2" onclick="this.value='';" >Click me....</textarea>
										<input type="submit" id="share" value="Share" name="share" />
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
			<div class="art-block-body">
						<div class="art-blockheader">
							<div class="l"></div>
							<div class="r"></div>
							<h3 class="t">Recent post </h3>
						</div>
						<div class="art-blockcontent">
							<div class="art-blockcontent-body">
							<h2 class="art-postheader">
							</h2>
						<div class="cleared"></div>
							<div><form method='post' action='test.php'>
							<?php 

									$post = mysqli_query($con,"SELECT * FROM posts WHERE member_id = '$userid' ORDER by date DESC")or die(mysqli_error());
									while($row = mysqli_fetch_array($post)){
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
										
										echo "<input type='hidden' value='".$row['post_id']."' name='cantseeme'/>
											<div>
												<div class='picofjoke'><img src='image/members/".$rows['photo']."' width='50' height ='50' alt=''/>".$rows['firstname'].",</div><div class = 'postcon'><br />
											".$row['posts']."<br /><br /><strong>Last</strong> ".$row['date']."<hr /><a href='seeall.php?id=".$row['post_id']."' rel='facebox' style='text-decoration:none;'>Thumbs up (".$allcounts.")</a> <a href='comment.php?id=".$row['post_id']."' rel='facebox' style='text-decoration:none;'>Comments(".$allcount.")</a>";
											if ($id==$member_id){
												echo "<div style='float:right;'><a href='deletepostprofile.php?post_id=".$row['post_id']."&id=".$id."' style='text-decoration:none;'>Delete</a></div>
											<hr />";
											}else{}
											
											echo "</div></div>";
											
									}
				
								?>
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
			<div class="art-post-body">
			
			</div>
                      <div class="cleared"></div>
                    </div>
                    <div class="art-layout-cell art-sidebar2">
<?php
include ("find.php");
include ("knowfriends.php");
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
                    <h3 class="t">Hot Spots</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
					
					<script type="text/javascript" src="gallery/js/jquery.js"></script>
					<script type="text/javascript" src="gallery/js/swfobject.js"></script>
					<script type="text/javascript" src="gallery/js/flashgallery.js"></script>
					<script type="text/javascript">
					jQuery.flashgallery('gallery/gallery.swf', 'gallery/config.json', { width: '200px', height: '300px', background: 'transparent' });
					</script>
					
					
                <div>
  <ul>
    
  </ul>
</div>                
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