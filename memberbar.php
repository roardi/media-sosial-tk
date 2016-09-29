<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v3.0.0.39952
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>BPS Media Sosial</title>
    <meta name="description" content="Description" />
    <meta name="keywords" content="Keywords" />
	
	<link rel="shortcut icon" a href="images/logo-bps.jpg" />
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
						loadingImage : " facebox1.2/src/loading.gif" ,
						closeImage   : " facebox1.2/src/del.jpg" 
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
			<a href="#" ><span class="l"></span><span class="r"></span>
			<span class="t"><font color="#000000" size="2">Notification</font></span></a>
			<ul>
				<li>
					<?php
						$member_id = $_SESSION['member_id'];
						$sent = mysqli_query($con,"SELECT * FROM messages WHERE recipient_id = '$member_id'")or die(mysqli_error());
						$senta = mysqli_num_rows($sent);
						$received = mysqli_query($con,"SELECT * FROM messages WHERE receiver_id = '$member_id'")or die(mysqli_error());
						$receiveda = mysqli_num_rows($received);
					?>
					<a href="mails.php?id=<?php echo $member_id;?>" ><span class="l"></span><span class="r"></span>
					<span class="t"><font color="#000000" size="2">Messages (<?php echo $receiveda; ?>)</font></span></a>
				</li>
				
				<li>
					<a href="updates.php"><span class="l"></span><span class="r"></span>
					<span class="t"><font color="#000000" size="2">Friendly Request(<?php 
					
					$member_id=$_SESSION['member_id'];
					$seeall=mysqli_query($con,"SELECT * FROM friends WHERE friends_with='$member_id' AND status='unconf'") or die(mysqli_error());
					$pila=mysqli_num_rows($seeall);
					echo $pila; ?>)</font></span></a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#"><span class="l"></span><span class="r"></span><span class="t">
			<font color="#000000" size="2">Groups</font></span></a>
			<ul>
				<li>
					<?php
						$member_id = $_SESSION['member_id'];
							$group = mysqli_query($con,"SELECT * FROM groupmembers WHERE member_id = '$member_id' AND status='1'")or die(mysqli_error());
							while($groupa = mysqli_fetch_array($group)){
								$groups = $groupa['group_id'];
								$groupb = mysqli_query($con,"SELECT * FROM groups WHERE group_id = '$groups' ORDER BY group_name ASC")or die(mysqli_error());
								$groupl = mysqli_fetch_array($groupb);
								echo '<li> <a href=groups.php?id='.$groupl["group_id"].' style = "text-decoration:none;">'.$groupl['group_name'].' </a></li>';
							}
					?>
				</li>
			</ul>
		</li>
		<li>
			<a href="userprofiletest.php?id=<?php echo"$member_id"?>"><span class="l"></span><span class="r"></span><span class="t"><font color="#000000" size="2">Profile</font></span></a>
		</li>
		<li>
			<a href="logout.php" ><span class="l"></span><span class="r"></span><span class="t"><font color="#000000" size="2">Log-out</font></span></a>
			
		</li>	
		<li>
			<a href="" ><span class="l"></span><span class="r"></span><span class="t"><font color="#000000" size="2">
			<?php
				$member_id = $_SESSION['member_id'];
					$sql = mysqli_query($con,"SELECT * FROM members WHERE member_id = '$member_id'")or die(mysqli_error());
					$data = mysqli_fetch_array($sql);
						echo "(".$data['firstname']." ".$data['lastname'].")";
			?>
			</font></span></a>
		</li>
	</ul>
</div>
</div>
<div class="cleared reset-box"></div>