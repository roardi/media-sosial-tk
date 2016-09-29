<?php
	session_start();
	include("connection.php");
	include("function.php");
	
	if($_SESSION['login'] != 'maybe'){
		header("location:index.php");
	}
	$v_unit="";
	$v_position="";
	
	if (isset($_POST['insert'])){
	
	$file_name = $_POST['cantseeme'];
	$contact = $_POST['contact'];
	$status = $_POST['status'];
	$bday = ($_POST['Month']).'-'.($_POST['Day']).'-'.($_POST['Year']); 
	$gradschool = $_POST['gradschool'];
	$gradyear = $_POST['gradyear'];
	$unit = $_POST['unit'];
	$position = $_POST['position'];
				
	$member=$_SESSION['member_id'];	
	if ($unit=="") {
		$v_unit= "<font color='red' size='2'>Required Field <br /> </font>";
	} else {
		$v_unit= "";
	}
	if ($position=="") {
		$v_position= "<font color='red' size='2'>Required Field <br /> </font>";
	} else {
		$v_position= "";
	}
	if ($unit!="" && $position!=""){
	mysqli_query($con,"UPDATE members SET photo = '$file_name', contact = '$contact', relationship = '$status',birthdate = '$bday', gradschool = '$gradschool', gradyear = '$gradyear', unit = '$unit', position = '$position', account_status = 2 WHERE member_id = '$member'") or die(mysqli_error());
	
	$_SESSION['login'] = 'true';
	header("Location:hometest.php");}
	}
	
	 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v3.0.0.39952
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Registration</title>
    <meta name="description" content="Description" />
    <meta name="keywords" content="Keywords" />
	
	<link rel="shortcut icon" a href="images/logo.png" />
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

	
	<script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
	<link href="facebox1.2/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
			<link href="../css/example.css" media="screen" rel="stylesheet" type="text/css" />
			<script src="facebox1.2/src/facebox.js" type="text/javascript"></script>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(" a[rel*=facebox]" ).facebox({
						loadingImage : " ../src/loading.gif" ,
						closeImage   : " ../src/closelabel.png" 
					})
				})
	</script>
</head>
<body>

<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-tl"></div>
        <div class="art-sheet-tr"></div>
        <div class="art-sheet-bl"></div>
        <div class="art-sheet-br"></div>
        <div class="art-sheet-tc"></div>
        <div class="art-sheet-bc"></div>
        <div class="art-sheet-cl"></div>
        <div class="art-sheet-cr"></div>
        <div class="art-sheet-cc"></div>
        <div class="art-sheet-body">
            <div class="art-header">
                <div class="art-header-clip">
                <div class="art-header-center">
                    <div class="art-header-png"></div>
                    <div class="art-header-jpeg"></div>
                </div>
                </div>
                <div class="art-logo">
                                 <h1 class="art-logo-name"><a href="./index.html"></a></h1>
                                                 <h2 class="art-logo-text"></h2>
                                </div>
            </div>
            <div class="cleared reset-box"></div>
<div class="art-nav">
	<div class="art-nav-l"></div>
	<div class="art-nav-r"></div>
<div class="art-nav-outer">
	<ul class="art-hmenu">
		<li>
			<a href="hometest.php" ><span class="l"></span><span class="r"></span><span class="t"><font color="#000000" size="2">Home</font></span></a>
		</li>	
		
		<li>
			<a href="logout.php" ><span class="l"></span><span class="r"></span><span class="t"><font color="#000000" size="2">Log-out</font></span></a>
		</li>		
	</ul>
</div>
</div>
<div class="cleared reset-box"></div>
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
					$member_id = $_SESSION['member_id'];
					$post = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$member_id'")or die(mysqli_error());
					$row = mysqli_fetch_array($post); ?>
					<p align='center'><?php echo $row['firstname']." ".$row['lastname'];?></p>
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
							<h3 class="t">Get to know more informations of you!</h3>
						</div>
						<div class="art-blockcontent">
						
		<form method="post" name="upload" enctype='multipart/form-data'>	
		
		<br>
		<table>
			<tr><td width="10"></td><td><font size="2">Upload your photos and make it as your primary picture so that friends may recognize you. </font></td></tr>
			<tr><td width="10"><td><font size="2">Select an image file on your computer (4MB max):</td></tr>
			<tr><td width="10"><td><input id="browse" type="file" name="image">
									<input id="upload" type="submit" name="Submit" value="Upload" /></td></tr>
			<br>
		 </table>
		</form>
		<?php
