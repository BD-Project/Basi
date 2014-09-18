<?php
require('CFUN.php');

if(isLogged() && !isEditor()){

  $user=$_SESSION['user'];
  if(!isset($_POST['idpost']) || !isset($_POST['rating']) ){
    header('Location: error.php');
  }
  $id=$_POST['idpost'];
  $val=$_POST['rating'];
  $query="INSERT INTO Valutazioni VALUES ('$user',$id,$val);";
  sql_query($query);
  header('Location: post.php?id='.$id);
}


?>
