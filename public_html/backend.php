<?php
require('CFUN.php');

if(!isEditor() ){
	header('Location: home.php');
}

print head("Music Break");
print top();
print "<h2><a href='profile.php'>Torna indietro</a></h2>";
print "<div>Scrivi articolo
	<ul>
	  <li><a href='backend.php?type=a'>Articolo</a></li>
	  <li><a href='backend.php?type=r'>Recensione</a></li>
	  <li><a href='backend.php?type=e'>Evento</a></li>
	</ul>
    </div>";


if(!isset($_GET['type'])){}
elseif($_GET['type']=='a'){
	print "
<h3>Scrivi Articolo...</h3>
<form action='inspost.php' method='post' enctype='multipart/form-data'>
	<p>Titolo: <input type='text' name='titolo'/></p>
	<p>Selezionare una foto: <input type='file' name='srcfoto'/></p>
	<p>Descrizione testuale foto:<input type='text' name='altfoto'/></p>
	<p>Descrizione articolo: </p><p><textarea cols='30' rows='10' wrap='off' name='descrizione'></textarea></p>
	<p>Testo:<p/><p><textarea cols='30' rows='10' wrap='off' name='testo'></textarea></p>
	<p>Inserisci una lista di tag separati da | :<input type='text' name='tagslist'/></p>
	<p>Nel caso puoi inserire qualche traccia audio con relativa descrizione: </p>
	<p><input type='file' name='srcaudio[]'/><input type='text' name='altaudio[]'/></p>
	<p><input type='file' name='srcaudio[]'/><input type='text' name='altaudio[]'/></p>
	<p><input type='file' name='srcaudio[]'/><input type='text' name='altaudio[]'/></p>
	<p><input type='submit' name='inserisci'/></p>
	<input type='hidden' name='type' value='$_GET[type]' />
</form>";
}elseif($_GET['type']=='r'){
	print "
<h3>Scrivi Recensione...</h3>
<form action='inspost.php' method='post' enctype='multipart/form-data'>
	<p>Titolo: <input type='text' name='titolo'/></p>
	<p>Selezionare una foto: <input type='file' name='srcfoto'/></p>
	<p>Descrizione testuale foto:<input type='text' name='altfoto'/></p>
	<p>Descrizione articolo: </p><p><textarea cols='30' rows='10' wrap='off' name='descrizione'></textarea></p>
	<p>Testo:<p/><p><textarea cols='30' rows='10' wrap='off' name='testo'></textarea></p>
	<p>Inserisci una lista di tag separati da | :<input type='text' name='tagslist'/></p>
	<p>Selezionare e fare una descrizione per le foto della gallery:</p>
	<p><input type='file' name='srcgal[]'/><input type='text' name='altgal[]'/></p>
	<p><input type='file' name='srcgal[]'/><input type='text' name='altgal[]'/></p>
	<p><input type='file' name='srcgal[]'/><input type='text' name='altgal[]'/></p>
	<p><input type='file' name='srcgal[]'/><input type='text' name='altgal[]'/></p>
	<p><input type='file' name='srcgal[]'/><input type='text' name='altgal[]'/></p>
	<p><input type='file' name='srcgal[]'/><input type='text' name='altgal[]'/></p>
	<p><input type='file' name='srcgal[]'/><input type='text' name='altgal[]'/></p>
	<p><input type='file' name='srcgal[]'/><input type='text' name='altgal[]'/></p>
	<p><input type='file' name='srcgal[]'/><input type='text' name='altgal[]'/></p>
	<p><input type='file' name='srcgal[]'/><input type='text' name='altgal[]'/></p>
	<p><input type='submit' name='inserisci'/></p>
	<input type='hidden' name='type' value='$_GET[type]' />
</form>";
}elseif($_GET['type']=='e'){
	print "
<h3>Scrivi Evento...</h3>
<form action='inspost.php' method='post' enctype='multipart/form-data'>
	<p>Titolo: <input type='text' name='titolo'/></p>
	<p>Selezionare una foto: <input type='file' name='srcfoto'/></p>
	<p>Descrizione testuale foto:<input type='text' name='altfoto'/></p>
	<p>Descrizione articolo: </p><p><textarea cols='30' rows='10' wrap='off' name='descrizione'></textarea></p>
	<p>Testo:<p/><p><textarea cols='30' rows='10' wrap='off' name='testo'></textarea></p>
	<p>Inserisci una lista di tag separati da | :<input type='text' name='tagslist'/></p>
	<p>Data dell' Evento:
	<input type='number' name='day' min='1' max='31' value='1'/>-
	<input type='number' name='month' min='1' max='12' value='1'/>-
	<input type='number' name='year' value='2000'/>
	</p>
	<p>Posto dell'evento:<input type='text' name='location'/></p>
	<p>Orario di Inizio:
		<input type='number' name='InizioOre' min='1' max='23' value='0'/>
		<input type='number' name='InizioMinuti' min='1' max='59' value='0'/>
	</p>
	<p>Orario di Fine:
		<input type='number' name='FineOre' min='1' max='23' value='0'/>
		<input type='number' name='FineMinuti' min='1' max='59' value='0'/>
	</p>
	<p>Prezzo: <input type='number' name='price'/></p>
	<p>Recapito e-mail: <input type='text' name='email'/></p>
	<p><input type='submit' name='inserisci'/></p>
	<input type='hidden' name='type' value='$_GET[type]' />
</form>";
}
print footer();

?>
