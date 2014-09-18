<?php
require('CFUN.php');
$path=getPath();
if(!isset($_GET['type']))
    die("<h1>Errore</h1>");
$type=$_GET['type'];
$posts=getListPosts($type);
$page=1;
if(isset($_GET['page']))
    $page=$_GET['page'];
print head("Music Break");
print top();
print usrnav();
print nav($type);
print "<div>";
for($i=(4* ($page-1)); $i<(4*$page) && $i<count($posts); $i++) {
    print "<div><hr>
    <h2><a href='$path/post.php?id=".$posts[$i][Id]."'>".$posts[$i][Titolo]."</a></h2>
    <span>di ".$posts[$i][NomeAutore]." ".$posts[$i][CognomeAutore]." ".$posts[$i][Data]."</span>
    <div><img width='20%' src='$path".$posts[$i][FotoPath]."' alt='".$posts[$i][FotoAlt]."'/></div>
    <p>".$posts[$i][Descrizione]."</p> 
    <a href='$path/post.php?id=".$posts[$i][Id]."'>continua...</a><ul>Cerca posts simili taggati con:";
    for($e=0; $e<count($posts[$i][Tags]); $e++)
	print "<li><a href='$path/search.php?tag=".$posts[$i][Tags][$e]."'>".$posts[$i][Tags][$e]."</a></li>";
    print "</ul></div>";
}
if(count($posts)>4){
    if($page!=1){
	print "<a href='$path/show.php?type=$type&page=1'><<</a>";
	print " <a href='$path/show.php?type=$type&page=".($page-1)."'><</a>";
    }
    if($page!=ceil(count($posts)/4)){
	print "<a href='$path/show.php?type=$type&page=".($page+1)."'>></a>";
	print " <a href='$path/show.php?type=$type&page=".ceil(count($posts)/4)."'>>></a>";
    }
}
print "</div>";
print footer();
?>
