<?php
if(!isset($_GET['prjid']))
header('Location: searchprojects.php');
?>

<?php 
	?>
    <?php
include 'temp_nav.php';
?>
<!--  page banner -->
  <section id="page-banner" class="page-banner-main-block" style="background-image: url('images/bg/page-banner.jpg')">
  	<div class="row">
  <div class="col-sm-2 text-center" style="float:left;"> <a href="searchprojects.php"><button type="submit" class="btn btn-default">Back</button></a></div>
  <div class="col-sm-8 text-center">
   <h2 class="page-banner-heading  text-center"> <?php echo $_GET['prjnm'];?> </h2>
   </div> 
   <div class="col-sm-2"></div>
</div>
  </section> 
  <br>
<!--  end page banner  -->
<div class="row">
<div class="col-sm-12">
  
  <?php
  include 'connection.php';
  if(isset($_GET['supervisorprj']))
  $sql ="SELECT * FROM `tbl_projects` inner join tbl_supervisor ON tbl_projects.supervisorId=tbl_supervisor.id where pid=".$_GET['prjid'];
else
  $sql ="SELECT * FROM `tbl_projects` inner join tbl_student ON tbl_projects.studentid=tbl_student.id where pid=".$_GET['prjid'];
   
  
  $result = $con->query($sql) or die($con->error);

if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($row['scope']=='Public'){
        echo '<div class="col-sm-8 " ><table style="margin-top:30px;" class="table table-bordered">
        <tbody>';
      if($row['approve']==0)
        $apptext = 'No';
      else $apptext = 'Yes';
    	
         echo '<tr> <th colspan=1>University: </th>';
        echo '<td colspan=2 >'.$row['university'].'</td></tr>';
        echo '<tr> <th colspan=1 > Supervisor: </th>';
        echo '<td colspan=2  >'.$row['supervisor'].'</td></tr>';
        echo '<tr> <th colspan=1 > Members: </th>';
        if($row['members']=='Individual')
        echo '<td colspan=2  >'.$row['members'].'</td></tr>';
        else {
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
         if(!isset($_GET['supervisorprj'])){
          echo '<tr> <th colspan=1> Student name: </th>';
          echo '<td colspan=2  >'.$row['username'].'</td></tr>';
         }
         
         echo '<tr> <th colspan=1> Start Date: </th>';
         echo '<td colspan=2  >'.$row['startdate'].'</td></tr>';
         echo '<tr> <th colspan=1> End Date: </th>';
         echo '<td colspan=2  >'.$row['enddate'].'</td></tr>';
             echo '<tr > <th colspan=3> <h2>Overview:</h2> </th></tr>';
         echo '<tr><td colspan=3 style="font-size:25px;" >'.$row['overview'].'</td></tr>';
             echo '<tr> <th colspan=3> <h2>Details:</h2> </th></tr>';
         echo '<tr><td colspan=3 style="font-size:25px;" >'.$row['details'].'</td></tr>';
         ;
          $tt = $row['title'];
          $uu = $row['username'];
          echo '</tbody></table></div>';
    }
    else {
      
        
             echo '<div class="col-sm-12 text-center"><tr> <th colspan=3> <h2>Overview:</h2> </th></tr>';
         echo '<tr><td colspan=3 style="font-size:25px;" >'.$row['overview'].'</td></tr>';
             echo '<tr> <th colspan=3> <h2>Details:</h2> </th></tr>';
         echo '<tr><td colspan=3 style="font-size:25px;" >'.$row['details'].'</td></tr></div>';
       
    }
  }
  
    $imghtml='';
    
    
          
          if(isset($tt)){
            $sql= "SELECT  DISTINCT src FROM `images` WHERE usprj ='".$uu.'_'.$tt."' ";

               $result= $con->query($sql);
          if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
     $imghtml .= '<img style="width:100%; float:left; margin-bottom:15px;" src="projects/'.$uu.'_'.$tt.'_'.$row['src'].'" />';
      
    }
    // output data of each row
   }
   else{
    $imghtml = '<center><p> No Screenshot to show!</p></center>';
   }
}
}   
    
        ?>
      
      <div class="col-sm-4">
<?php echo $imghtml;?>
      </div>
    </div>
          </div>
<br>
<?php
include 'temp_footer.php';
?>