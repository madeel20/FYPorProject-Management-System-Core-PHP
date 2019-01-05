<?php
include 'sessions.php';
?>

<?php 
if(isset($_POST['submit'])){
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
    $mem[0] = $_POST['mem1'];
    $mem[1] = $_POST['mem2'];
    $mem[2] = $_POST['mem3'];
    $mem[3] = $_POST['mem4'];
  $scope = $_POST['scope'];
$Flag=0;
    // Include the database configuration file
    include_once 'connection.php';
    // Check if user already added a project named by the title user inputed
    $sql = "SELECT * FROM `tbl_projects` WHERE supervisorId=".$_SESSION['id']." and title='".$_POST['title']."'";
     $result = $con->query($sql) or die($con->error);

if ($result->num_rows > 0) {
  //if user already added this project
 $titleerr = 'Your are already a supervisor of a Project with title:'.$_POST['title'].' already added by someone!';
 $Flag=1;
}
else{
  // check if current user is a supervisor of the same proeject added by someone with same title
  $sql = "select  * from tbl_projects where supervisor='".$_SESSION['fullname']."' and title='".$_POST['title']."'";
  $result = $con->query($sql) or die($con->error);
  // check if user already a supervisor of the same project added by someone else...                                                                                                  member of a project
  if($result->num_rows>0){
    
    //user is already a supervisor of same project added by someone else!
    //now check university 
    while($row= $result->fetch_assoc()){
    if($row['studentid']=='')
     $sql ="SELECT * FROM `tbl_projects` inner join tbl_supervisor ON tbl_projects.supervisorId=tbl_supervisor.id where pid=".$row['pid'];
    else
    $sql ="SELECT * FROM `tbl_projects` inner join tbl_student ON tbl_projects.studentid=tbl_student.id where pid=".$row['pid']; 
    $result = $con->query($sql) or die($con->error);

    if ($result->num_rows > 0) {
      while($row= $result->fetch_assoc()){
    
      
  if($row['university'] ==	$_SESSION['university']){
   
  $titleerr="You are already the supervisor of Project: ".$_POST['title']." added by someone else of ".$_SESSION['university'];  
  $Flag=1;  
  }
      }
    }
  }
  
  

    
    
        
    }
  }
 
if($Flag==0){

    // File upload configuration
    $targetDir = "..\projects/";
    $targetDir1 = "..\projectFiles/";
    $allowTypes = array('jpg','png','jpeg','gif');
  
    $sql1 = "DELETE  FROM images WHERE usprj='".$_SESSION['name'].'_'.$_POST['title']."'";
    $con->query($sql1) or die($con->error);
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if(!empty(array_filter($_FILES['files']['name']))){
      
        foreach($_FILES['files']['name'] as $key=>$val){
            // File upload path
            
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $_SESSION['name'].'_'.$_POST['title'].'_'.$fileName;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                
                try {
                  move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath);
                  $insertValuesSQL .= "('".$_SESSION['name'].'_'.$_POST['title']."','".$fileName."'),";
                  
                  
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
                $errorUploadType1 ="File type is not supported!";
            }
        }
        
        if(!empty($insertValuesSQL)){
            $insertValuesSQL = trim($insertValuesSQL,',');
            // Insert image file name into database
            $insert = $con->query("INSERT INTO images (usprj,src) VALUES $insertValuesSQL");
            if($insert){
              $targetFilePath ='';
    $targetDir= "..\projectFiles/";
    $allowTypes = array('zip','docx','ppt');
    $prjFileFlag =1;
              if(!empty($_FILES['files1']['name'][0])){
                    // File upload path
                    $prjFileFlag =0;
                    $fileName = basename($_FILES['files1']['name'][0]);
                    
                    $targetFilePath = $targetDir . $_SESSION['name'].'_'.$_POST['title'].'_'.$fileName;
                    // Check whether file type is valid
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                    if(in_array($fileType, $allowTypes)){
                        // Upload file to server
                        
                        try {
                          move_uploaded_file($_FILES["files1"]["tmp_name"][0], $targetFilePath);
                            $prjFileFlag=1;
                            $targetFilePath =$_SESSION['name'].'_'.$_POST['title'].'_'.$fileName;
                        }
                       catch (\Throwable $th) {
                        //throw $th;
                        echo $th;
                        $prjFileFlag=0;
                      }
                     /* if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                          // Image db insert sql
                          
                      }else{
                        
                          $errorUpload .= $_FILES['files']['name'][$key].', ';
                      }*/
                  } else{
                      $errorUploadType ="File type is not supported!";
                  }
                }
                    if($prjFileFlag==1){
              $sql = "INSERT INTO `tbl_projects`( `supervisorId`, `title`, `discipline`, `area`, `status`, `supervisor`, `website`, `overview`, `details`, `approve`, `type`, `startdate`, `enddate`,`type2`,`members`,`scope`,`projectfile`) VALUES (".$_SESSION['id'].",'".$_POST['title']."','".$_POST['discipline']."','".$_POST['area']."',1,'".$_POST['supervisor']."','".$_POST['website']."','".$_POST['overview']."','".$_POST['details']."',0,'".$_POST['type']."','".$_POST['sdate']."','".$_POST['edate']."','".$type2."','".$members."','".$scope."','".$targetFilePath."');";
              if($con->query($sql)==true){
                $sql = "select * from tbl_projects where supervisorId=".$_SESSION['id']." and title ='".$title."'";
                $result = $con->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()){
    $pid = $row['pid'];
  }}
                for($i =1; $i<=4;$i++){
                  $memnm = $_POST['mem'.$i];
                  if($memnm!=''){
                  $sql = "INSERT INTO `members`(`pid`, `fullname`) VALUES (".$pid.",'".$memnm."');";
                  $con->query($sql);
                }
                }

                header('Location: userlogin.php');
                exit();
              }
              else echo $con->error;
              
            }
            else 
            $titleerr = " cannot upload  project file(Unsupported file extension) !";
                
            }else{
              echo $con->error;
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
        else {
          $statusMsg = 'error uploading files';
        }

    }else{
        $statusMsg = 'Please select a file to upload.';
    }
  }
    // Display status message
  }

  ?>
    <?php
