<?php
 $sql ="SELECT * FROM `tbl_projects` inner join tbl_student ON tbl_projects.studentid=tbl_student.id where tbl_projects.approve=1 and tbl_projects.status=1 ";
 $sql1 ="SELECT * FROM `tbl_projects` inner join tbl_supervisor ON tbl_projects.supervisorId=tbl_supervisor.id where tbl_projects.approve=1 and tbl_projects.status=1 ";
 if(isset($_POST['txtsearch'])){
  $txttosearch = $_POST['txtsearch'];
  $txtsearchby = $_POST['searchby'];

  $txtdiscipline  = $_POST['discipline'];
  if($txtdiscipline != 'ALL')
    $txtdiscipline = "and tbl_projects.discipline ='".$txtdiscipline."'";
  else $txtdiscipline='';
  $txttype = $_POST['type'];
  if($txttype != 'ALL')
    $txttype =  "and tbl_projects.type ='".$txttype."'";
  else $txttype='';

  if($txttosearch == ''){
   $sql = "SELECT * FROM `tbl_projects` inner join tbl_student ON tbl_projects.studentid=tbl_student.id where tbl_projects.approve=1 and tbl_projects.status=1 ".$txtdiscipline.$txttype ;
   $sql1 ="SELECT * FROM `tbl_projects` inner join tbl_supervisor ON tbl_projects.supervisorId=tbl_supervisor.id where tbl_projects.approve=1 and tbl_projects.status=1 ".$txtdiscipline.$txttype ;

  }
  else {
    $txtsearchby1='';
    if($txtsearchby=='Project Name'){
      $txtsearchby = "and tbl_projects.title like '%".$txttosearch."%'";
      $txtsearchby1 = "and tbl_projects.title like '%".$txttosearch."%'";
    }
      else if($txtsearchby=='Student'){
        $txtsearchby = "and tbl_student.fname like '%".$txttosearch."%' or tbl_student.lname LIKE '%".$txttosearch."%';";
        $txtsearchby1 = "and tbl_supervisor.fname like '%".$txttosearch."%' or tbl_supervisor.lname LIKE '%".$txttosearch."%';";
      }
    else if($txtsearchby=='Supervisor'){
      $txtsearchby = "and tbl_projects.supervisor like '%".$txttosearch."%' ";
      $txtsearchby1 = "and tbl_projects.supervisor like '%".$txttosearch."%' ";
    }
$sql = "SELECT * FROM `tbl_projects` inner join tbl_student ON tbl_projects.studentid=tbl_student.id where tbl_projects.approve=1 and tbl_projects.status=1 ".$txtdiscipline.$txttype .$txtsearchby;
$sql1 ="SELECT * FROM `tbl_projects` inner join tbl_supervisor ON tbl_projects.supervisorId=tbl_supervisor.id where tbl_projects.approve=1 and tbl_projects.status=1 ".$txtdiscipline.$txttype .$txtsearchby1;
  
}
  $txttosearch = $_POST['txtsearch'];
  $txtsearchby = $_POST['searchby'];

  $txtdiscipline  = $_POST['discipline'];
  $txttype = $_POST['type'];
 }

?>

<?php 

  ?>
    <?php
include 'temp_nav.php';
?>
<!--  page banner -->
  <section id="page-banner" class="page-banner-main-block" style="background-image: url('images/bg/page-banner.jpg')">
    <div class="row">
  <div class="col-sm-1 text-center" > </div>
    <div class="col-sm-10 text-center"><h1>Search Projects:</h1> 
      <br>
<form action="#" method="post">
  <table><tr><td colspan="2">
<div class="form-group">
  <label>&nbsp;</label>
                <input type="text" class="form-control"  name="txtsearch" placeholder="Search..." value="<?php
                 if(isset($_POST['txtsearch'])) echo $_POST['txtsearch'];
                  ?>" />
                  
              </div></td > 
              <td colspan="1">
<div class="form-group">
  <label>Search By :</label>
              <select class="form-control"   name="searchby">
             
             <option  <?php if(isset($txtsearchby) && $txtsearchby=='Project Name') echo 'selected'; ?> >Project Name</option>
