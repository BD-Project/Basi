<?php
require('CFUN.php');
if(!isEditor())
    die("<h1>Error!</h1>");
if(!isset($_GET[id]))
    die("<h1>Error!</h1>");
$id=$_GET[id];
$author=$_SESSION[user];
$imagepost="SELECT FPath FROM Posts WHERE Id=$id;";
$imagepost=sql_query($imagepost);
$imagepost=mysql_fetch_row($imagepost)[0];
unlink(getcwd().$imagepost);

if(isArticle($id)){
    $tracce="SELECT Traccia FROM Audio WHERE IdArticolo=$id";
    $tracce=sql_query($tracce);
    while($traccia=mysql_fetch_row($tracce)){
	unlink(getcwd().$traccia[0]);
    }
}elseif(isReview($id)){
    $galleria="SELECT FPath FROM Gallerie WHERE IdPost=$id";
    $galleria=sql_query($galleria);
    while($fgall=mysql_fetch_row($galleria)){
	unlink(getcwd().$fgall[0]);
    }
    
}

$query="DELETE FROM Posts WHERE Id=$id AND Autore='$author';";
sql_query($query);

header("Location: $path/profile.php");
?>