include 'temp_nav.php';
?>


<!--  page banner -->
  <section id="page-banner" class="page-banner-main-block" style="background-image: url('images/bg/page-banner.jpg')">
    <div class="row">
  <div class="col-sm-2 text-center" style="float:left;"> <a href="userlogin.php"><button type="submit" class="btn btn-default"> Back</button></a></div>
  
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
   <h2 class="page-banner-heading  text-center">  </h2><br><h4> Add a Project:</h4>
   <p style="color:red; font-size:18px;"> <?php if(isset($titleerr)) echo $titleerr;?></p>
   </div>
   <div class="col-sm-2"></div>
</div>
  </section> 
  <br>
<!--  end page banner  -->
<div class="row">
<div class="col-sm-3"></div>
<form method="post" enctype="multipart/form-data" action="#">
<div class="col-sm-6">
 <div class="form-group">
  
  <label>Project Name: </label>
                <input type="text" class="form-control" required  name="title" placeholder="Enter a Project name" value="<?php if(isset($kfname)) echo $title;?>"/>
              </div>
              <div class="form-group">
                <label> Supervisor: </label>
                <input type="text" readonly required class="form-control"  name="supervisor" placeholder="Enter Supervisor name" value="<?php echo $_SESSION['fullname'];?>"/>
              </div>
              <div class="form-group"><label> Type: &nbsp;</label><br> 
              <input type="radio" checked  value="Academic" name="type2" /> Academic
              <input type="radio"  value="Research" name="type2" /> Research
               
              </div>
              <div class="form-group"><label> Visisbility: &nbsp;</label><br> 
              <input type="radio" checked  value="Public" name="scope" /> Public
              <input type="radio" value="Private" name="scope" /> Private
               
              </div>
              <div class="form-group">
                <label>Discipline:</label>
                <select class="form-control" name="discipline">
                 
                  <option value="Engineering">Engineering</option>
                  <option value='Non engineering'>Non engineering</option>
                   
                </select>
             
              </div>
               <div class="form-group">
                 <label> Thematic Area: </label>
                <input type="text" required class="form-control"  name="area" placeholder="Enter an Area " value="<?php if(isset($kfname)) echo $area;?>"/>
              </div>
             <div class="form-group">
                <label>Status:</label>
                <select id="stdropdown" class="form-control" name="type">
                  <option value='On Going'> On Going </option>
                  <option value='Completed'> Completed </option>
                     <option value='Dropped'> Dropped </option>
                        
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
             
               
              <table><tr><td class="text-center" colspan=1> 1:</td><td colspan=7> <input type="text" required class="form-control" value="<?php if(isset($mem[0])) echo $mem[0];?>"   name="mem1" placeholder="Enter Member ..."/></td></tr>
              <tr><td class="text-center" colspan=1> 2:</td><td colspan=7> <input type="text" class="form-control"   name="mem2"   value="<?php if(isset($mem[1])) echo $mem[1];?>" placeholder="Enter Member ..."/></td></tr>

              <tr><td class="text-center" colspan=1> 3:</td><td colspan=7> <input type="text" class="form-control"   name="mem3"   value="<?php if(isset($mem[2])) echo $mem[2];?>" placeholder="Enter Member ..."/></td></tr>

              <tr><td class="text-center" colspan=1> 4:</td><td colspan=7> <input type="text" class="form-control"   name="mem4"   value="<?php if(isset($mem[3])) echo $mem[3];?>" placeholder="Enter Member ..."/></td></tr>
            </table>
              
                </div>
               
              <div class="form-group">
                <label>Overview:</label>
                <textarea rows="4" class="form-control"  name="overview"  ><?php if(isset($kfname)) echo $overview;?>  </textarea> 
              </div>
               <div class="form-group">

                <label>Details of your projects</label>
                <textarea class="form-control"  name="details" rows="10" ><?php if(isset($kfname)) echo $details;?> </textarea> 
              </div>
             
              <div class="form-group"><label>Upload Screenshots( .jpg , .png , .jpeg , .gif ) : </label>
                <input required type="file" name="files[]"  multiple /><p style="color:red; font-size:13px;"><?php if(isset($errorUploadType1)) echo $errorUploadType1; ?></p>
              </div>
              <div class="form-group"><label>Upload Project files(.zip,.docx,.ppt)(Optional): </label>
                <input type="file" name="files1[]"  /><p style="color:red; font-size:13px;"><?php if(isset($errorUploadType)) echo $errorUploadType; ?></p>
              </div>
               <div class="form-group">             
              <button type="submit" name="submit" class="btn btn-default">Add Project</button></div>
            </form></div></div>
            <div class="col-sm-3"></div></div>
            <script type="text/javascript">
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