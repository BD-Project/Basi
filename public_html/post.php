<?php
require('CFUN.php');
$path=getPath();
if(!isset($_GET['id'])) die("<h1>Errore</h1>");

$id=$_GET['id'];
$post=getPost($id);
$mediaArticolo=getMediaPost($id);

print head("Music Break");
print top();
print usrnav();
print nav("");
print "<br><br><br><div>
	<h1>$post[Titolo]</h1>
	<h2> Scritto da $post[NomeAutore] $post[NomeAutore] il $post[Data]</h2>";
if(isset($mediaArticolo))	echo "<h3>Valutazione degli utenti: $mediaArticolo/10</h3>";
else	echo "<h3>Vota per primo!</h3>";
if(isLogged()){
  if(!isEditor()){
    if(heVoted($id,$_SESSION['user']))	print "<h3>hai già votato</h3>";
    else{
      print "<h3>Dai la tua valutazione <form action='insVal.php' method='post'>
      <input type='radio' name='rating' value='0'>0
      <input type='radio' name='rating' value='1'>1
      <input type='radio' name='rating' value='2'>2
      <input type='radio' name='rating' value='3'>3
      <input type='radio' name='rating' value='4'>4
      <input type='radio' name='rating' value='5'>5
      <input type='radio' name='rating' value='6'>6
      <input type='radio' name='rating' value='7'>7
      <input type='radio' name='rating' value='8'>8
      <input type='radio' name='rating' value='9'>9
      <input type='radio' name='rating' value='10'>10
      <input type='hidden' name='idpost' value='$id'/>
      <input type='submit' name='sub' value='Valuta'/>
      </form></h3>";
    }
  }
}else	print "<h3><a href='login.php'>loggati per valutare</a></h3>";

echo "<ul>Ricerca post con Tags simili a:";
for($i=0; $i<count($post["Tags"]); $i++)
	print "<li><a href='$path/search.php?idtag=".$post[Tags][$i]." '>".$post[Tags][$i]." </a></li>";
echo "</ul>
	<img width='40%' src='".$path.$post[FotoPath]."' alt='".$post[FotoAlt]."'/>";
if($post["Type"]==="evento"){
print "<div id='informazioni'><ul>
	<li>Locale: <strong>$post[Locazione]</strong></li>
	<li>Ora Inizio: <strong>$post[OraInizio]</strong></li>
	<li>Ora Fine: <strong>$post[OraFine]</strong></li>
	<li>Prezzo: <strong>$post[Prezzo]</strong></li>
	<li>Info email:<strong>$post[Email]</strong></li>
    </ul></div>";
}
print "<p id='descrizione'>".$post[Testo]."</p>";
if($post["Type"]==="recensione"){
    print "<div id='gallery'><h3>Sfoglia la Gallery</h3>";
    for($i=0; $i<count($post["Gallery"]); $i++){
	print "<a href='".$path.$post[Gallery][$i][FPath]."'><img style='width:200px; ' src='".$path.$post[Gallery][$i][FPath]."' alt='".$post[Gallery][$i][FAlt]."'/></a>";}
    print "</div>";
}
if($post[Type]==="articolo" && count($post[Tracks])>0 ){
    for($i=0; $i<count($post["Tracks"]); $i++)
	print "<p><a href='$path".$post[Tracks][$i][Traccia]."'>".$post[Tracks][$i][Descrizione]."</a></p>";
}

if(!isLogged()){
  print "<a href='login.php'>Loggati commentare</a>";
}else{
  print 
  "<form action='inscomment.php' method='post' ><fieldset>
    Comment:<br/>
    <textarea name='comment' style='width:100%;' ></textarea><br/>
    <input type='hidden' name='idpost' value='$id' />
    <input type='submit' name='insert' value='Inserisci Commento' />
  </fieldset></form>";
}


print "<div id='comments'>
<dl>";
for($i=0; $i<count($post["Commenti"]); $i++){
    print "<dd><fieldset>
	    <h7>Mittente ".$post[Commenti][$i][Nome]." ".$post[Commenti][$i][Cognome]."</h7>
	    <p>".$post[Commenti][$i][Commento]."</p>
	  </fieldset></dd>";
}
print "</dl></div></div>";
print footer();
?>
