<?php
require('CFUN.php');
print head("Music Break");
print top();
$path=getPath();
if(isLogged()){
	header("location: home.php");
}
print "

    <h1>Pagina di Login</h1>
	<form action='$path/logincheck.php' enctype='multipart/form-data' method='post'>
		<fieldset id='formfield'> 
        		<label for='username'>Username:</label>
        		<div><input type='text' name='username' id='username'/></div>
        		<label for='password'>Password:</label>
        		<div><input type='password' name='password' id='password'/></div>
        		<input type='submit' value='Accedi' />
        	</fieldset>
	</form>
	<a href='register.php'>oppure registrati</a>
";

print footer();
?>
