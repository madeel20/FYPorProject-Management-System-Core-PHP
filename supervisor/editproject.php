<?php
include 'sessions.php';
?>
<?php 
if(!isset($_POST['pid'])){
header('Location: viewprojects.php');
exit();
}
$alert ='';
if(isset($_POST['supervisor'])){
  $kfname='';
  $title = $_POST['title'];
  $supervisor = $_POST['supervisor'];
  $discipline = $_POST['discipline'];
  $area = $_POST['area'];
  $type = $_POST['type'];
  $website = $_POST['website'];
  $sdate = $_POST['sdate'];
  $edate = $_POST['edate'];

  $overview = $_POST['overview'];
  $overview = str_replace("'",'"',$overview);
  $details = $_POST['details'];
  $type2 = $_POST['type2'];
  $details = str_replace("'",'"',$details);
  $members = "Group Base";
  $scope = $_POST['scope'];
  $sql ="UPDATE `tbl_projects` SET `title`='".$title."',`discipline`='".$discipline."',`area`='".$area."',`supervisor`='".$supervisor."',`website`='".$website."',`overview`='".$overview."',`details`='".$details."',`type`='".$type."',`startdate`='".$sdate."',`enddate`='".$edate."',`type2`='".$type2."',`members`='".$members."',`scope`='".$scope."' WHERE pid=".$_POST['pid'];
  if($con->query($sql)==true){
    if($members == 'Group Base'){
      $sql = "DELETE FROM `members` WHERE pid=".$_POST['pid'];
      $con->query($sql) or die($con->error);
      $sql = "INSERT INTO `members`(`pid`, `fullname`) VALUES (".$_POST['pid'].",'".$_SESSION['fullname']."');";
      $con->query($sql) or die($con->error);
      $sql = "INSERT INTO `members`(`pid`, `fullname`) VALUES (".$_POST['pid'].",'".$_POST['mem2']."');";
      $con->query($sql) or die($con->error);
      if(isset($_POST['mem3'])){
        $sql = "INSERT INTO `members`(`pid`, `fullname`) VALUES (".$_POST['pid'].",'".$_POST['mem3']."');";
        $con->query($sql) or die($con->error);
      }
      if(isset($_POST['mem4'])){
        $sql = "INSERT INTO `members`(`pid`, `fullname`) VALUES (".$_POST['pid'].",'".$_POST['mem4']."');";
        $con->query($sql) or die($con->error);
      }
    

    }
    else {
      $sql = "DELETE FROM `members` WHERE pid=".$_POST['pid'];
      $con->query($sql) or die($con->error);
    }
    $alert = ' alert("Changes Saved!"); ';
  }
  else{
    $alert = ' alert("Changes not Saved!"); ';
  }
}
//Update Screenshots Code
if(isset($_POST['update_Screenshots'])){
   // File upload configuration
   $targetDir = "..\projects/";
   $allowTypes = array('jpg','png','jpeg','gif');
   $usr = $_SESSION['name'];
   $prnm = $_POST['prjnm'];
 
 $sql = "select * from images where usprj='".$usr.'_'.$prnm."'";
 $result = $con->query($sql)or die($con->error);
 
 if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
     unlink('..\projects/'.$usr.'_'.$prnm.'_'.$row['src']);
   }}
 $sql = "delete from images where usprj='".$usr.'_'.$prnm."'";
 $con->query($sql)or die($con->error);
  
   $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType1 = '';
   if(!empty(array_filter($_FILES['files']['name']))){
     
       foreach($_FILES['files']['name'] as $key=>$val){
           // File upload path
           
           $fileName = basename($_FILES['files']['name'][$key]);
           $targetFilePath = $targetDir . $_SESSION['name'].'_'.$_POST['prjnm'].'_'.$fileName;
           
           // Check whether file type is valid
           $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
           if(in_array($fileType, $allowTypes)){
               // Upload file to server
               
               try {
                 move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath);
                 $insertValuesSQL .= "('".$_SESSION['name'].'_'.$_POST['prjnm']."','".$fileName."'),";
                 
                 //code...
               } catch (\Throwable $th) {
                 //throw $th;
                 echo $th;
               }
              /* if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                   // Image db insert sql
                   
               }else{
                 
                   $errorUpload .= $_FILES['files']['name'][$key].', ';
               }*/
           }else{
            $errorUploadType1 = "File Type not is not supported to upload of ". $_FILES['files']['name'][$key].'';
           }
       }
       
       if(!empty($insertValuesSQL)){
        $insertValuesSQL = trim($insertValuesSQL,',');
        // Insert image file name into database
        $insert = $con->query("INSERT INTO images (usprj,src) VALUES $insertValuesSQL");
        if($insert){
        $alert = ' alert("Changes Saved!"); ';
        }
        else{
          $alert = ' alert("Changes not Saved!"); ';
        }
  
      }
      else{
        $alert = ' alert("Changes not Saved!"); ';
      }

}
}

