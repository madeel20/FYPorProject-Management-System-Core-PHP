<?php
include 'sessions.php';
?>
<?php 
/*
if(isset($_POST['usapp'])){
  $us= $_POST['usapp'];
$sql = "update `tbl_projects` set type='".$_POST['type']."' where  pid=".$us;
$con->query($sql);
}*/
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
  <section id="page-banner" class="page-banner-main-block" style="background-image: url('images/bg/page-banner.jpg')">
    <div class="row">
  <div class="col-sm-2 text-center" style="float:left;"> <a href="userlogin.php"><button type="submit" class="btn btn-default">Back</button></a></div>
  
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
   <h2 class="page-banner-heading  text-center">  </h2><p> All Projects:</p>
   </div>
   <div class="col-sm-2"></div>
</div>
  </section> 
  <br>
<!--  end page banner  -->
<div class="row">
<div class="col-sm-12">
  <?php
  $sql ="SELECT * FROM `tbl_projects` where supervisorId=".$_SESSION['id'].' order by status desc';
 $result = $con->query($sql);

if ($result->num_rows > 0) {
  echo '<table style="margin-top:30px;" class="table table-bordered">
      <thead>
        <tr>
         <th style="color:green" >Sr#</th>
          <th style="color:green" >Project Name</th>
          
          <th style="color:green">Supervisor</th>
          <th style="color:green">Discipline</th>
          
          <th style="color:green">Area</th>
          <th style="color:green">Approve</th>
         

        </tr>
      </thead>
      <tbody>';
      $count=1;
      //<th style="color:green ; text-align:center;"  colspan="3">Type</th>
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo '<tr ">';
       echo '<td id="tdprj">'.$count.'</td>';
        echo '<td id="tdprj">'.$row['title'].'</td>';
        
        echo '<td id="tdprj">'.$row['supervisor'].'</td>';
        echo '<td id="tdprj">'.$row['discipline'].'</td>';
        echo '<td id="tdprj">'.$row['area'].'</td>';
        if($row['approve']==1)
        echo '<td id="tdprj">'.'Approved'.'</td>';
        else 
        echo '<td id="tdprj">'.'Not Approved'.'</td>';

        
       
        /*echo '<form action="#" method="post"><td>'.$row['type']. '</td><input type="hidden" name="usapp" value="'.$row['pid'].'"/>'. '<td>';
        ?>
        
        <select class="form-control" name="type">
       <option <?php if($row['type']=='On Going') echo 'selected'; ?> value='On Going'> On Going </option>
       <option <?php if($row['type']=='Completed') echo 'selected'; ?> value='Completed'> Completed </option>
          <option <?php if($row['type']=='Dropped') echo 'selected'; ?> value='Dropped'> Dropped </option>
             
     </select>
     <?php 
     echo '</td>  <td><input type="submit" class="btn btn-warning" value="Save" name="savestatus"></form>'.'</td>';*/
     echo '<td>'.'<form action="viewprjuser.php" method="post"> <input type="hidden" name="prjid" value="'.$row['pid'].'" /><input type="hidden" name="fromprj" value="'.$row['pid'].'" /><input  type="submit" value="View" class="btn-default" /></form>'.'</td>';

     echo '<td>'.'<form action="editproject.php" method="post"> <input type="hidden" name="pid" value="'.$row['pid'].'" /><input type="hidden" name="fromprj" value="'.$row['pid'].'" /><input type="hidden" name="prjnm" value="'.$row['title'].'" /><input  type="submit" value="Edit" class="btn-default" /></form>'.'</td>';
     echo '<td>'.'<form action="#" method="post"> <input type="hidden" name="usdel" value="'.$row['pid'].'" /><input type="hidden" name="usr" value="'.$_SESSION['name'].'" /><input type="hidden" name="prnm" value="'.$row['title'].'" /><input type="hidden" name="prfl" value="'.$row['projectfile'].'" /><input style="background:red;" type="button"  value="Delete" class="btn-default" onclick="getConfirmation(this.form,\''.$row['title'].'\');" /></form>'.'</td>';

       
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