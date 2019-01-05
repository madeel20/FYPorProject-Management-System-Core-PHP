<?php include('dbcon.php'); ?>
<?php
$id = $_POST['id'];
mysqli_query($con, "delete from message_sent where message_sent_id = '$id'")or die(mysqli_error());
?>

