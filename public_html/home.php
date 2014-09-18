<?php
require('CFUN.php');
$posts=getListPosts("h");
$sidebar=getSideBar();
print head("Music Break");
print top();
print usrnav();
print nav("h");
print "<div><hr><h1>Ultime Articoli popolari</h1><ol>";
for($a=0; $a<count($sidebar[Articoli]); $a++)
    print "<li><a href='$path/post.php?id=".$sidebar[Articoli][$a][Id]."'>".$sidebar[Articoli][$a][Titolo]."</a></li>";
print "</ol><h1>Recensioni Popolari</h1><ol>";
for($a=0; $a<count($sidebar[Recensioni]); $a++)
    print "<li><a href='$path/post.php?id=".$sidebar[Recensioni][$a][Id]."'>".$sidebar[Recensioni][$a][Titolo]."</a></li>";
print "</ol><h1>Eventi Popolari</h1><ol>";
for($a=0; $a<count($sidebar[Eventi]); $a++)
    print "<li><a href='$path/post.php?id=".$sidebar[Eventi][$a][Id]."'>".$sidebar[Eventi][$a][Titolo]."</a></li>";
print "</ol></div><div id='contents_home'><hr><br><br><h1>Home</h1>";
for($i=0; $i<count($posts); $i++){
    print "<div><hr>
    <h2><a href='$path/post.php?id=".$posts[$i][Id]."'>".$posts[$i][Titolo]."</a></h2>
    <span>di ".$posts[$i][NomeAutore]." ".$posts[$i][CognomeAutore]." ".$posts[$i][Data]."</span>
    <div><img width='20%' src='$path".$posts[$i][FotoPath]."' alt='".$posts[$i][FotoAlt]."'/></div>
    <p>".$posts[$i][Descrizione]."</p> 
    <a href='$path/post.php?id=".$posts[$i][Id]."'>continua...</a>
    <ul>";
    for($e=0; $e<count($posts[$i][Tags]); $e++)
	print "<li><a href='$path/search.php?tag=".$posts[$i][Tags][$e]."'>".$posts[$i][Tags][$e]."</a></li>";
    print "</ul></div>";
}
print "</div>";
print footer();
?>

