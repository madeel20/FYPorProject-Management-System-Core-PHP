<?php
include 'sessions.php';

?>


    <?php
include 'temp_nav.php';
?>
<!--  page banner -->
  <section  class="page-banner-main-block" style="background-image: url('images/bg/page-banner.jpg'); ">
  	<div class="row">
    <div class="col-sm-4 text-center" style="float:left;"> <a href="changepassworduser.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span>&nbsp;Change Password</button></a>
    <a href="student_message.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Message</button></a>
  </div>
  <div class="col-sm-2" style="float:right;"> <a href="logout.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</button></a></div>

</div>
<div class="row">
<div class="col-sm-2" ></div>
  <div class="col-sm-8">
  	<center><p> Logged In:</p>
   <img src="<?php echo $_SESSION['img'];?>" style="width:120px; border-radius:50px;"/></center>
   <center> <h4 class=" text-center"><?php echo $_SESSION['name']; ?></h4></center>
   <br> <h2 class="page-banner-heading text-center">Student Panel:  </h2>
   </div>
  </section><br>
</div>
<!--  end page banner  -->
<div class="row">
	<div class="col-sm-2"></div>
<a href="addproject.php"><div class="col-sm-4 text-center"  style="font-size:20px;  border-right:5px solid white;  padding: 40px; background:#333333; color: white;"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Add a Project</div></a>
<a href="viewprojects.php">
<div class="col-sm-4 text-center" style="font-size: 20px; padding: 40px; background:#333333; color: white; " ><span class="glyphicon glyphicon-list-alt"></span> &nbsp;&nbsp;View Projects</div></a>
		   </div><br>
		   <div class="row">
		   <div class="col-sm-12 text-center" style="float:left;"> <a href="editdetails.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-user"></span>&nbsp;Edit Personal Info</button></a></div>

</div>
           <br>

<?php
include 'temp_footer.php';
?>