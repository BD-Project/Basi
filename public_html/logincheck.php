<?php
require('CFUN.php');


$username=$_POST['username'];
$password=$_POST['password'];

$query= "SELECT * FROM Account WHERE User='$username'";
$aux=sql_query($query);
$dtu=mysql_fetch_row($aux);
if($dtu[0] == ""){//guardare se ci sono tool per evitare sql injection
	header("location: login.php?err=username%20sbagliato");
	exit();
}
if(md5($password)==$dtu[1]){
	session_start();
	$_SESSION['user']=$dtu[0];
	header("location: home.php");
	exit();
}else{
	header("location: login.php?err=password%20sbagliata");
	exit();
}
?>
