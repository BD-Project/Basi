<?php
require('CFUN.php');
$path=getPath();

$page=1;
if(isset($_GET[page]))
    $page=$_GET[page];



$kws=$_POST[kws];//frammento parole chiave
$kwsvincle="p.Titolo LIKE '%$kws%' OR p.Descrizione LIKE '%$kws%' OR p.Testo LIKE '%$kws%'";

$typejoin='';//frammento vicolo di tipo
if($_POST[type]==='a')
    $typejoin='JOIN Articoli a ON a.IdArticolo=p.Id';
elseif($_POST[type]==='r')
    $typejoin='JOIN Recensioni r ON r.IdRecensione=p.Id';
elseif($_POST[type]==='e')
    $typejoin='JOIN Eventi e ON e.IdEvento=p.Id';

$whenwhere='';//frammento vincolo temporale
if($_POST[when]==='week')
    $whenwhere="WHERE p.Data > NOW()-INTERVAL 1 WEEK";
elseif($_POST[when]==='month')
    $whenwhere="WHERE p.Data > NOW()-INTERVAL 1 MONTH";
elseif($_POST[when]==='year')
    $whenwhere="WHERE p.Data > NOW()-INTERVAL 1 YEAR";

$query="SELECT p.Id, p.Titolo, u.Nome, u.Cognome, p.Data, p.FPath, p.FAlt, p.Descrizione FROM Posts p $typejoin JOIN Editori ed ON (p.Autore=ed.Editore) JOIN Account u ON (ed.Editore=u.User) $whenwhere AND ($kwsvincle) ORDER BY p.Data;";
$aux=sql_query($query);
$i=0;
while($dtr=mysql_fetch_row($aux)){
    $posts[$i]=array(
	Id => $dtr[0],
	Titolo => $dtr[1],
	NomeAutore => $dtr[2],
	CognomeAutore => $dtr[3],
	Data => $dtr[4],
	FotoPath => $dtr[5],
	FotoAlt => $dtr[6],
	Descrizione => $dtr[7],
	Tags => getListTags($dtr[0]),
    );
    $i++;
}


print head("Music Break");
print top();
print nav("");
print "<br><br><br><h1>Ricerca</h1>";
print "<form action='$path/search.php' method='post'>
    <select name='when'>
	<option value='ever'>tutti gli anni</option>
	<option value='week'>ultima settimana</option>
	<option value='month'>ultimo mese</option>
	<option value='year'>ultimo anno</option>
    </select>
    <select name='type'>
	<option value='all'>Tutti</option>
	<option value='a'>Articoli</option>
	<option value='r'>Recensioni</option>
	<option value='e'>Eventi</option>
    </select>
    <input type='text' name='kws'/>
    <input type='submit' name='ricerca'/>
    </form>";
print "<div><br><br><br>";
if(isset($posts)){

    for($i=0; $i<(4*$page) && $i<count($posts); $i++) {
	print "<hr><div>
	<h2><a href='$path/post.php?id=".$posts[$i][Id]."'>".$posts[$i][Titolo]."</a></h2>
	<span>di ".$posts[$i][NomeAutore]." ".$posts[$i][CognomeAutore]." ".$posts[$i][Data]."</span>
	<div><img src='$path".$posts[$i][FotoPath]."' alt='".$posts[$i][FotoAlt]."'/></div>
	<p>".$posts[$i][Descrizione]."</p> 
	<a href='$path/post.php?id=".$posts[$i][Id]."'>continua...</a><ul>";
	for($e=0; $e<count($posts[$i][Tags]); $e++)
	    print "<li><a href='$path/search.php?tag=".$posts[$i][Tags][$e]."'>".$posts[$i][Tags][$e]."</a></li>";
	print "</ul></div>";
    }
    print "<p>Nav Pagine</p>";
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

}
print 	"</div>";

print footer();
?>