<option <?php if(isset($txtsearchby) && $txtsearchby=='Student') echo 'selected="true"'; ?>>Student</option>
<option <?php if(isset($txtsearchby) && $txtsearchby=='Supervisor') echo 'selected'; ?>>Supervisor</option>

            </select> 
                    
                  </select></div></td>
                   <td colspan="1">
 <div class="form-group">
                <label>Discipline:</label>
                <select class="form-control" name="discipline">
                   <option <?php if(isset($txtdiscipline) && $txtdiscipline=='ALL') echo 'selected'; ?> value='ALL'>All </option>
                  <option  <?php if(isset($txtdiscipline) && $txtdiscipline=='Engineering') echo 'selected'; ?> value='Engineering'>Engineering</option>
                  <option <?php if(isset($txtdiscipline) && $txtdiscipline=='Non engineering') echo 'selected'; ?> value='Non engineering'>Non engineering </option>
                     
                       
                </select>
             
              </div></td>
              <td colspan="1">
              <div class="form-group">
                <label>Type :</label>
                <select class="form-control" name="type">
                   <option <?php if(isset($txttype) && $txttype=='ALL') echo 'selected'; ?>  value='ALL'> All </option>
                  <option <?php if(isset($txttype) && $txttype=='On Going') echo 'selected'; ?> value='On Going'> On Going </option>
                  <option <?php if(isset($txttype) && $txttype=='Completed') echo 'selected'; ?> value='Completed'> Completed </option>
                     <option <?php if(isset($txttype) && $txttype=='Dropped') echo 'selected'; ?> value='Dropped'> Dropped </option>
                        
                </select>
                
             
              </div></td>
                  <td colspan="1">
<div class="form-group">
   <label>&nbsp;</label><br><button class="btn btn-default" name="submit"  type="submit">
                <span class="glyphicon glyphicon-search"></span>&nbsp; Search</button></div></td></tr>
            </table>
</form>

    </div>
   <div class="col-sm-1"></div>
</div>
  </section> 
  <br>
<!--  end page banner  -->
<div class="row">

<div class="col-sm-12 text-center">
  <h2> Projects</h2>
  <?php
  include 'connection.php';
 
 $result = $con->query($sql);
 
 echo '<table style="margin-top:30px;" class="table table-bordered">
 <thead>
   <tr>
   <th style="color:green" >Sr#</th>
     <th style="color:green" >Project Name</th>
     <th style="color:green">Student Name</th>
     <th style="color:green">University</th>
     <th style="color:green">Supervisor</th>
     <th style="color:green">Discipline</th>
     
     <th style="color:green">Type</th>
     <th style="color:green">Website</th>

   </tr>
 </thead>
 <tbody>';
 $count=0;
if ($result->num_rows > 0) {
  
  
    // output data of each row
      

    while($row = $result->fetch_assoc()) {
      $count++;
      echo '<tr ">';
         echo '<td id="tdprj">'.$count.'</td>';
        echo '<td id="tdprj">'.$row['title'].'</td>';
        echo '<td id="tdprj">'.$row['fname'].' '.$row['lname'].'</td>';
        echo '<td id="tdprj">'.$row['university'].'</td>';
        echo '<td id="tdprj">'.$row['supervisor'].'</td>';
        echo '<td id="tdprj">'.$row['discipline'].'</td>';
        echo '<td id="tdprj">'.$row['type'].'</td>';
         echo '<td id="tdprj"><a>'.$row['website'].'</a></td>';
        
        echo '<td>'.'<form action="viewprjuserall.php" method="get"> <input type="hidden" name="prjid" value="'.$row['pid'].'" /><input type="hidden" name="prjnm" value="'.$row['title'].'" /><input  type="submit" value="View" class="btn-default" /></form>'.'</td>';
        

       
      echo '</tr>';
     
    }
}
$result = $con->query($sql1)or die($con->error);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $count++;
    echo '<tr ">';
       echo '<td id="tdprj">'.$count.'</td>';
      echo '<td id="tdprj">'.$row['title'].'</td>';
      echo '<td id="tdprj">';
      $sql2="select * from members  where pid=".$row['pid'];
      
      $result2 = $con->query($sql2);
      if ($result2->num_rows > 0) {
       
        while($row2 = $result2->fetch_assoc()) {
        
          echo $row2['fullname'];
          break;
        }}
echo '</td>';
      echo '<td id="tdprj">'.$row['university'].'</td>';
      echo '<td id="tdprj">'.$row['supervisor'].'</td>';
      echo '<td id="tdprj">'.$row['discipline'].'</td>';
      echo '<td id="tdprj">'.$row['type'].'</td>';
       echo '<td id="tdprj"><a>'.$row['website'].'</a></td>';
      
      echo '<td>'.'<form action="viewprjuserall.php" method="get"><input type="hidden" name="supervisorprj" value="'.$row['pid'].'" /> <input type="hidden" name="prjid" value="'.$row['pid'].'" /><input type="hidden" name="prjnm" value="'.$row['title'].'" /><input  type="submit" value="View" class="btn-default" /></form>'.'</td>';
      

     
    echo '</tr>';
   
  }

}


    if($count==0){
        echo '<center><h4> No Project Found!</h4></center>';

    }
    echo '</tbody></table>';
    
        ?>
    </div>
           </div>
<br>
<?php
include 'temp_footer.php';
?>