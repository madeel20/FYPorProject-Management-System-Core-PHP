<?php
include 'sessions.php';
?>

    <?php
include 'temp_nav.php';
?>
<!--  page banner -->
  <section id="page-banner" class="page-banner-main-block" style="background-image: url('..\images/bg/page-banner.jpg')">
  	<div class="row">
  <div class="col-sm-2 text-center" style="float:left;"> <a href="changepassword.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-wrench"></span> &nbsp;Change Password</button></a></div>
  
 <div class="col-sm-2" style="float:right;"> <a href="logout.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</button></a></div></div>
 <div class="row">
 	<div class="col-sm-2"></div>
 	<div class="col-sm-8">
   <h2 class="page-banner-heading  text-center">Admin Panel:  </h2>
   </div>
   <div class="col-sm-2"></div>
</div>
  </section> 
  <br>
<!--  end page banner  -->
<div class="row">
<div class="col-sm-2">
</div>
<a href="selectuser.php"><div class="col-sm-4 text-center"  style="font-size:20px;  border-right:5px solid white;  padding: 40px; background:#333333; color: white;"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Manage Users</div></a>
<a href="projects.php">
<div class="col-sm-4 text-center" style="font-size: 20px; padding: 40px; background:#333333; color: white; " ><span class="glyphicon glyphicon-list-alt"></span> &nbsp;&nbsp;Manage Projects</div></a>
            <div class="col-sm-2"></div></div>
<br>
<?php
include 'temp_footer.php';
?>