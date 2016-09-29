<?php
	session_start();
	include("connection.php");
	include("function.php");
	
	$groupid = $_GET['id'];
	
	if($_SESSION['login'] == 'true'){
		include ("memberbar.php");
	}
	elseif($_SESSION['login'] == 'admin'){
		include("adminbar.php");
	}
	elseif($_SESSION['login'] == 'admingroup'){
		include("groupbar.php");
	}
	else{
		header("location:index.php");
	}
	$id = $_SESSION['member_id'];
	
		if(isset($_POST['share'])){
			$post = $_POST['textarea'];
			if ($post !="Click here...."){ if ($post !=""){
			mysqli_query($con,"INSERT INTO groupposts(group_id,member_id,posts,date) VALUE ('$groupid','$id','$post',NOW())")or die(mysqli_error());}}
		}
		if(isset($_POST['comment'])){
			$comment = $_POST['textarea'];
			$grouppostid = $_POST['ucantseeme'];
			if ($comment !=""){
			mysqli_query($con,"INSERT INTO grouppostcomments(grouppost_id,member_id,date,comments) VALUE ('$grouppostid','$id',NOW(),'$comment')")or die(mysqli_error());}
		}
		if(isset($_POST['join'])){
			mysqli_query($con,"INSERT INTO groupmembers(group_id,member_id,datetime,status) VALUE ('$groupid','$id',NOW(),1)")or die(mysqli_error());
		}
		if(isset($_POST['edit'])){
			$post = $_POST['textarea'];echo $post;
			$grouppostid = $_POST['gpid'];echo $grouppostid;
			if ($post !=""){
				mysqli_query($con,"UPDATE groupposts SET posts='$post', date=NOW(), status='0' WHERE grouppost_id='$grouppostid' ")or die(mysqli_error());}
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
                    <h3 class="t">Group Profile</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
					
				<?php
					$sql=mysqli_query($con,"SELECT * FROM groups WHERE group_id='$groupid'") or die(mysqli_error());
					$row=mysqli_fetch_array($sql);
					echo "<center><img src='image/groups/".$row['photo']."' width='130px' height='230px' alt='Image cannot be dispalyed'></center>";
					?>
		
					<p align='left'><a href="groups.php?id=<?php echo $groupid; ?>" style="text-decoration:none;"><?php echo $row['group_name']?></a></p>
					<p align='left'><a href="infogroup.php?id=<?php echo $groupid; ?>" style="text-decoration:none;" rel='facebox' >Info</a></p>
					<p align='left'><a href="photo1.php?id=<?php echo $groupid; ?>" style="text-decoration:none;">Photos of <?php echo $row['group_name'];?></a></p> 
					
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
                    <h3 class="t"><a href="friendsoffriend.php?id=<?php echo $group_id;?>" rel='facebox' style="text-decoration:none;"><?php echo $row['group_name'];?>'s Members</a></h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
						<ul>
							<?php
							
								//$group_id=$_SESSION['groupid'];							
								$post = mysqli_query($con,"SELECT * FROM groupmembers WHERE group_id = '$groupid' AND status='1' LIMIT 0,5")or die(mysqli_error());
								
								$num_rows  =mysqli_num_rows($post);
							
								if ($num_rows != 0 ){
								echo "$num_rows"." "."members";
								while($row = mysqli_fetch_array($post)){
				
								$members = $row['member_id'];
								$membergroups = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$members' ")or die(mysqli_error());
								$membera = mysqli_fetch_array($membergroups);
									
									echo '<li> <a href=infofriend.php?id='.$membera["member_id"].' rel="facebox" style="text-decoration:none;"><img src="image/members/'. $membera['photo'].'" height="50" width="50"><br>'.$membera['firstname'].' '.$membera['lastname'].' </a> </li>';
									
								}
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
			
		</div>
		<div style="margin-top: 20px;"> 
		
		<?php
					$member_id = $_SESSION['member_id'];
					$post = mysqli_query($con,"SELECT * FROM groups WHERE group_id = '$groupid'")or die(mysqli_error());
					$row = mysqli_fetch_array($post); 
			?>
		<table>
			<tr><td width="100" height="40"><font size="2">Group Name:</font></td><td><font size="2"><strong><?php echo $row['group_name'];?></strong></td></tr> 
			<tr><td width="100" height="40"><font size="2">Description:</td><td><font size="2"><?php echo $row['info'];?></td></tr>
		</table>
		
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
			<?php
			$member_id = $_SESSION['member_id'];
			$sql = mysqli_query($con,"SELECT * FROM groupmembers WHERE group_id='$groupid' AND member_id='$member_id' AND status='1'")or die(mysqli_error());
			$checkid = mysqli_num_rows ($sql);
			if ($checkid !=0){
			?>
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
										<textarea name="textarea" cols="50" rows="3" onclick="this.value='';" >Click here....</textarea>
										<input type="submit" id="share" value="Share" name="share" style="align:center; width: 80px; height: 36px;/>
								</form>
							</div>
							<div class="cleared"></div>
							</div>
						</div>
						</div>
						</div>
			<?php
			}else{
				if($_SESSION['login'] == 'admin'){
			?>
					<div class="cleared"></div>
							<div>
								<form method="post" action="" width="20">
										
								</form>
							</div>
							<div class="cleared"></div>
							</div>
			<?php	}
				else{
			?>
						<div class="cleared"></div>
							<div>
								<form method="post" action="" width="20">
										<input width ="10" type="submit" id="join" value="Join Group" name="join" />
								</form>
							</div>
							<div class="cleared"></div>
							</div>
				<?php }
					echo "</div>";}
			?>
						
						
             
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

									$post = mysqli_query($con,"SELECT * FROM groupposts WHERE group_id = '$groupid' ORDER by date DESC")or die(mysqli_error());
									echo "<table>";
									while($row = mysqli_fetch_array($post)){
										$id = $row['member_id'];
										$group_id = $row['group_id'];
										if ($id==$group_id){
											$hu_u = mysqli_query($con,"SELECT * FROM groups WHERE group_id = '$group_id'")or die(mysqli_error());
											$rows = mysqli_fetch_array($hu_u);
											$name = $rows['group_name'];
											$photo = "image/groups/".$rows['photo'];
										}else{
											$hu_u = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$id'")or die(mysqli_error());
											$rows = mysqli_fetch_array($hu_u);
											$name = $rows['firstname']." ".$rows['lastname'];
											$photo = "image/members/".$rows['photo'];
										}
										$iyaid = $row['grouppost_id'];
										$allcomm = mysqli_query($con,"SELECT * FROM grouppostcomments WHERE grouppost_id = '$iyaid'")or die(mysqli_error());
											$counters = 0;
											WHILE($stat = mysqli_fetch_array($allcomm)){
											$counters++;
										}
										$allcount = $counters;
										
										$all_like = mysqli_query($con,"SELECT * FROM grouppostlike WHERE grouppost_id = '$iyaid'")or die(mysqli_error());
											$counterss = 0;
											WHILE($stat = mysqli_fetch_array($all_like)){
											$counterss++;
										}
										$allcounts = $counterss;
										
										echo "<tr><td><input type='hidden' value='".$row['grouppost_id']."' name='cantseeme'/>
											<div>
												<div class='picofjoke'><img src=".$photo." width='30' height ='30' alt=''/><br>".$name."</div>
												<div class = 'postcon'><br />".$row['posts']."<br /><br /><strong>Last</strong> ".$row['date']."";
											if ($row['status']==2){
												echo"<img src='images/green.png' width='10' height ='10' alt='' align='right' margin-top='-20px'/>";}
											elseif ($row['status']==1){
												echo"<img src='images/yellow.jpg' width='10' height ='10' alt='' align='right'margin-top='-20px'/>";}
											else{
												echo"<img src='images/red.png' width='10' height ='10' alt='' align='right' margin-top='-20px'/>";}
											echo"<hr /><a href='seeall.php?id=".$row['grouppost_id']."' rel='facebox' style='text-decoration:none;'><img src='image/thumbsup.jpg' width='20' height='15' align='center' margin-top='-20px'>(".$allcounts.")</a> <a href='groupcomment.php?id=".$row['grouppost_id']."' rel='facebox' style='text-decoration:none;'>Comments(".$allcount.")</a>";
											if($_SESSION['login'] == 'admin'){
												echo "<div style='float:right;'><a href='deletegrouppost.php?id=".$row['grouppost_id']."&gid=".$row['group_id']."' style='text-decoration:none;'>Delete</a></div>";
											}
											elseif ($row['member_id'] == $_SESSION['member_id']){
												echo "<div style='float:right; margin-top:10px;'><a href='deletegrouppost.php?id=".$row['grouppost_id']."&gid=".$row['group_id']."' style='text-decoration:none;'>Delete</a></div>";
												echo "<div style='float:right; margin-top:10px;'><a href='editgrouppost.php?id=".$row['grouppost_id']."' rel='facebox' style='text-decoration:none;'>Edit</a></div>";}
											else {
												//echo "<div style='float:right;'><a href='#'>Report</a></div>";
											}
											echo"</div></div>";
											echo "</td></tr>";
									}
								echo "</table>";
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
include("find.php");
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