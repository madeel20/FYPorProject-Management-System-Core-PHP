<?php
session_start();
include 'connection.php';
if(isset($_SESSION['name'])){
  if($_SESSION['name'] == 'admin'){
    header("Location: admin.php");
  }
  else if(!isset($_SESSION['isSupervisor'])){
    header("Location: ..\user/userlogin.php");
  }

}
else{
  header("Location: login.php");
}
?>