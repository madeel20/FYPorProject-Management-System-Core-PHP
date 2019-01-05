<?php
include 'sessions.php';
?>
<?php 
if(!isset($_POST['prjid'])){
	header('Location: viewprojects.php');
  exit();
}
	?>
    <?php
include 'temp_nav.php';
?>
<!--  page banner -->
  <section id="page-banner" class="page-banner-main-block" style="background-image: url('images/bg/page-banner.jpg')">
  	<div class="row">
  <div class="col-sm-2 text-center" style="float:left;"> <a href="viewprojects.php"><button type="submit" class="btn btn-default">Back</button></a></div>
  
    <div class="col-sm-6"></div>
 <div class="col-sm-2" style="float:right;"> <a href="logout.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</button></a></div>
<div class="col-sm-8">
    <center><p> Logged In:</p>
   <img src="<?php echo $_SESSION['img'];?>" style="width:120px; border-radius:50px;"/></center>
   <center> <h4 class=" text-center"><?php echo $_SESSION['name']; ?></h4></center>
   <br> <h2 class="page-banner-heading text-center">Supervisor Panel:  </h2>
  
 <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8 text-center">
   <h2 class="page-banner-heading  text-center">  </h2><p> View Project:</p>
   </div>
   <div class="col-sm-2"></div>
</div>
  </section> 
  <br>
<!--  end page banner  -->
<div class="row">

<div class="col-sm-12">
  <div class="col-sm-8">
  <?php
  include 'connection.php';
  $sql ="SELECT * FROM `tbl_projects` inner join tbl_supervisor ON tbl_projects.supervisorId=tbl_supervisor.id where pid=".$_POST['prjid'];
 $result = $con->query($sql);

if ($result->num_rows > 0) {
	echo '<table style="margin-top:30px;" class="table table-bordered">
      <tbody>';
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($row['approve']==0)
        $apptext = 'No';
      else $apptext = 'Yes';
    	echo '<tr> <th colspan=1>Project Name: </th>';
      echo '<td colspan=2 ><h2>'.$row['title'].'</h2></td></tr>';
         echo '<tr> <th colspan=1>University: </th>';
        echo '<td colspan=2 >'.$row['university'].'</td></tr>';
        echo '<tr> <th colspan=1 > Supervisor: </th>';
        echo '<td colspan=2  >'.$row['supervisor'].'</td></tr>';
        echo '<tr> <th colspan=1 > Members: </th>';
        
          echo '<td colspan=2 >';
          $sql = 'select * from members where pid='.$row['pid'];
          $result1 = $con->query($sql);
         
         if ($result1->num_rows > 0) {
           $k=1;
          while($row1 = $result1->fetch_assoc()){
          echo $k.':'." ".$row1['fullname']."<br>";
          
          $k++;
        }
        echo '</td></tr>';
        }
      
         echo '<tr> <th colspan=1> Discipline: </th>';
        echo '<td colspan=2 >'.$row['discipline'].'</td></tr>';
         echo '<tr> <th colspan=1> Thematic Area: </th>';
        echo '<td colspan=2>'.$row['area'].'</td></tr>';
        echo '<tr> <th colspan=1> Type: </th>';
        echo '<td colspan=2>'.$row['type'].'</td></tr>';
        echo '<tr> <th colspan=1> Academic or Research: </th>';
        echo '<td colspan=2>'.$row['type2'].'</td></tr>';
        echo '<tr> <th colspan=1> Pubic or Private: </th>';
        echo '<td colspan=2>'.$row['scope'].'</td></tr>';
         echo '<tr> <th colspan=1> website: </th>';
         echo '<td colspan=2 >'.$row['website'].'</td></tr>';
          echo '<tr> <th colspan=1> Date Added: </th>';
         echo '<td colspan=2  >'.$row['dateadded'].'</td></tr>';
         echo '<tr> <th colspan=1> Student name: </th>';
         echo '<td colspan=2  >'.$row['username'].'</td></tr>';
         echo '<tr> <th colspan=1> Start Date: </th>';
         echo '<td colspan=2  >'.$row['startdate'].'</td></tr>';
         echo '<tr> <th colspan=1> End Date: </th>';
         echo '<td colspan=2  >'.$row['enddate'].'</td></tr>';
         echo '<tr> <th colspan=1>Project File: </th>';
         echo '<td colspan=2  ><a href="..\\projectFiles/'.$row['projectfile'].'" > Download </a></td></tr>';
             echo '<tr > <th colspan=3> <h2>Overview:</h2> </th></tr>';
         echo '<tr><td colspan=3 style="font-size:25px;" >'.$row['overview'].'</td></tr>';
         echo '<tr> <th colspan=3> <h2>Details:</h2> </th></tr>';
         echo '<tr><td colspan=3 style="font-size:25px;" >'.$row['details'].'</td></tr>';

        
          $tt = $row['title'];
          $uu = $row['username'];
         
    }
    echo '</tbody></table>';
    $sql= "SELECT  DISTINCT src FROM `images` WHERE usprj ='".$uu.'_'.$tt."' ";
    
          $imghtml='';
         $result= $con->query($sql);
          if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
     $imghtml .= '<img style="width:100%; float:left; margin-bottom:15px;" src="..\projects/'.$uu.'_'.$tt.'_'.$row['src'].'" />';
      
    }
    // output data of each row
   }
   else{
    $imghtml = '<center><p> No Screenshot to show!</p></center>';
   }
}
    
        ?>
      </div>
      <div class="col-sm-4">
<?php echo $imghtml;?>
      </div>
    </div>
          </div>
<br>
<?php
include 'temp_footer.php';
?>