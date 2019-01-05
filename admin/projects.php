<?php
include 'sessions.php';
?>

<?php 
if(isset($_POST['usapp'])){
  if(isset($_POST['status'])){
      $ustatus =1;
    }
    else {
    $ustatus = 0;
    }
  $us= $_POST['usapp'];
$sql = "update `tbl_projects` set status=".$ustatus.' where  pid='.$us;
$con->query($sql);
}
if(isset($_POST['usdel'])){
 $us= $_POST['usdel'];
$sql = "delete from `tbl_projects` where  pid=".$us." ";
if($con->query($sql)==true){
  $usr = $_POST['usr'];
  $prnm = $_POST['prnm'];

$sql = "select * from images where usprj='".$usr.'_'.$prnm."'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    unlink('..\projects/'.$usr.'_'.$prnm.'_'.$row['src']);
  }}
$sql = "delete from images where usprj='".$usr.'_'.$prnm."'";
$con->query($sql);
$sql = "delete from members where pid=".$us;
$con->query($sql);
if($_POST['prfl']!='')
unlink('..\projectFiles/'.$_POST['prfl']);
};
}

  ?>
    <?php
include 'temp_nav.php';
?>
<script type="text/javascript">
         <!--
            function getConfirmation(form,prjnm){
               var retVal = confirm("Do you want to Delete the project: "+ prjnm+" ?");
               if( retVal == true ){
                  form.submit();
               }
               else{
                 
                  return false;
               }
            }
         //-->
      </script>
<!--  page banner -->
  <section id="page-banner" class="page-banner-main-block" style="background-image: url('..\images/bg/page-banner.jpg')">
    <div class="row">
  <div class="col-sm-2 text-center" style="float:left;"> <a href="admin.php"><button type="submit" class="btn btn-default"> Back</button></a></div>
  <div class="col-sm-2" style="float:left;"> <a href="approvalreqprj.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-bell"></span> &nbsp;Approval Requests (<?php
   $sql = "select title from tbl_projects where approve=0";
$result = $con->query($sql);
$k=0;
  if($result->num_rows>0){
  
    while($row = $result->fetch_assoc()) {
    
        $k++;
    
    }
    
}

echo $k;
    ?>)</button></a></div>
    <div class="col-sm-6"></div>
 <div class="col-sm-2" style="float:right;"> <a href="logout.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</button></a></div></div>
 <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8 text-center">
   <h2 class="page-banner-heading  text-center">Admin Panel:  </h2><p> All Projects:</p>
   </div>
   <div class="col-sm-2"></div>
</div>
  </section> 
  <br>
<!--  end page banner  -->
<div class="row">
<div class="col-sm-12">
  <?php
  $sql ="SELECT * FROM `tbl_projects` inner join tbl_student ON tbl_projects.studentid=tbl_student.id where tbl_projects.approve=1 order by status desc";
 $result = $con->query($sql); 
echo ' <tr><th colspan=13><center><h3> From Students</h3></center> </th></tr>';
if ($result->num_rows > 0) {
  echo '<table style="margin-top:30px;" class="table table-bordered">
      <thead>
     
        <tr>
         
        <th style="color:green" >Sr#</th>
          <th style="color:green" >Project Name</th>
          <th style="color:green">User</th>
          <th style="color:green">University</th>
          <th style="color:green">Supervisor</th>
          <th style="color:green">Discipline</th>
          
          <th style="color:green">Area</th>
          <th style="color:green">Website</th>
          <th style="color:green ; text-align:center;"  colspan="3">Status</th>

        </tr>
      </thead>
      <tbody>';
    // output data of each row
      $count=1;

    while($row = $result->fetch_assoc()) {
      echo '<tr ">';
         echo '<td id="tdprj">'.$count.'</td>';
        echo '<td id="tdprj">'.$row['title'].'</td>';
        echo '<td id="tdprj">'.$row['username'].'</td>';
        echo '<td id="tdprj">'.$row['university'].'</td>';
        echo '<td id="tdprj">'.$row['supervisor'].'</td>';
        echo '<td id="tdprj">'.$row['discipline'].'</td>';
        echo '<td id="tdprj">'.$row['area'].'</td>';
         echo '<td id="tdprj">'.$row['website'].'</td>';
        
        if($row['status']==0){
           $st = '';
          $status=' Not Active';
        }
        else {
           $st = 'checked';
          $status = ' Active ';
        }
        echo '<form action="#" method="post"><td>'.$status. '</td><input type="hidden" name="usapp" value="'.$row['pid'].'"/>'. '<td><input type="checkbox" name="status" value="'.$row['active'].'" '.$st.' /></td>  <td><input type="submit" class="btn btn-warning" value="Save" name="savestatus"></form>'.'</td>';
        echo '<td>'.'<form action="viewprj.php" method="post"> <input type="hidden" name="prjid" value="'.$row['pid'].'" /><input type="hidden" name="fromprj" value="'.$row['pid'].'" /><input  type="submit" value="View" class="btn-default" /></form>'.'</td>';
         echo '<td>'.'<form action="#" method="post">  <input type="hidden" name="prfl" value="'.$row['projectfile'].'" /><input type="hidden" name="usdel" value="'.$row['pid'].'" /><input type="hidden" name="usr" value="'.$row['username'].'" /><input type="hidden" name="prnm" value="'.$row['title'].'" /><input style="background:red;" type="button" value="Delete" class="btn-default" onclick="getConfirmation(this.form,\''.$row['title'].'\');" /></form>'.'</td>';

       
      echo '</tr>';
      $count++;
    }
echo '</tbody></table>';}
    else {
        echo '<center><h1> No Project Yet!</h1></center>';

    }
    
        ?>
    </div><br>

    <div class="col-sm-12">
  <?php
  $sql ="SELECT * FROM `tbl_projects` inner join tbl_supervisor ON tbl_projects.supervisorId=tbl_supervisor.id where tbl_projects.approve=1 order by status desc";
 $result = $con->query($sql) or die($con->error);
