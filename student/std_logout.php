<?php session_start(); ?>

<?php 

$_SESSION['std_id'] = null; 
$_SESSION['std_password'] = null; 
header("Location: std_login.php" );

 ?>