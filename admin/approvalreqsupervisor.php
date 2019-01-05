<?php
include 'sessions.php';
?>

<?php 
if(isset($_POST['usapp'])){
	$us= $_POST['usapp'];

$sql = "update `tbl_supervisor` set approve=1 where  username='".$us."' ";
$con->query($sql);
}
if(isset($_POST['usdel'])){
	$us= $_POST['usdel'];

$sql = "delete from `tbl_supervisor` where  username='".$us."' ";
if($con->query($sql)==true){
  $file = $_POST['img'];
unlink($file);
};
}

	?>
    <?php
include 'temp_nav.php';
?>
<!--  page banner -->
  <section id="page-banner" class="page-banner-main-block" style="background-image: url('..\images/bg/page-banner.jpg')">
  	<div class="row">
  <div class="col-sm-2 text-center" style="float:left;"> <a href="supervisors.php"><button type="submit" class="btn btn-default">Back</button></a></div>
  
 <div class="col-sm-2" style="float:right;"> <a href="logout.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</button></a></div></div>
 <div class="row">
 	<div class="col-sm-2"></div>
 	<div class="col-sm-8 text-center">
   <h2 class="page-banner-heading  text-center">Admin Panel:  </h2><p> Approval Requests(Supervisor):</p>
   </div>
   <div class="col-sm-2"></div>
</div>
  </section> 
  <br>
<!--  end page banner  -->
<div class="row">
<div class="col-sm-1">
</div>
<div class="col-sm-10">
  <?php
  $sql ="select * from tbl_supervisor where approve=0";
 $result = $con->query($sql);

if ($result->num_rows > 0) {
	echo '<table style="margin-top:30px;" class="table table-bordered">
      <thead>
        <tr>
         <th style="color:green" >Sr#</th>
          <th style="color:green" >Profile Pic</th>
          <th style="color:green">First Name</th>
          <th style="color:green">Last Name</th>

          <th style="color:green">username</th>
        <th style="color:green">University</th>
          
          <th style="color:green">Country</th>
          <th style="color:green">Date and Time</th>
        </tr>
      </thead>
      <tbody>';
      $count=1;
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo '<tr>';
        echo '<td id="tdprj">'.$count.'</td>';
    	echo '<td>'.'<img src="'.$row['img'].'" style="width:70px; height:80px;"/> </td>';
        echo '<td>'.$row['fname'].'</td>';
        echo '<td>'.$row['lname'].'</td>';
        echo '<td>'.$row['username'].'</td>';
        echo '<td>'.$row['university'].'</td>';
        echo '<td>'.$row['country'].'</td>';
        echo '<td>'.$row['regdate'].'</td>';
        
        
        echo '<td>'.'<form action="#" method="post"> <input type="hidden" name="usapp" value="'.$row['username'].'" /><input type="submit" value="Approve" class="btn-default" /></form>'.'</td>';
          echo '<td>'.'<form action="viewsupervisor.php" method="post"> <input type="hidden" name="userid" value="'.$row['id'].'" /><input type="hidden" name="fromreq" value="'.$row['id'].'" /><input  type="submit" value="View" class="btn-default" /></form>'.'</td>';
          echo '<td>'.'<form action="editsupervisor.php" method="post"> <input type="hidden" name="userid" value="'.$row['id'].'" /><input  type="submit" value="Edit" class="btn-default" /></form>'.'</td>';

          echo '<td>'.'<form action="#" method="post"> <input type="hidden" name="img" value="'.$row['img'].'" /> <input type="hidden" name="usdel" value="'.$row['username'].'" /><input style="background:red;" type="submit" value="Delete" class="btn-default" /></form>'.'</td>';

       
    	echo '</tr>';
      $count++;
    }
echo '</tbody></table>';}
    else {
        echo '<center><h1> No Request Yet!</h1></center>';

    }
    
        ?>
    </div>
            <div class="col-sm-2"></div></div>
<br>
<?php
include 'temp_footer.php';
?>