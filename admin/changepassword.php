<?php
include 'sessions.php';
$error = "";
if(isset($_POST['oldpwd'])){
$oldpassword = $_POST['oldpwd'];
$newpassword = $_POST['newpwd'];
$rnewpassword = $_POST['rnewpwd'];
$sql = "select * from tbl_admin";
$result = $con->query($sql);
while($row = $result->fetch_assoc()){
$pwd = $row['pass'];
if($pwd == $oldpassword){
	if($newpassword == $rnewpassword){
		$sql = "UPDATE `tbl_admin` SET `pass`= '".$newpassword."' WHERE username='admin'";
		$con->query($sql);
		$error = "Password Changed!";	
		
		
	}
	else {
		$error = "New passwords does not matched!";
	}
	
}
else {
	$error = "Old Password is incorrect!";
	
}
	
}
}

	

?><?php
include 'temp_nav.php';
?>
<section id="page-banner" class="page-banner-main-block" style="background-image: url('..\images/bg/page-banner.jpg')">
  <div class="col-sm-2" style="float:left;"> <a href="admin.php"><button type="submit" class="btn btn-default">Back</button></a></div>
  <div class="col-sm-8">
   <br> <h2 class="page-banner-heading text-center">Admin Panel:  </h2>
   </div>
 <div class="col-sm-2" style="float:right;"> <a href="logout.php"><button type="submit" class="btn btn-default">Log Out</button></a></div>
  </section> 
<center><h1> Change Password: </h1></center>
<div class="container" style="font-size:25px;">
<form action="#" method="post">
Username: <input class="form-control" type="text" value="admin" disabled readonly>
Old Password: <input class="form-control" type="password"  placeholder="Enter your old password..." name="oldpwd" autofocus required>
New Password: <input class="form-control" type="password" placeholder="Enter your new password..." name="newpwd" required>
Retype Password: <input class="form-control" type="password" name="rnewpwd" placeholder="Re-Enter your new password" required> 
<input class="btn btn-default" type="submit">
</form>
<p style="color:red;" > <?php echo $error; ?></p>



</div>






<br>
<?php
include 'temp_footer.php';
?>