<?php
require('CFUN.php');
$path=getPath();
if(!isLogged()){
  header('Location: home.php');
  exit();
}
if(!isset($_POST['comment'])){
  echo "<h1>Error</h1>";
  exit();
}
$utente=$_SESSION['user'];
$id=$_POST['idpost'];
$commento=$_POST['comment'];
inserisciCommento($id,$commento,$utente);
header("Location: post.php?id=$id");
?>
