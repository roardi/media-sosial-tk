<?php
session_start();
require('function.php');
require('connection.php');
	$v_username= "";
 	$v_firstname = "";
	$v_lastname = "";
	$v_password = "";
	$v_passwordRetype = "";
	$v_email= "";
	$v_gender = "";
	
	
	/***********/
	$username = "";
	$firstname = "";
	$lastname = "";
	$password = "";
	$passwordRetype = "";
	$email = "";
	$gender = "";
	

if (isset($_POST['Submit'])){
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$password = $_POST['password'];
$passwordRetype = $_POST['passwordRetype'];
$email = $_POST['url'];
$gender = $_POST['gender'];
$pattern = "/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i";

//validation start
	if ($firstname=="") {
		$v_firstname	= "<font color='red'>Required Field <br /> </font>";
	} else
		{
		$v_firstname	= "";
		}
	if ($lastname=="") {
		$v_lastname= "<font color='red'>Required Field <br /> </font>";
	} else {
		$v_lastname= "";
	}
	if ($password=="") {
		$v_password= "<font color='red'>Required Field <br /> </font>";
	} else {
		$v_password= "";
	}	
	if ($password!=$passwordRetype) {
		$v_passwordRetype= "<font color='red'>Password did not match! <br /> </font>";
	} else {
		$v_passwordRetype= "";
	}			
	if ($gender=="") {
		$v_gender= "<font color='red'>Required Field <br /> </font>";
	} else {
		$v_gender= "";
	}
	if ($email=="") {
		$v_email= "<font color='red'>Required Field <br /> </font>";
	} else {
		$v_email= "";
	}
	if ($username=="") {
		$v_username= "<font color='red'>Required Field <br /> </font>";
	} else {
		$v_username= "";
	}
	
	
	if ($firstname!="" && $lastname!= "" && $password == $passwordRetype && $username!= "" && $email!= "" && $gender!= ""){
	
	$checkme=mysqli_query($con,"SELECT * FROM members WHERE username = '$username'") or die(mysqli_error());
	$checkmyid=mysqli_num_rows($checkme);
		if($checkmyid > 0){
			header("location:checkid.php");
		}else{
	
			mysqli_query($con,"INSERT INTO members (username, password, firstname, lastname, url, gender, status_id,account_status)
			VALUES ('$username','$password','$firstname','$lastname','$email','$gender','0','1')")or die(mysqli_error());
			echo $username;
			$wewness = mysqli_query($con,"SELECT * FROM members WHERE username = '$username'")or die(mysqli_error());
			$getid = mysqli_fetch_array($wewness);
			$_SESSION['member_id'] = $getid['member_id'];
			$_SESSION['login'] = 'true';
			//$_SESSION['member_id'] = $member_id;
			header("location:registerexec.php");
			
			}
	}
	
}
if(isset($_POST['login'])){
		
			$username = $_POST['studid'];	
			$pass = $_POST['password'];
			
			$query2 = mysqli_query($con, "SELECT * FROM members WHERE username = '$username' AND password = '$pass' ") or die (mysqli_error());
			
			while($studid = mysqli_fetch_object($query2))
				{
				//echo "$studid->member_id";
				}
				$numberOfRows = mysqli_num_rows($query2);
				if ($numberOfRows == 0){
					$sql = "SELECT * FROM admin WHERE username='$username' and password='$pass'";
					$result=mysqli_query($con,$sql)or die(mysqli_error());
					$getid = mysqli_fetch_array($result);
					$count=mysqli_num_rows($result);
					if ($count==1){
						$_SESSION['login'] = 'admin';
						$_SESSION['member_id'] = $getid['admin_id'];
						header("location: adminhome.php");
					}
					else {
						$sql = "SELECT * FROM admingroup WHERE username='$username' and password='$pass'";
						$result=mysqli_query($con,$sql)or die(mysqli_error());
						$getid = mysqli_fetch_array($result);
						$count=mysqli_num_rows($result);
						if ($count==1){
							$_SESSION['login'] = 'admingroup';
							$_SESSION['member_id'] = $getid['admingroup_id'];
							header("location: grouphome.php");}
					}
				}
				else if ($numberOfRows > 0){
					$wewness = mysqli_query($con,"SELECT * FROM members WHERE username = '$username'")or die(mysqli_error());
					$getid = mysqli_fetch_array($wewness);
					if($getid['account_status']==0){
						$_SESSION['login'] = 'maybe';
						$_SESSION['member_id'] = $getid['member_id'];
						//$_SESSION['memberid'] = $getid['member_id'];
						header('location:registerexec.php');
					}elseif($getid['account_status']==2){
						$_SESSION['login'] = 'true';
						$_SESSION['member_id'] = $getid['member_id'];
						//$_SESSION['studentid'] = $getid['student_id'];
						header('location:hometest.php');
					
					}elseif($getid['account_status']==1){
						$_SESSION['login'] = 'maybe';
						$_SESSION['member_id'] = $getid['member_id'];
						//$_SESSION['studentid'] = $getid['student_id'];
						header('location:fill.php');
					
					}
				}
}
					
?>
<!DOCTYPE html PUBLIC "-//W3C//D XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/D/xhtml1-transitional.d"[]>
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

    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
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
					<h1 class="art-logo-name"></h1>
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
							<form id="loginForm" name="loginForm" method="post" action=""> 
								<font color="#000000" size="2">Username: </font>
								<input style="height:24px; width:100px;" name="studid" type="text" class="username" />
								<font color="#000000" size="2">Password: </font>
								<input style="height:24px; width:100px;" name="password" type="password" class="password" />
								<label>
									<input style="width:54px;" name="login" type="submit" id="login" value="Log-in" />
								</label>
						</li>
					</form>		
	</ul>
</div>
</div>
<div class="cleared reset-box"></div>
<div class="art-content-layout">
                <div class="art-content-layout-row">
                    
					
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
	<div class="cleared"></div>
    </div>
	<div class="art-layout-cell art-content">
		<div class = "goodmorningsaiyo">
		<div class="g"></div>
		</div>
		
		<div class="cleared"></div>
	</div>
                    <div class="art-layout-cell art-sidebarlog">
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
                    <h3 class="t">Register Here</font></h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-body">
                <div>
				  <form method="post">
					<br><br>
					<table align="center">
					<tr>
						<td width="100" height="30">Username:</td>
						<td><input  class="lastname"  type="text" name="username" id="inputtype"  value="<?php echo $username; ?>" /><?php echo $v_username; ?></td>
					</tr>
						<td width="100" height="30">Firstname:</td>
						<td><input type="text" name="firstname" id="inputtype"   class="firstname" value="<?php echo $firstname; ?>" /><?php echo $v_firstname; ?></td>
					</tr>
						<td width="100" height="30">Lastname:</td>
						<td><input  class="lastname"  type="text" name="lastname" id="inputtype"    value="<?php echo $lastname; ?>" /><?php echo $v_lastname; ?></td>
					</tr>
						<td width="100" height="30">Email:</td>
						<td><input type="text" class="url"  name="url" id="inputtype"   />
							<?php if(isset($error['status'])){ echo $error['status'];} ?></td>
					</tr>
						<td width="100" height="30">Password:</td>
						<td><input  class="password"  type="password" name="password" id="inputtype"   value="<?php echo $password; ?>" /><?php echo $v_password; ?></td>
					</tr>
						<td width="100" height="30">Retype:</td>
						<td><input type="password"  class="passwordRetype"  name="passwordRetype" id="inputtype"   value="<?php echo $passwordRetype; ?>" /><?php echo $v_passwordRetype; ?></td>
					</tr>
						<td width="100" height="30">Gender:</td>
						<td><select name="gender" class="gender" value="<?php echo $gender; ?>" ><?php echo $v_gender; ?>
										<option>Male</option>
										<option>Female</option>
										</select></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="Submit" id="signup"   value="Sign up" /></td>
					</tr>
					</table>
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