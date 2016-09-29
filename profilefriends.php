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
			mysqli_query($con,"INSERT INTO posts(member_id,actualpost,date,post_to) VALUE ('$id','$post',NOW(),'$userid')")or die(mysqli_error());
		}
		if(isset($_POST['comment'])){
			$comment = $_POST['textarea'];
			$postid = $_POST['ucantseeme'];
			mysqli_query($con,"INSERT INTO postcomments(postid,memberid,date,comment) VALUE ('$postid','$userid',NOW(),'$comment')")or die(mysqli_error());
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
					$post = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$userid'")or die(mysqli_error());
					$row = mysqli_fetch_array($post); 
			?>
					<img src="image/members/<?php echo $row['photo'];?>" alt="" height="274"  width="138" border="0" class="left_bt" />
		
					<p align='left'><a href="userprofiletest.php?id=<?php echo $row['member_id'];?>" style="text-decoration:none;"><?php echo $row['firstname']." ".$row['lastname'];?></a></p>
					<p align='left'><a href="photo1.php?id=<?php echo $row['member_id'];?>" style="text-decoration:none;">Photos of <?php echo $row['firstname'];?></a></p>
					
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
                    <h3 class="t"><a href="friends.php?id=<?php echo $member_id;?>" rel='facebox' style="text-decoration:none;"><?php echo $row['firstname'];?>'s Friends</a></h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
			<p>
			<?php 
				//showfriends($_SESSION['studentid']['member_id']);
			?>
			 </p>                
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
		<div align="center" style="margin-top: 20px;"> 
		<font style="Calibri" size="3%" >
		
		
		</div>
		<div align="center" style="margin-top: 20px;"> 
		<font style="Calibri" size="3%">
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
							<h3 class="t">Know more about <?php echo $row['firstname'];?></h3>
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
									<p>&nbsp;&nbsp;Do you want <?php echo $row['firstname'];?> to be your friend?</p>
									<?php
									$id = $row['member_id'];
									?>
									<p>&nbsp;&nbsp;<a href="addfriend.php?id=<?php $row['member_id']; ?>" rel="facebox" style="text-decoration:none;">Add as Friend</a></p>
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
							
						</div>
						<div class="art-blockcontent">
							<div class="art-blockcontent-body">
							
							
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
                    <h3 class="t">Look for your friends</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
                <div>
  				<form name="search" method="POST" id="search" action="search.php"> 
					<p>&nbsp;<input type="text" name="friend" id="searchfriend" value="CHMSCians..." onclick="this.value='';"/></p>
					<p><input type="submit" name="search" id="searchbutton" value="Search"/></p>
			 

  </form>
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
                    <h3 class="t">CHMSCians you may know</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
                <div>
				  <p></p>
				 <ul>
					
				 <?php
						$post = mysqli_query($con,"SELECT * FROM members WHERE member_id != $id LIMIT 0,2")or die(mysqli_error());
						while($row = mysqli_fetch_array($post)){
							echo '
							<li>
								<p align="center"><a href="profilefriends.php?id='.$row['member_id'].'" style="text-decoration:none;"><img src="image/members/'.$row['photo'].'" alt="" height="70" width="70" border="0" class="left_bt" /></p>
								<p align="center">'.$row['firstname']." ".$row['lastname'].'</p>
								<p align="center" style="margin-left: 2px;"><a href="addfriend.php?id='.$row['member_id'].'" rel="facebox" style="text-decoration:none;">Add as School Friend</a></p>
							</li>';
						}
				?>
				</ul>	
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
					jQuery.flashgallery('gallery/gallery.swf', 'gallery/config.json', { width: '195px', height: '250px', background: 'transparent' });
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
                    <h3 class="t">Advertisements</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
					<script type="text/javascript" src="gallery11/js/jquery.js"></script>
					<script type="text/javascript" src="gallery11/js/swfobject.js"></script>
					<script type="text/javascript" src="gallery11/js/flashgallery.js"></script>
					<script type="text/javascript">
					jQuery.flashgallery('gallery11/gallery11.swf', 'gallery11/config.json', { width: '200px', height: '242px', background: 'transparent' });
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
            <div class="art-footer">
                <div class="art-footer-t"></div>
                <div class="art-footer-l"></div>
                <div class="art-footer-b"></div>
                <div class="art-footer-r"></div>
                <div class="art-footer-body">
                    
                            <div class="art-footer-text">
							 <p>CHMSC United | Copyright © 2011</p>
                                                            </div>
                    <div class="cleared"></div>
                </div>
            </div>
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