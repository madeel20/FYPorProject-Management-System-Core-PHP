<?php include('dbcon.php'); ?>
<?php
$id = $_POST['id'];
mysqli_query($con, "delete from message where message_id = '$id'")or die(mysqli_error());
?>

