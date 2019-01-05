<?php
session_start();
include '..\connection.php';
if(isset($_SESSION['name'])){
	if($_SESSION['name'] != 'admin'){
		header("Location: userlogin.php");
	}
}
else{
	header("Location: login.php");
}
?>