<?php
	session_start();
	include("connection.php");
	include("function.php");
	include("groupbar.php");
	
	if($_SESSION['login'] != 'admingroup'){
		header("location:index.php");
	}
	$id = $_SESSION['member_id'];
		
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
                    <h3 class="t">Profile </h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">

			<?php
					$group_id = $_SESSION['member_id'];
					$post = mysqli_query($con,"SELECT * FROM groups WHERE group_id = '$group_id'")or die(mysqli_error());
					$row = mysqli_fetch_array($post);
					?>
					<img src="image/members/<?php echo $row['photo'];?>" alt="" height="274"  width="138" border="0" class="left_bt" />
					<p align='center'><?php echo $row['group_name'];?></p>
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
                      <h3 class="t"><a href="profilmember.php?id=<?php echo $member_id;?>" rel='facebox' style="text-decoration:none;"><?php echo $row['group_name'];?>'s Members</a></h3>
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

		<div align="center" style="margin-top: 20px;"> 
		<font style="Calibri" size="3%" >
		<img src="images/edit_friend.png"><a href="testing.php?id=<?php echo $member_id;?>" rel='facebox'> Update Profile </a></strong> &nbsp;&nbsp;&nbsp;&nbsp;
		 <img src="images/info.png"><a href="info.php?id=<?php echo $member_id;?>" rel='facebox'>About Me</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<img src="images/messages.png"><a href="message.php?id=<?php echo $member_id;?>" rel='facebox'>Mails</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 <img src="images/photo.png"><a href="photo.php">Snapshots</a>
		
		
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
							<h3 class="t">Join Offers</h3>
						</div>
						<div class="art-blockcontent">
						


	 <?php 
					
								$group_id=$_SESSION['member_id'];
								$seeall=mysqli_query($con,"SELECT * FROM groupmembers WHERE group_id='$group_id' AND status='0'") or die(mysqli_error());
								while($pila=mysqli_fetch_array($seeall)){
									
									$fromhum=$pila['member_id'];
									$post = mysqli_query($con,"SELECT * FROM members WHERE member_id='$fromhum'")or die(mysqli_error());
									$row = mysqli_fetch_array($post);
									echo '
									
										<div align="left"><img src="image/members/'.$row['photo'].'" alt="" height="70" width="70" border="0" class="left_bt" /></div>
										<div align="left">'.$row['firstname']." ".$row['lastname'].'</div>
										<div align="right"><a href="acceptgroup.php?id='.$row['member_id'].'" rel="facebox" >Accept</a>&nbsp;<a href="declinegroup.php?id='.$row['member_id'].'" rel="facebox">Decline</a></div>
										
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
                    <h3 class="t">Look for your Friends</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
                <div>
  				<form name="search" method="POST" id="search" action="search.php"> 
					<p>&nbsp;<input type="text" name="friend" id="searchfriend"  onclick="this.value='';" value="CHMSCians..."/></p>
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
                    <h3 class="t">Adverstisement</h3>
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