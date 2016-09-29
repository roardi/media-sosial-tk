<?php
	session_start();
	include("connection.php");
	include("function.php");
	include("adminbar.php");
	
	if($_SESSION['login'] != 'admin'){
		header("location:index.php");
	}
	//$id = $_SESSION['member_id'];
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
		if(isset($_POST['status'])){
			$status = $_POST['accept'];
			$postid = $_POST['cantseeme'];
			mysqli_query($con,"UPDATE groupposts SET status='$status' WHERE grouppost_id='$postid'")or die(mysqli_error());
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
                    <h3 class="t"><a href="groups.php?id=<?php echo $group_id;?>" rel='facebox' style="text-decoration: none;">Groups</a></h3>
                </div>
				<div class="art-blockcontent">
                    <div class="art-blockcontent-body">
					<ul>
							<?php
								$member_id=$_SESSION['member_id'];
								$group = mysqli_query($con,"SELECT * FROM groups ")or die(mysqli_error());
								while ($row = mysqli_fetch_array($group)){
									$groupid=$row['group_id'];
									$sql = mysqli_query($con,"SELECT * FROM groupmembers WHERE group_id = '$groupid' AND status='1'")or die(mysqli_error());
									$num_rows  =mysqli_num_rows($sql);
									echo '<li> <a href=groups.php?id='.$row["group_id"].' style = "text-decoration:none;">'.$row['group_name'].' </a></li>';
									echo '<li align=right>'.$num_rows.' '.'members'.' </li>';
								}			
								
							?>
							</ul>
                                		<div class="cleared"></div>
                    </div>
                </div>
                <div class="art-blockheader">
                    <div class="l"></div>
                    <div class="r"></div>
                    <h3 class="t"><a href="#" rel='facebox' style="text-decoration: none;">Recent Active Members</a></h3>
                </div>
				
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
					<ul>
							<?php
							
								$post = mysqli_query($con,"SELECT * FROM groupposts ORDER by date DESC LIMIT 0,5")or die(mysqli_error());
								
								$num_rows  =mysqli_num_rows($post);
							
							if ($num_rows != 0 ){

								while($row = mysqli_fetch_array($post)){
				
								$member = $row['member_id'];
								//$member_id=$_SESSION['member_id'];
								
									$friends = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$member'")or die(mysqli_error());
									$friendsa = mysqli_fetch_array($friends);
										
										echo '<li> <a href=userprofiletest.php?id='.$friendsa["member_id"].' style = "text-decoration:none;"><img src="image/members/'. $friendsa['photo'].'" height="50" width="50"><br>'.$friendsa['firstname'].' '.$friendsa['lastname'].' </a></li>';
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
							<h3 class="t">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Share your opinions</h3>
						</div>
						<div class="art-blockcontent">
							<div class="art-blockcontent-body">
							<h2 class="art-postheader">
							</h2>
						<div class="cleared"></div>
							<div>
								<form method="post" action="">
									<?php
											//$member_id = $_SESSION['member_id'];
											$sql=mysqli_query($con,"SELECT * FROM members WHERE member_id='$member_id'") or die(mysqli_error());
											$getpic=mysqli_fetch_array($sql);
											$post = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$member_id'")or die(mysqli_error());
											$row = mysqli_fetch_array($post); 
											echo "<a href='userprofiletest.php' style='text-decoration:none;'>".$row['firstname']." ".$row['lastname']."</a>"."<br />"."&nbsp;&nbsp;&nbsp;&nbsp;<img src='image/members/".$getpic['photo']."'width='120px' height='120px'>";
											
											
									?>
									
										<p align="center"><textarea name="textarea" style="width: 300px; margin-left: 169px; margin-top: -73px;" onclick="this.value='';" >Click here..</textarea></p>
										
										<p align="center"><input  style="width: 80px; height: 36px; margin-left: 175px;" type="submit" id="share" value="Share" name="share" /><br /></p>
								
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
							<h3 class="t">Recent group post</h3>
						</div>
						<div class="art-blockcontent">
							<div class="art-blockcontent-body">
							<h2 class="art-postheader">
							</h2>
						<div class="cleared"></div>
							<div>
							<?php	
										$post = mysqli_query($con,"SELECT * FROM groupposts ORDER by date DESC")or die(mysqli_error());
										while($row = mysqli_fetch_array($post)){
										$id = $row['member_id'];
										$hu_u = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$id'")or die(mysqli_error());
										$rows = mysqli_fetch_array($hu_u);
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
										
										echo "<input type='hidden' value='".$row['grouppost_id']."' name='cantseeme'/>
											<div>
												<div class='picofjoke'><img src='image/members/".$rows['photo']."' width='50' height ='50' alt=''/>".$rows['firstname']." ".$rows['lastname'].",</div><div class = 'postcon'><br />
											".$row['posts']."<br /><br /><strong>Last</strong> ".$row['date']."";
											?>
												<div align='right'><form method="post" action="">
												<input type='hidden' value='<?php echo $row['grouppost_id'];?>' name='cantseeme'/>
												<select id='drop' name='accept'>
													<option selected value=''>----Status----</option>
													<option value='0'>Not Accepted</option>
													<option value='1'>Still Considered</option>
													<option value='2'>Accepted</option>
												</select>
												<input type="submit" id="searchbutton" value="Change" name="status"/>
												</form>
											<?php
											if ($row['status']==2){
												echo"<img src='images/green.png' width='10' height ='10' alt='' align='right'/>";}
											elseif ($row['status']==1){
												echo"<img src='images/yellow.jpg' width='10' height ='10' alt='' align='right'/>";}
											else{
												echo"<img src='images/red.png' width='10' height ='10' alt='' align='right'/>";}
												echo"</div>";
												echo"<hr /><a href='seeall.php?id=".$row['grouppost_id']."' rel='facebox' style='text-decoration:none;'>Thumbs up (".$allcounts.")</a> <a href='groupcomment.php?id=".$row['grouppost_id']."' rel='facebox' style='text-decoration:none;'>Comments(".$allcount.")</a>";
											
												echo "<div style='float:right;'><a href='deletegrouppost.php?id=".$row['grouppost_id']."&gid=".$row['group_id']."' style='text-decoration:none;'>Delete</a></div>";
												//echo "<div style='float:right;'><a href='editgrouppost.php?id=".$row['grouppost_id']."&gid=".$row['group_id']."' style='text-decoration:none;'>Edit</a></div>";
												echo "<div style='float:right;'></div>";
											
											echo"<hr />
											
											</div></div>";
											
									}
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
                    <h3 class="t">Find members</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
                <div>
  				<form name="search" method="POST" id="search" action="search.php"> 
					<p>&nbsp;<input type="text" name="friend" id="searchfriend"  onclick="this.value='';" value="Find members..."/></p>
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
<!--
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
jQuery.flashgallery('gallery/gallery.swf', 'gallery/config.json', { width: '195x', height: '250px', background: 'transparent' });
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
                    <h3 class="t">Advertisement</h3>
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
-->
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
                                <p>Copyright©2016</p>
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