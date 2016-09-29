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
			mysqlii_query($con,"INSERT INTO posts(member_id,posts,date,post_to) VALUE ('$id','$post',NOW(),'$id')")or die(mysqlii_error());}}
		}
		if(isset($_POST['comment'])){
			$comment = $_POST['textarea'];
			$postid = $_POST['ucantseeme'];
			if ($comment !=""){
			mysqlii_query($con,"INSERT INTO postcomments(postid,memberid,date,comment) VALUE ('$postid','$id',NOW(),'$comment')")or die(mysqlii_error());}
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
                    <div class="l"></div>
                    <div class="r"></div>
                    <h3 class="t">Profile</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">

			<?php
					$member_id = $_SESSION['member_id'];
					$post = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$member_id'")or die(mysqli_error());
					$row = mysqli_fetch_array($post); 
					
			?>					
				<?php
					$sql=mysqli_query($con,"SELECT * FROM members WHERE member_id='$member_id'") or die(mysqli_error());
					$getpic=mysqli_fetch_array($sql);
					echo "<center><img src='image/members/".$getpic['photo']."' width='130px' height='230px' alt='Image cannot be dispalyed'></center>";
					?>
		
					<p align='left'><a href="userprofiletest.php?id=<?php echo $id; ?>" style="text-decoration:none;"><?php echo $row['firstname']." ".$row['lastname'];?></a></p>
					<p align='left'><a href="infoprofile.php?id=<?php echo $id; ?>" style="text-decoration:none;" rel='facebox' >Info</a></p>
					<p align='left'><a href="photo1.php?id=<?php echo $userid; ?>" style="text-decoration:none;">Photos of <?php echo $row['firstname'];?></a></p>
					<p align='left'><a href="messages.php?id=<?php echo $id; ?>" style="text-decoration:none;" >Send a message</a></p> 
					
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
									
									echo '<li> <a href=userprofiletest.php?id='.$friendsa["member_id"].' style="text-decoration:none;"><img src="image/members/'. $friendsa['photo'].'" height="50" width="50"><br>'.$friendsa['firstname'].' '.$friendsa['lastname'].' </a> </li>';
									}else{
										$myfriend1 = $row['member_id'];
										$friends = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$myfriend1'")or die(mysqli_error());
										$friendsa = mysqli_fetch_array($friends);
										
										echo '<li> <a href=userprofiletest.php?id='.$friendsa["member_id"].' style = "text-decoration:none;"><img src="image/members/'. $friendsa['photo'].'" height="50" width="50"><br>'.$friendsa['firstname'].' '.$friendsa['lastname'].' </a></li>';
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
		<font style="Calibri" size="2%" >
		<img src="images/edit_friend.png"><a href="testing.php?id=<?php echo $member_id;?>"> Update Profile </a></strong> &nbsp;&nbsp;&nbsp;&nbsp;
		<img src="images/messages.png"><a href="mails.php?id=<?php echo $member_id;?>">Mails</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 <img src="images/photo.png"><a href="photo.php">Photos</a>
		
		
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
							<h3 class="t">Friendly Request</h3>
						</div>
						<div class="art-blockcontent">
						


	 <?php 
					
								$member_id=$_SESSION['member_id'];
								$seeall=mysqli_query($con,"SELECT * FROM friends WHERE friends_with='$member_id' AND status='unconf'") or die(mysqli_error());
								while($pila=mysqli_fetch_array($seeall)){
									
									$fromhum=$pila['member_id'];
									$post = mysqli_query($con,"SELECT * FROM members WHERE member_id='$fromhum'")or die(mysqli_error());
									$row = mysqli_fetch_array($post);
									echo '
									
										<div align="left"><img src="image/members/'.$row['photo'].'" alt="" height="70" width="70" border="0" class="left_bt" /></div>
										<div align="left">'.$row['firstname']." ".$row['lastname'].'</div>
										<div align="right"><a href="acceptoffers.php?id='.$row['member_id'].'" rel="facebox" >Accept</a>&nbsp;<a href="declineoffers.php?id='.$row['member_id'].'" rel="facebox">Decline</a></div>
										
									';
								}
															
							?>
							<div class="art-blockcontent-body">
							<h2 class="art-postheader">
							</h2>
						<div class="cleared"></div>
							<div><form method='post' action='test.php'>
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
include("find.php");
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
                    <h3 class="t">CHMSCians you may know</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
                <div>
  
  </div>                
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
                    <h3 class="t">CHMSC Spots</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
					<script type="text/javascript" src="gallery/js/jquery.js"></script>
<script type="text/javascript" src="gallery/js/swfobject.js"></script>
<script type="text/javascript" src="gallery/js/flashgallery.js"></script>
<script type="text/javascript">
jQuery.flashgallery('gallery/gallery.swf', 'gallery/config.json', { width: '180px', height: '250px', background: 'transparent' });
</script>
                <div>
  
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
			include("footer.php");
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