<?php
require('CFUN.php');

print head("Music Break");
print top();

$username='';
if(isset($_SESSION['username'])){
	$username=$_SESSION['username'];
}

$name='';
if(isset($_SESSION['name'])){
	$name=$_SESSION['name'];
}

$surname='';
if(isset($_SESSION['surname'])){
	$surname=$_SESSION['surname'];
}

$birth='';
if(isset($_SESSION['birth'])){
	$username=$_SESSION['birth'];
}

$birthplace='';
if(isset($_SESSION['birthplace'])){
	$username=$_SESSION['birthplace'];
}

$msg1="";
if(isset($_GET['msg1'])){
	$msg1 = "<span>".$_GET['msg1']."</span>";
}

$msg2="";
if(isset($_GET['msg2'])){
	$msg2 = "<span>".$_GET['msg2']."</span>";
}

$msg3="";
if(isset($_GET['msg1'])){
	$msg3 = "<span>".$_GET['msg3']."</span>";
}

$msg4="";
if(isset($_GET['msg4'])){
	$msg4 = "<span>".$_GET['msg4']."</span>";
}

$msg5="";
if(isset($_GET['msg5'])){
	$msg5 = "<span>".$_GET['msg5']."</span>";
}

$msg6="";
if(isset($_GET['msg6'])){
	$msg6 = "<span>".$_GET['msg6']."</span>";
}

$msg7="";
if(isset($_GET['msg7'])){
	$msg7 = "<span>".$_GET['msg7']."</span>";
}

print "
<h1>Pagina di registrazione</h1>
<div>
	<form action='checkregister.php' method='post'>
        <fieldset id='formfield'>
	<p>
           <label for='username'>Username: </label>
           <input type='text' name='username' value='$username' />
		$msg1
	</p>
	<p>
           <label for='password'>Password: </label>
           <input type='password' name='password'/>
		$msg2
	</p>
	<p>
           <label for='confermaPass'>Conferma Password: </label>
           <input type='password' name='confirmpassword' />
		$msg3
	</p>

	<p>
           <label for='name'>Nome: </label>
           <input type='text' name='name' value='$name' />
		$msg4
	</p>

	<p>
           <label for='surname'>Cognome: </label>
           <input type='text' name='surname' value='$surname' />
		$msg5
	</p>

	<p>
           <label for='birth'>Nato il: </label>
           <input type='text' name='birth' value='$birth' />
		$msg6
	</p>

	<p>
           <label for='birthplace'>Nato dove: </label>
           <input type='text' name='birthplace' value='$birthplace' />
		$msg7
	</p>

	<p>
           <input type='submit' value='Registra' />
	</p>

        </fieldset>
        </form>
</div>
";

print footer();

?>