//Update Proect File Code
if(isset($_POST['update_projectFile'])){
  // File upload configuration
  $usr = $_SESSION['name'];
  $prnm = $_POST['prjnm'];
  $targetDir= "..\\\\projectFiles/";
    $allowTypes = array('zip','docx','ppt');
    $prjFileFlag =0;
              if(!empty($_FILES['files1']['name'])){
                    // File upload path
                    
                    $fileName = basename($_FILES['files1']['name'][0]);
                    
                    $targetFilePath = $targetDir . $_SESSION['name'].'_'.$prnm.'_'.$fileName;
                    // Check whether file type is valid
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                    $targetFilePath = $targetDir . $_SESSION['name'].'_'.$prnm.'.'.$fileType;
                    if(in_array($fileType, $allowTypes)){
                        // Upload file to server
                        unlink($targetDir.$_POST['prevFile']);
                        try {
                          if(move_uploaded_file($_FILES["files1"]["tmp_name"][0], $targetFilePath)){
                            $targetFilePath =$_SESSION['name'].'_'.$prnm.'.'.$fileType;
                            $prjFileFlag=1;
                            
                            $sql = "update tbl_projects set projectfile='".$targetFilePath."' where pid=".$_POST['pid'];
                            $con->query($sql) or die($con->error);
                            $alert = ' alert("Changes  Saved!"); ';
                          }
                        }
                       catch (Throwable $th) {
                        //throw $th;
                        echo $th;
                        $prjFileFlag=0;
                        $alert = ' alert("Changes not Saved!"); ';
                      }
                     /* if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                          // Image db insert sql
                          
                      }else{
                        
                          $errorUpload .= $_FILES['files']['name'][$key].', ';
                      }*/
                  }else{
                      $errorUploadType = "File Type not is not supported to upload of ". $_FILES['files1']['name'][0].'';
                      $alert = ' alert("Changes not Saved!"); ';
                    }
                }
              }

  ?>
    <?php
include 'temp_nav.php';
$sql = 'select * from tbl_projects where pid='.$_POST['pid'];
$result  =$con->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $kfname='';
        $title = $row['title'];
        $supervisor = $row['supervisor'];
        $discipline = $row['discipline'];
        $area = $row['area'];
        $type = $row['type'];
        $website = $row['website'];
        $sdate = $row['startdate'];
          $edate = $row['enddate'];
      
        $overview = $row['overview'];
        $overview = str_replace("'",'"',$overview);
        $details = $row['details'];
        $type2 = $row['type2'];
        $details = str_replace("'",'"',$details);
        $members = $row['members'];
        $scope = $row['scope'];
        $projectFile = $row['projectfile'];
        
    }
}
  $sql ="select  * from members where pid=".$_POST['pid'];
  $result = $con->query($sql);
  if($result->num_rows>0){
    $i=0;
    $mem = array();
    while($row = $result->fetch_assoc()){
      
      $mem[$i] = $row['fullname'];
      $i++;
    }
  }

