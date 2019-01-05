<?php
include 'sessions.php';
?>

<?php 
if(!isset($_POST['userid'])){
	header('Location: admin.php');
  exit();
}
	?>
    <?php
include 'temp_nav.php';
?>
<!--  page banner -->
  <section id="page-banner" class="page-banner-main-block" style="background-image: url('..\images/bg/page-banner.jpg')">
  	<div class="row">
  <div class="col-sm-2 text-center" style="float:left;"> <a href="<?php if(isset($_POST['fromprj'])) echo 'users.php'; else echo 'approvalreq.php';?>"><button type="submit" class="btn btn-default">Back</button></a></div>
  
 <div class="col-sm-2" style="float:right;"> <a href="logout.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</button></a></div></div>
 <div class="row">
 	<div class="col-sm-2"></div>
 	<div class="col-sm-8 text-center">
   <h2 class="page-banner-heading  text-center">Admin Panel:  </h2><p>View User:</p>
   </div>
   <div class="col-sm-2"></div>
</div>
  </section> 
  <br>
<!--  end page banner  -->
<div class="row">
  <div class="col-sm-2">
  </div>
<div class="col-sm-8">
  <?php
  $sql ="SELECT * FROM `tbl_student`  where id=".$_POST['userid'];
 $result = $con->query($sql);

if ($result->num_rows > 0) {
	echo '<table style="margin-top:30px;" class="table table-bordered">
      <tbody>';
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo '<tr> <td colspan="3" style="text-align:center;"> <img src="'.$row['img'].'" style="width:150px; " /><h2>Username:  ';
     echo ''.$row['username'].'</h2></td></tr>';
     echo '<tr> <th colspan=1>First Name: </th>';
        echo '<td colspan=2 >'.$row['fname'].'</td></tr>';
        echo '<tr> <th colspan=1 > Last Name: </th>';
        echo '<td colspan=2  >'.$row['lname'].'</td></tr>';
         echo '<tr> <th colspan=1> Gender: </th>';
        echo '<td colspan=2 >'.$row['gender'].'</td></tr>';
         echo '<tr> <th colspan=1> University: </th>';
        echo '<td colspan=2>'.$row['university'].'</td></tr>';
        echo '<tr> <th colspan=1> Country: </th>';
        echo '<td colspan=2>'.$row['country'].'</td></tr>';
         echo '<tr> <th colspan=1> Qualifications: </th>';
         echo '<td colspan=2 >'.$row['qualifications'].'</td></tr>';
         
         echo '<tr> <th colspan=1> Email: </th>';
         echo '<td colspan=2  >'.$row['email'].'</td></tr>';
          echo '<tr> <th colspan=1> Registration Date: </th>';
         echo '<td colspan=2  >'.$row['regdate'].'</td></tr>';
          echo '<tr> <th colspan=1> Username: </th>';
         echo '<td colspan=2  >'.$row['username'].'</td></tr>';
          echo '<tr> <th colspan=1> Password: </th>';
         echo '<td colspan=2  >'.$row['pass'].'</td></tr>';
       


    }
echo '</tbody></table>';}
    
        ?>
    </div>
          </div>
<br>
<?php
include 'temp_footer.php';
?>