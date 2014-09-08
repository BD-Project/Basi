<?php
require('CFUN.php');
$sname=session_name();
if(isset($_COOKIE[$sname])){
	setcookie($sname,'',time()-3600,'/');
}
session_destroy();
header("location: home.php");
exit();
?>
