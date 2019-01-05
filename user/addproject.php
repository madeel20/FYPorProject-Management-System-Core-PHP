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
  $members = $_POST['members'];
  $scope = $_POST['scope'];
$Flag=0;
    // Include the database configuration file
    include_once 'connection.php';
    // Check if user already added a project named by the title user inputed
    $sql = "SELECT * FROM `tbl_projects` WHERE studentid=".$_SESSION['id']." and title='".$_POST['title']."'";
     $result = $con->query($sql);

if ($result->num_rows > 0) {
  //if user already added this project
 $titleerr = 'This Project with title:'.$_POST['title'].' already added by you!';
}
else{
  //if user did not added a project with same name then check if a project is already added by someone with same title
  $sql = "select  * from members where fullname='".$_SESSION['fullname']."'";
  $result = $con->query($sql);
  // check if user already a member of a project
  if($result->num_rows>0){
    //user is already a member of a project then now compare titles  
    while($row = $result->fetch_assoc()){
        $foundPid = $row['pid'];
        $sql = "SELECT * FROM `tbl_projects` inner join tbl_student ON tbl_projects.studentid=tbl_student.id where pid=".$foundPid;
        $result1 = $con->query($sql);
        //getting the title of the project that user is already a member of.
        if($result1->num_rows>0){
          while($row1 = $result1->fetch_assoc()){
           
            //checking titles
           if($title == $row1['title']){
             
            //now if titled matched then check if project is from the same university.
            if($_SESSION['university']==$row1['university']){ 
             
              //if project is from the same university then print error .. that user already a member of same project added by someone else
              $titleerr  = 'Your are  already a member of same project added by '.$row1['fname'].' '.$row1['lname']." from ".$row1['university'];
              $Flag = 1;
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
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload  = '';
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
                $errorUploadType = 'File types are not supported!';
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
    $prjFileFlag =0;
              if(!empty($_FILES['files1']['name'])){
                    // File upload path
                    
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
                        
                        $prjFileFlag=0;
                      }
                     /* if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                          // Image db insert sql
                          
                      }else{
                        
                          $errorUpload .= $_FILES['files']['name'][$key].', ';
                      }*/
                  }else{
                      $errorUploadType1 = "File type is not supported!";
                  }
                }
                    if($prjFileFlag==1){
              if($members=='Individual'){
              $sql = "INSERT INTO `tbl_projects`( `studentid`, `title`, `discipline`, `area`, `status`, `supervisor`, `website`, `overview`, `details`, `approve`, `type`, `startdate`, `enddate`,`type2`,`members`,`scope`,`projectfile`) VALUES (".$_SESSION['id'].",'".$_POST['title']."','".$_POST['discipline']."','".$_POST['area']."',1,'".$_POST['supervisor']."','".$_POST['website']."','".$_POST['overview']."','".$_POST['details']."',0,'".$_POST['type']."','".$_POST['sdate']."','".$_POST['edate']."','".$type2."','".$members."','".$scope."','".$targetFilePath."');";
              if($con->query($sql)==true){
                header('Location: userlogin.php');
                exit();
              }
              else echo $con->error;  
            }else{ 
              $sql = "INSERT INTO `tbl_projects`( `studentid`, `title`, `discipline`, `area`, `status`, `supervisor`, `website`, `overview`, `details`, `approve`, `type`, `startdate`, `enddate`,`type2`,`members`,`scope`) VALUES (".$_SESSION['id'].",'".$_POST['title']."','".$_POST['discipline']."','".$_POST['area']."',1,'".$_POST['supervisor']."','".$_POST['website']."','".$_POST['overview']."','".$_POST['details']."',0,'".$_POST['type']."','".$_POST['sdate']."','".$_POST['edate']."','".$type2."','".$members."','".$scope."');";
              if($con->query($sql)==true){
                $sql = "select * from tbl_projects where studentid=".$_SESSION['id']." and title ='".$title."'";
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
            }
            


              
                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
                
            }else{
              echo $con->error;
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
        else {
          $statusMsg = "Something went wrong!";
        }

    }else{
        $statusMsg = 'Please select a file to upload.';
    }
  }
    // Display status message
  }}

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
   <br> <h2 class="page-banner-heading text-center">Student Panel:  </h2>
  
 <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8 text-center">
   <h2 class="page-banner-heading  text-center">  </h2><br><h4> Add a Project:</h4>
   <p style="color:red; font-size:25px;"> <?php if(isset($titleerr)) echo $titleerr;?></p>
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
                <input type="text" required class="form-control"  name="supervisor" placeholder="Enter Supervisor name" value="<?php if(isset($kfname)) echo $supervisor;?>"/>
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
              <input type="radio" checked  value="Individual" name="members" /> Individual
              <input type="radio" value="Group Base" name="members" /> Group Base
               
              </div>
              <div id="memlist">
              <div class="form-group">
                <label>Members:  </label><br>
              <table><tr><td class="text-center" colspan=1> 1:</td><td colspan=7> <input type="text" required class="form-control" readonly  name="mem1"  value="<?php echo $_SESSION['fullname'] ;?>"/></td></tr>
              <tr><td class="text-center" colspan=1> 2:</td><td colspan=7> <input type="text" class="form-control"   name="mem2" placeholder="Enter Member ..."/></td></tr>

              <tr><td class="text-center" colspan=1> 3:</td><td colspan=7> <input type="text" class="form-control"   name="mem3" placeholder="Enter Member ..."/></td></tr>

              <tr><td class="text-center" colspan=1> 4:</td><td colspan=7> <input type="text" class="form-control"   name="mem4" placeholder="Enter Member ..."/></td></tr>
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
             
              <div class="form-group"><label>Upload Screenshots( .jpg , .png , .jpeg , .gif ) : </label>
                <input required type="file" name="files[]"  multiple /><p style="color:red; font-size:13px;"><?php if(isset($errorUploadType)) echo $errorUploadType; ?></p>
              </div>
              <div class="form-group"><label>Upload Project files(.zip)(Optional): </label>
                <input type="file" name="files1[]"  /><p style="color:red; font-size:13px;"><?php if(isset($errorUploadType1)) echo $errorUploadType1; ?></p>
              </div>
               <div class="form-group">             
              <button type="submit" name="submit" class="btn btn-default">Add Project</button></div>
            </form></div></div>
            <div class="col-sm-3"></div></div>
            <script type="text/javascript">
 $("#memlist").hide();
$(document).ready(function(){
$("input[name$='members']").click(function(){
  if($(this).val() == 'Group Base'){
       $("#memlist").show();
       $("input[name$='mem2']").prop('required',true);
  }
  else 
  $("#memlist").hide();
  $("input[name$='mem2']").prop('required',false);

});
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