echo ' <tr><th colspan=12><center><h3> From Supervisors</h3></center> </th></tr>';
if ($result->num_rows > 0) {
  echo '<table style="margin-top:30px;" class="table table-bordered">
      <thead>
     
        <tr>
         
        <th style="color:green" >Sr#</th>
          <th style="color:green" >Project Name</th>
          <th style="color:green">University</th>
          <th style="color:green">Supervisor</th>
          <th style="color:green">Discipline</th>
          
          <th style="color:green">Area</th>
          <th style="color:green">Website</th>
          <th style="color:green ; text-align:center;"  colspan="3">Status</th>

        </tr>
      </thead>
      <tbody>';
    // output data of each row
      $count=1;

    while($row = $result->fetch_assoc()) {
      echo '<tr ">';
         echo '<td id="tdprj">'.$count.'</td>';
        echo '<td id="tdprj">'.$row['title'].'</td>';
        
        echo '<td id="tdprj">'.$row['university'].'</td>';
        echo '<td id="tdprj">'.$row['supervisor'].'</td>';
        echo '<td id="tdprj">'.$row['discipline'].'</td>';
        echo '<td id="tdprj">'.$row['area'].'</td>';
         echo '<td id="tdprj">'.$row['website'].'</td>';
        
        if($row['status']==0){
           $st = '';
          $status=' Not Active';
        }
        else {
           $st = 'checked';
          $status = ' Active ';
        }
        echo '<form action="#" method="post"><td>'.$status. '</td><input type="hidden" name="usapp" value="'.$row['pid'].'"/>'. '<td><input type="checkbox" name="status" value="'.$row['active'].'" '.$st.' /></td>  <td><input type="submit" class="btn btn-warning" value="Save" name="savestatus"></form>'.'</td>';
        echo '<td>'.'<form action="viewprj.php" method="post"> <input type="hidden" name="prjid" value="'.$row['pid'].'" /><input type="hidden" name="fromprj" value="'.$row['pid'].'" /><input type="hidden" name="supervisorprj" value="'.$row['pid'].'" /><input  type="submit" value="View" class="btn-default" /></form>'.'</td>';
         echo '<td>'.'<form action="#" method="post"> <input type="hidden" name="prfl" value="'.$row['projectfile'].'" /> <input type="hidden" name="usdel" value="'.$row['pid'].'" /> <input type="hidden" name="usr" value="'.$row['username'].'" /><input type="hidden" name="prnm" value="'.$row['title'].'" /><input style="background:red;" type="button" value="Delete" class="btn-default" onclick="getConfirmation(this.form,\''.$row['title'].'\');" /></form>'.'</td>';

       
      echo '</tr>';
      $count++;
    }
echo '</tbody></table>';}
    else {
        echo '<center><h1> No Project Yet!</h1></center>';

    }
    
        ?>
    </div>
           </div>
<br>
<?php
include 'temp_footer.php';
?>