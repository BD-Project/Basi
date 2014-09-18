<?php
require('CFUN.php');

$ckorg=$_POST['command'];

if($ckorg==='Elimina profilo'){
	$query="DELETE FROM Account WHERE User='".$_SESSION['user']."';";
	header("location: logout.php");
}

?>
