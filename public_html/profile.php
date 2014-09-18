<?php
require('CFUN.php');
print head("Music Break");
print top();
print usrnav();

$path=getPath();
$usr=$_SESSION['user'];

$query="SELECT a.User, a.Password, a.Nome, a.Cognome, a.Iscrizione FROM Account a WHERE a.User='$usr'";
$aux=sql_query($query);
$dtd=mysql_fetch_row($aux);

print "
<h2>Profilo di $dtd[0]</h2>
<p>Nome: $dtd[2]</p>
<p>Cognome: $dtd[3]</p>
<p>Iscritto dal: $dtd[4]</p>";
if(isEditor()){
	$query="SELECT p.Id, p.Titolo FROM Posts p WHERE p.Autore='$usr'";
	$aux=sql_query($query);
	print "<p>Articoli Scritti:</p>";
	while ($row = mysql_fetch_row($aux)){
		print "<ul><a href='$path/post.php?id=$row[0]'>$row[1]</a> <a href='$path/deletepost.php?id=$row[0]'>DELETE</a></ul>";
	}
    
}else{
    print "<form action='deleteprofile.php' method='post'>
    <input type='submit' name='command' value='Elimina profilo' />
    </form>";
}
?>
