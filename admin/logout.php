<?php
session_start();
session_unset();
header("Location: ..\login.php"); /* Redirect browser */
exit();
session_destroy();
?>
