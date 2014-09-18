<?php
require('CFUN.php');

$error=false;

$SESSION['username']=$_POST['username'];
$msg1="";
$username;
if( !isset($_POST['username']) || $_POST['username']==='' ){
	$error=true;
	$msg1="Inserire campo dati username";
}else{
	$username=$_POST['username'];
	$query="SELECT a.User FROM Account a WHERE a.User='$username'";
	$aux=sql_query($query);
	$dbusrs= mysql_fetch_row($aux);
	$dbusr=$dbusrs[0];
	if(strcmp($dbusr,$username)==0){
		$error=true;
		$msg1="username già presente";
	}
}


$msg2="";
$msg3="";
$password;
if( !isset($_POST['password'])  || $_POST['password']===''){
	$error=true;
	$msg2="Inserire campo dati password";
}else{
	if(!isset($_POST['confirmpassword']) || $_POST['confirmpassword']===''){
		$error=true;
		$msg3="Inserire campo dati confermapassword";
	}else{
		if(strcmp($_POST['password'],$_POST['confirmpassword'])!=0){
			$error=true;
			$msg3="Le password non combaciano";
		}else{
			$password=md5($_POST['password']);
		}
	}
}

$SESSION['name']=$_POST['name'];
$mag4="";
$name;
if( !isset($_POST['name'])  || $_POST['name']===''){
	$error=true;
	$msg4="Inserire il Nome";
}else{
	if(preg_match("/^[A-Z][a-z]/",$_POST['name'])){
		$name=$_POST['name'];
	}else{
		$error=true;
		$msg4="Nome non valido (Controllare maiuscola inizale in caso)";
	}
}

$SESSION['surname']=$_POST['surname'];
$msg5="";
$surname;
if( !isset($_POST['surname'])  || $_POST['surname']===''){
	$msg5="Inserire il Cognome";
	$error=true;
}else{
	if(preg_match("/^[A-Z][a-z]/",$_POST['surname'])){
		$surname=$_POST['surname'];
	}else{
		$error=true;
		$msg5="Cognome non valido (Controllare maiuscola inizale in caso)";
	}
}

if($error==true){
	$msg="msg1=$msg1&&msg2=$msg2&&msg3=$msg3&&msg4=$msg4&&msg5=$msg5";
	header('Location: register.php?'.$msg);
	exit(); 
}else{
	$query="CALL creaUtente('$username','$password','$name','$surname');";
	sql_query($query);
	header('Location: home.php');
}
exit();
?>