?>


<!--  page banner -->
  <section id="page-banner" class="page-banner-main-block" style="background-image: url('..\images/bg/page-banner.jpg')">
    <div class="row">
  <div class="col-sm-2 text-center" style="float:left;"> <a href="viewprojects.php"><button type="submit" class="btn btn-default"> Back</button></a></div>
  
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
   <h2 class="page-banner-heading  text-center">  </h2><br><h4> Edit Project:</h4>
   <p style="color:red; font-size:25px;"> <?php if(isset($titleerr)) echo $titleerr;?></p>
   </div>
   <div class="col-sm-2"></div>
</div>
  </section> 
  <br>
<!--  end page banner  -->
<div class="row">
<div class="col-sm-3"></div>
<form method="post"  action="#">
<input type="hidden" name="pid" value="<?php echo $_POST['pid'];?>" />
<input type="hidden" name="prjnm" value="<?php echo $_POST['prjnm'];?>" />

<div class="col-sm-6">
 <div class="form-group">
  
  <label>Project Name: </label>
                <input type="text" class="form-control" required readonly  name="title" placeholder="Enter a Project name" value="<?php if(isset($kfname)) echo $title;?>"/>
              </div>
              <div class="form-group">
                <label> Supervisor: </label>
                <input type="text" readonly required class="form-control"  name="supervisor" placeholder="Enter Supervisor name" value="<?php if(isset($kfname)) echo $supervisor;?>"/>
              </div>
              <div class="form-group"><label> Type: &nbsp;</label><br> 
              <input type="radio" <?php if($type2=='Academic') echo 'checked';?>  value="Academic" name="type2" /> Academic
              <input type="radio" <?php if($type2=='Research') echo 'checked';?>   value="Research" name="type2" /> Research
               
              </div>
              <div class="form-group"><label> Visisbility: &nbsp;</label><br> 
              <input type="radio" <?php if($scope=='Public') echo 'checked';?>  checked  value="Public" name="scope" /> Public
              <input type="radio" <?php if($scope=='Private') echo 'checked';?>  value="Private" name="scope" /> Private
               
              </div>
              <div class="form-group">
                <label>Discipline:</label>
                <select class="form-control" name="discipline">
                 
                  <option <?php if($discipline=='Engineering') echo 'selected';?>  value="Engineering">Engineering</option>
                  <option <?php if($discipline=='Non engineering') echo 'selected';?> value='Non engineering'>Non engineering</option>
                   
                </select>
             
              </div>
               <div class="form-group">
                 <label> Thematic Area: </label>
                <input type="text" required class="form-control"  name="area" placeholder="Enter an Area " value="<?php if(isset($kfname)) echo $area;?>"/>
              </div>
             <div class="form-group">
                <label>Status:</label>
                <select id="stdropdown" class="form-control" name="type">
                  <option  <?php if($type=='On Going') echo 'selected';?> value='On Going'> On Going </option>
                  <option  <?php if($type=='Completed') echo 'selected';?> value='Completed'> Completed </option>
                   <option <?php if($type=='Dropped') echo 'selected';?> value='Dropped'> Dropped </option>
                        
                </select>
             
              </div>
             
              <div class="form-group">
                <label> Website</label>
                <input type="text" class="form-control"  name="website" placeholder="Enter website(Not Compulsory)" value="<?php if(isset($kfname)) echo  $website;?>"/>
              </div>
              <div class="form-group">
                <label>Start Date: </label>
                <input type="date" required class="form-control"  name="sdate" placeholder="" value="<?php if(isset($kfname)) echo  $sdate;?>"/>
              </div>
                <div class="form-group">
                <label>End Date: </label>
                <input type="date" required class="form-control" id="edt"  name="edate" placeholder="" value="<?php if(isset($kfname)) echo  $edate;?>"/>
              </div>
              <div class="form-group"><label>Members: &nbsp;</label><br> 
               
              </div>
              <div id="memlist">
              <div class="form-group">
                <label>Members:  </label><br>
              <table>
              <tr><td class="text-center" colspan=1> 1:</td><td colspan=7> <input required type="text" class="form-control"  value="<?php if(isset($mem[0])) echo  $mem[0];?>"  name="mem1" placeholder="Enter Member ..." /></td></tr>

              <tr><td class="text-center" colspan=1> 2:</td><td colspan=7> <input type="text" class="form-control"  value="<?php if(isset($mem[1])) echo  $mem[1];?>"  name="mem2" placeholder="Enter Member ..."/></td></tr>

              <tr><td class="text-center" colspan=1> 3:</td><td colspan=7> <input type="text" class="form-control"  value="<?php if(isset($mem[2])) echo  $mem[2];?>"  name="mem3" placeholder="Enter Member ..."/></td></tr>
              <tr><td class="text-center" colspan=1> 4:</td><td colspan=7> <input type="text" class="form-control"  value="<?php if(isset($mem[3])) echo  $mem[3];?>"  name="mem4" placeholder="Enter Member ..."/></td></tr>

            </table>
              </div>
                </div>
               
              <div class="form-group">
                <label>Overview:</label>
                <textarea rows="4" class="form-control"  name="overview"  ><?php if(isset($kfname)) echo $overview;?>  </textarea> 
              </div>
               <div class="form-group">

                <label>Details of your projects</label>
                <textarea class="form-control"  name="details" rows="10" ><?php if(isset($kfname)) echo $details;?> </textarea> 
              </div>
             
             
               <div class="form-group">             
              <button type="submit" name="submit" class="btn btn-default">Save Changes</button></div>
            </form>
            <br><br><br>
            <form method="post" enctype="multipart/form-data" action="#">
            <input type="hidden" name="pid" value="<?php echo $_POST['pid'];?>" />
            <input type="hidden" name="update_Screenshots" value="true" />
            <input type="hidden" name="prjnm" value="<?php echo $_POST['prjnm'];?>" />
           <center> <h4> Update Screenshots : </h4></center>
