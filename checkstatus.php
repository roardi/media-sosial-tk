<?php
	session_start();
	include("connection.php");
	include("function.php");
	include("groupbar.php");
	
	if($_SESSION['login'] != 'admingroup'){
		header("location:index.php");
	}
	$id = $_SESSION['member_id'];
	$grouppost_id = $_GET['id'];
		if(isset($_POST['share'])){
			$post = $_POST['textarea'];
			if ($post !="Click here.."){if ($post !=""){
			mysqli_query($con,"INSERT INTO groupposts(group_id,member_id,posts,date) VALUE ('$id','$id','$post',NOW())") or die(mysqli_error());}}
		}
		if(isset($_POST['comment'])){
			$comment = $_POST['textarea'];
			$postid = $_POST['ucantseeme'];
			if ($comment !=""){
			mysqli_query($con,"INSERT INTO grouppostcomments(grouppost_id,member_id,date,comments) VALUE ('$postid','$id',NOW(),'$comment')")or die(mysqli_error());}
		}
		if(isset($_POST['status'])){
			$status = $_POST['accept'];
			$postid = $_POST['cantseeme'];
			mysqli_query($con,"UPDATE groupposts SET status='$status' WHERE grouppost_id='$postid'")or die(mysqli_error());
		}
		if(isset($_POST['uploadfile'])){
			$post = $_POST['textarea'];
			$name = $_FILES["file"] ["name"];
			$type = $_FILES["file"] ["type"];
			$size = $_FILES["file"] ["size"];
			$temp = $_FILES["file"] ["tmp_name"];
			$error = $_FILES["file"] ["error"];
			if($name!=""){
				mysqli_query($con,"INSERT INTO upload(member_id,file_name,datetime) 
									VALUES ('$id','$name',NOW())") or die(mysqli_error());
				//echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;<font size='2'>Your photo/video has been successfully uploaded!!!</font><br>";
				if ($error > 0){
					die("<font size='2'>Error uploading file! Code $error.</font>");
				}else{
					if($size > 100000000) //conditions for the file
					{
					die("<font size='2'>Format is not allowed or file size is too big!</font>");
					}
					else
					{
					move_uploaded_file($temp,"image/files/".$name);
					mysqli_query($con,"INSERT INTO groupposts(group_id,member_id,posts,file,date) VALUE ('$id','$id','$post','$name',NOW())") or die(mysqli_error());
					}
				}
			}else{
				die("<font size='2'>There is no file to upload<font>");
			}
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
                    <h3 class="t"><a href="membergroup.php?id=<?php echo $group_id;?>">Members</a></h3>
                </div>
				<div class="art-blockcontent">
                    <div class="art-blockcontent-body">
					<ul>
							<?php 
								$group_id=$_SESSION['member_id'];
								$group = mysqli_query($con,"SELECT * FROM groupmembers WHERE group_id = '$group_id' AND status='1' ")or die(mysqli_error());
								while ($row = mysqli_fetch_array($group)){
									$member_id = $row['member_id'];
									$sql = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$member_id' ")or die(mysqli_error());
									$rows = mysqli_fetch_array($sql);
									echo '<li> <a href=memberprofile.php?id='.$rows["member_id"].' style = "text-decoration:none;"><img src="image/members/'. $rows['photo'].'" height="30" width="30" align="center">'.$rows['firstname'].' '.$rows['lastname'].' </a></li>';
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
							
							$post_a = mysqli_query($con,"SELECT DISTINCT member_id FROM groupposts WHERE group_id = '$id' ORDER by date DESC LIMIT 0,5")or die(mysqli_error());
							$num_rows  =mysqli_num_rows($post_a);
							
							if ($num_rows != 0 ){
								$cekid = "";
								$cekid2 = "";
								while($row = mysqli_fetch_array($post_a)){
								$cekid = $cekid2;
								$member = $row['member_id'];
								$member_id=$_SESSION['member_id'];
								if ($cekid!=$member){
									$friends = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$member'")or die(mysqli_error());
									$friendsa = mysqli_fetch_array($friends);
										
									echo '<li> <a href=memberprofile.php?id='.$friendsa["member_id"].' style = "text-decoration:none;"><img src="image/members/'. $friendsa['photo'].'" height="30" width="30" align="center">'.$friendsa['firstname'].' '.$friendsa['lastname'].' </a></li>';
									$cekid2 = $member;
								}else {}
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
							<h3 class="t">Change Post Status</h3>
						</div>
						<div class="art-blockcontent">
							<div class="art-blockcontent-body">
							<h2 class="art-postheader">
							</h2>
						<div class="cleared"></div>
							<div>
							<?php	
										$admingroup_id = $_SESSION['member_id'];
										$post = mysqli_query($con,"SELECT * FROM groupposts WHERE group_id = '$id' AND grouppost_id='$grouppost_id'")or die(mysqli_error());

										echo "<table>";
										$row = mysqli_fetch_array($post);
										$memberid = $row['member_id'];
										if ($memberid==$admingroup_id){
											$hu_u = mysqli_query($con,"SELECT * FROM groups WHERE group_id = '$admingroup_id'")or die(mysqli_error());
											$rows = mysqli_fetch_array($hu_u);
											$name = $rows['group_name'];
											$photo = "image/groups/".$rows['photo'];
										}else{
											$hu_u = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$memberid'")or die(mysqli_error());
											$rows = mysqli_fetch_array($hu_u);
											$name = $rows['firstname']." ".$rows['lastname'];
											$photo = "image/members/".$rows['photo'];
										}
										$cekfile = $row['file'];
										if ($cekfile!=""){
											$msg = '<br><a href="image/files/'. $cekfile .'" style="margin-left:-35px;"><img src="image/files/'. $cekfile .'" width="100" height="100" align="center"/></a>';
										}
										else{
											$msg = "";
										}
										//$iyaid = $row['grouppost_id'];
										$allcomm = mysqli_query($con,"SELECT * FROM grouppostcomments WHERE grouppost_id = '$grouppost_id'")or die(mysqli_error());
											$counters = 0;
											WHILE($stat = mysqli_fetch_array($allcomm)){
											$counters++;
										}
										$allcount = $counters;
										
										$all_like = mysqli_query($con,"SELECT * FROM grouppostlike WHERE grouppost_id = '$grouppost_id'")or die(mysqli_error());
											$counterss = 0;
											WHILE($stat = mysqli_fetch_array($all_like)){
											$counterss++;
										}
										$allcounts = $counterss;
										
										echo "<tr><td><input type='hidden' value='".$row['grouppost_id']."' name='cantseeme'/>
											<div>
												<td><div class='picofjoke'><img src=".$photo." width='30' height ='30' alt=''/><br>".$name."</div><td>
												<div class = 'postcon'><br />".$row['posts']."".$msg."<br /><br /><strong>Last</strong> ".$row['date']."";
											?>
												<div style='float:right; margin-top:-10px;'>
												<form method="post" action="">
												<input type='hidden' value='<?php echo $row['grouppost_id'];?>' name='cantseeme'/>
												<select name='accept'>
													<option selected value=''>----Status----</option>
													<option value='0'>Not Accepted</option>
													<option value='1'>Still Considered</option>
													<option value='2'>Accepted</option>
												</select>
												<input type="submit" id="searchbutton2" value="Change" name="status"/>
												</div>
											<?php
											if ($row['status']==2){
												echo"<div style='float:right; margin-top:-10px; '><img src='images/green.png' width='10' height ='10' alt='' align='right'/></div>";}
											elseif ($row['status']==1){
												echo"<div style='float:right; margin-top:-10px; '><img src='images/yellow.jpg' width='10' height ='10' alt='' align='right'/></div>";}
											else{
												echo"<div style='float:right; margin-top:-10px;'><img src='images/red.png' width='10' height ='10' alt='' align='right'/></div>";}
												echo"</form></div>";
												echo"<br><div></div><hr /><div style='float:left; margin-left:-20px; margin-top:-10px;'><a href='seeall.php?id=".$row['grouppost_id']."' rel='facebox' style='text-decoration:none;'><img src='image/thumbsup.jpg' width='20' height='15' align='center' >(".$allcounts.")</a> <a href='groupcomment.php?id=".$row['grouppost_id']."' rel='facebox' style='text-decoration:none;'>Comments(".$allcount.")</a></div>";
												echo "<div style='float:right;'><a href='deletegrouppost.php?id=".$row['grouppost_id']."&gid=".$row['group_id']."' style='text-decoration:none;'>Delete</a></div>";
											
												//echo "<div style='float:right;'><a href='editgrouppost.php?id=".$row['grouppost_id']."&gid=".$row['group_id']."' style='text-decoration:none;'>Edit</a></div>";
											
											echo"</div></div>";
											echo "</td></tr>";
									
									echo "</table>";
							?>
									
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
							<h3 class="t">Similar Post</h3>
						</div>
						<div class="art-blockcontent">
							<div class="art-blockcontent-body">
							<h2 class="art-postheader">
							</h2>
						<div class="cleared"></div>
							<div>
							<?php
								$data = $grouppost_id;
								$data2 = '11';

								// Execute the python script with the JSON data
								// header('application-type: application/json');
								$command = print_r(shell_exec("C:\Python27\word2vec\maclearn.py $data"),true);
								$rows = json_decode($command,true);
								
								$data = $rows['row'];
								if ($data !=NULL){
									foreach ($data as $key => $row){
										$similarity[$key]=$row['similarity'];
									}
									array_multisort($similarity,SORT_DESC,$data);
								}
								echo "<table>";
								for($i=0;$i<count($data);$i++){
									echo "<tr><td>";
									// echo "Id: ".$data[$i]['id']."<br>";
									echo $data[$i]['data']."<br><hr/>";
									echo "<div style='float:right;'><i>Similarity: ".$data[$i]['similarity']." %  "."<progress value=".$data[$i]['similarity']." max='100'></progress></div><br><hr/><hr/>";
									echo "";
									echo "</td></tr>";
								}
								echo "</table>";
							?>
							</div>
							<div class="cleared"></div>
							</div>
						</div>
				<div class="cleared"></div>
			</div>
		</div>
             
        <div class="cleared"></div>
		</div>
		
			<div class="art-post-body">
			
			</div>
                      <div class="cleared"></div>
                    </div>
                    <div class="art-layout-cell art-sidebar2">
<?php
include ("findmember.php");
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
						<!--<script type="text/javascript" src="gallery2/js/jquery.js"></script>
<script type="text/javascript" src="gallery2/js/swfobject.js"></script>
<script type="text/javascript" src="gallery2/js/flashgallery.js"></script>
<script type="text/javascript">
jQuery.flashgallery('gallery2/gallery2.swf', 'gallery2/config.json', { width: '160px', height: '242px', background: 'transparent' });
</script>-->
					
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