if (isset($_POST['Submit'])){


	$member=$_SESSION['member_id'];
	
	$name = $_FILES["image"] ["name"];
	$type = $_FILES["image"] ["type"];
	$size = $_FILES["image"] ["size"];
	$temp = $_FILES["image"] ["tmp_name"];
	$error = $_FILES["image"] ["error"];
	if($name!=""){
		mysqli_query($con,"INSERT INTO upload(member_id,file_name,datetime) 
							VALUES ('$member','$name',NOW())") or die(mysqli_error());
		echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;<font size='2'>Your photo has been successfully uploaded!!!</font><br>";
		if ($error > 0){
			die("<font size='2'>Error uploading file! Code $error.</font>");
		}else{
			if($size > 10000000) //conditions for the file
			{
			die("<font size='2'>Format is not allowed or file size is too big!</font>");
			}
			else
			{
			move_uploaded_file($temp,"image/members/".$name);
			}
		}
	}else{
		die("<font size='2'>There is no file to upload<font>");
	}
}
			
 
?>		
							<form name="insert" method="post">
							<?php 
								
							$id = $_SESSION['member_id'];
							$query = mysqli_query($con,"SELECT * FROM upload WHERE member_id = '$id'")or die(mysqli_error());
							$row_result = mysqli_num_rows($query);
							
							if($row_result > 0){
								$msg = '<div>';
								$row = mysqli_fetch_array($query);
								$fname = $row['file_name'];
								
									$msg .= '<span style="float:left;padding:10px;"><img src="image/members/'. $fname .'" width="100" height="100"/></span>';
									$msg .= '</div></br></br></br></br></br></br></br></br>'; 
									echo $msg;
							?>
								<input type='hidden' value='<?php echo $fname;?>' name='cantseeme'/>														
							<?php
							}else{
								echo '<div style="margin:10px"><font size="2">No Photos Uploaded</font></div>';
								
							}
							?>
								<font size="2">
								<p align="center"><strong>&nbsp;&nbsp;More basic informations about you </strong></p>
								<br>
								<table>
									<tr><td width="150"><font size="2">Unit:</td>
										<td><input type="text" name="unit" id="inputtype"  ><?php echo "&nbsp;".$v_unit; ?></td>
									</tr>
									<tr><td width="150"><font size="2">Position:</td>
										<td><input type="text" name="position" id="inputtype"><?php echo "&nbsp;".$v_position; ?></td>
									</tr>
									<tr><td width="150"><font size="2">Status:</td>
										<td><select name="status">
											<option>Single</option>
											<option>In a relationship</option>
											<option>Engaged</option>
											<option>Married</option>
											<option>Divorced</option>
											<option>Widowed</option>
										</select></td>
									</tr>
									<tr><td width="150"><font size="2">Birthdate:</td>
										<td>
										
										<select name="Day" width="20">
										  <?php
														$day_bd=1;
															while($day_bd<=31)
																{
													?>
										  <option><?php echo $day_bd; ?></option>
										  <?php $day_bd++; } ?>
										</select>
										<?php echo "-"; ?>
										<select name="Month" width="30">
										  <option>January</option>
										  <option>February</option>
										  <option>March</option>
										  <option>April</option>
										  <option>May</option>
										  <option>June</option>
										  <option>July</option>
										  <option>August</option>
										  <option>September</option>
										  <option>October</option>
										  <option>November</option>
										  <option>December</option>
										</select>
										<?php echo "-"; ?>
										<select name="Year">
										  <?php
														$year_bd=1965;
															while($year_bd<=2016)
																{
													?>
										  <option><?php echo $year_bd; ?></option>
										  <?php $year_bd++; } ?>
										</select></td>
									</tr>
									<tr><td width="150"><font size="2">Contact No.:</td>
										<td><input type="" name="contact" id="inputtype" onclick="this.value='';" ></td>
									</tr>
									<tr><td width="150"><font size="2">School Graduated:</td>
										<td><input type="text" name="gradschool" id="inputtype" onclick="this.value='';" ></td>
									</tr>
									<tr><td width="150"><font size="2">Year Graduated:</td>
										<td><select name="gradyear">
											  <?php
															$year_bd=1985;
																while($year_bd<=2016)
																	{
														?>
											  <option><?php echo $year_bd; ?></option>
											  <?php $year_bd++; } ?></select></td>
									</tr>
									</font>
								</table>
								<br>	
								<p align="center"><input type="submit" id="inputsubmit" name="insert" value="Save" align="left"></p>
							</form>
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
                    <h3 class="t">Look for your friends</h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body" style="width: 195px;">
                <div>
  				<form name="search" method="POST" id="search" action="search.php"> 
					<p>&nbsp;<input type="text" name="friend" id="searchfriend"  onclick="this.value='';" value="CHMSCians..."/></p>
					<p><input type="submit" name="search" id="searchbutton" value="Search" /></p>
			
  </form>
</div>                
                                		<div class="cleared"></div>
                    </div>
                </div>
		
    </div>
</div>
<div class="art-block">


               
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
					jQuery.flashgallery('gallery/gallery.swf', 'gallery/config.json', { width: '220px', height: '300px', background: 'transparent' });
					</script>
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
                    <h3 class="t"></h3>
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