<br>
<p style="color:red;"> <?php if(isset($errorUploadType1)) echo $errorUploadType1;?></p>

            <div class="form-group"><label>Upload New Screenshots( .jpg , .png , .jpeg , .gif ) : </label>
                <input  type="file" name="files[]"  multiple /><p style="color:red; font-size:13px;"><?php if(isset($statusMsg)) echo $statusMsg; ?></p>
              </div>
              
              <div class="form-group">             
              <button type="submit" name="submit" class="btn btn-default">Save Changes</button></div>
              </form><br><br>
              <center> <h4> Update Project File : </h4></center>
              <p style="color:red;"> <?php if(isset($errorUploadType)) echo $errorUploadType;?></p>
<br> <form method="post" enctype="multipart/form-data" action="#">
            <input type="hidden" name="pid" value="<?php echo $_POST['pid'];?>" />
            <input type="hidden" name="update_projectFile" value="true" />
            <input type="hidden" name="prjnm" value="<?php echo $_POST['prjnm'];?>" />
            <input type="hidden" name="prevFile" value="<?php echo $projectFile;?>" />
            
              <div class="form-group"><label>Upload a new Project file(.zip): </label>
                <input type="file" name="files1[]"/><p style="color:red; font-size:13px;"><?php if(isset($statusMsg)) echo $statusMsg; ?></p>
              </div>
              <div class="form-group">             
              <button type="submit" name="submit" class="btn btn-default">Save Changes</button></div>
              </form></div></div>
            <div class="col-sm-3"></div></div>
            <script type="text/javascript">
 
<?php echo $alert;?>
$(document).ready(function(){
    
$('#stdropdown').change(function(){
var status = this.value;
if(status !='On Going')
$('#edt').attr({
  "max": '<?php echo date('Y-m-d'); ?>
'});
else 
$('#edt').attr({
  "max":  ''
});
});


});
</script>
<br>
<?php
include 'temp_footer.php';
?>