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

$iscr=date('Y-m-d',time());

$SESSION['birth']=$_POST['birth'];
$msg6="";
$birth;
if( !isset($_POST['birth'])  || $_POST['birth']===''){
	$msg6="Inserire la data di nascita";
	$error=true;
}else{
	if(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-0[1-9]|1[0-2]-[0-9]{4}$/",$_POST['birth'])){
		$day = substr($_POST['birth'], 0, 2);
		$month = substr($_POST['birth'], 3, 2);
		$year = substr($_POST['birth'], 6, 4);
		
		$yearn=substr($iscr,0,4);
		$monthn=substr($iscr,5,2);
		$dayn=substr($iscr,8,2);
		
		if($year>$yearn && $month>$monthn && $day>$dayn){
			$msg6="Sei nato nel futuro?";
			$error=true;
		}else{
			$birth=$year.'-'.$month.'-'.$day;
		}
	}else{
		$error=true;
		$msg6="Formato Data non valida (es. GG-MM-AAAA --> 29-12-1987)";
	}
}


$SESSION['birthplace']=$_POST['birthplace'];
$mag7="";
$birthplace;
if( !isset($_POST['birthplace'])  || $_POST['birthplace']===''){
	$msg7="Inserire la data di nascita";
	$error=true;
}else{
	//if(preg_match("",$_POST['birthplace'])){
		$birthplace=$_POST['birthplace'];
	//}else{
	//	$error=true;
	//	$msg5="Formato Data non valida (es. GG-MM-AAAA --> 29-12-1987)";
	//}
	
}



if($error==true){
	$msg="msg1=$msg1&&msg2=$msg2&&msg3=$msg3&&msg4=$msg4&&msg5=$msg5&&msg6=$msg6&&msg7=$msg7";
	header('Location: register.php?'.$msg);
	//exec('php register.php');
	exit(); 
}else{
	$query="INSERT INTO Account VALUES ('$username','$password','$name','$surname','$iscr','$birth','$birthplace');";
	sql_query($query);

	$query="INSERT INTO Utenti VALUES ('$username');";
	sql_query($query);
	header('Location: home.php');
}


exit();



?>
