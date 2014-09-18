<?php
require('CFUN.php');
if(!isEditor())
  die('Non hai i permessi necessari');
if(!isset($_POST['type']))
  die('$_POST[type] non definita');
$type=$_POST['type'];

$query="SELECT max(Id)+1 FROM Posts;";
$result=mysql_fetch_row(sql_query($query));
$id=$result[0];


$msg="";
switch ($type) {
case "a":
    echo "Stai scrivendo un Articolo.<br/>";
    //controllo che le variabili siano settate
    if(!isset($_POST['titolo']) && !isset($_POST['srcfoto']) && 
      !isset($_POST['altfoto']) && !isset($_POST['descrizione']) &&
      !isset($_POST['testo']) && !isset($_POST['tagslist']) &&
      !isset($_FILES['srcaudio']) && !isset($_POST['altaudio']))	die('<h1>Errore</h1>');
    if(!$_POST['titolo']) $msg.="&&msg1=Titolo vuoto";
    //controllo per le foto del post
    $uploadfotodir="/img/"; $name="photopost$id.jpg";
    $uploadfotodirname=$uploadfotodir.$name;
    if($_FILES['srcfoto']['tmp_name']==="") $msg.="&&msg2=foto di copertina assente";
    elseif($_FILES['srcfoto']['name']==="") $msg.="&&msg2=nome del file assente";
    elseif (!(($_FILES["srcfoto"]["type"] === "image/jpeg")||($_FILES["srcfoto"]["type"] === "image/jpg")))$msg.="&&msg2=file non compatibile";
    elseif(($_FILES["srcfoto"]["size"]/(1024*1024))>5) $msg.="&&msg2=foto articolo troppo pesante";
    //elseif(!move_uploaded_file($_FILES['srcfoto']['tmp_name'] , getcwd().$uploadfotodirname)) $msg.="&&msg2=upload foto non riuscito";
    if (!$_POST['altfoto']) $msg.="&&msg3=descrizione foto assente";
    if (!$_POST['descrizione']) $msg.="&&msg4=descrizione post assente";
    if (!$_POST['testo']) $msg.="&&msg5=stesura del post assente";
    //controllo per la lista dei tag
    $tags_array;
    if($_POST['tagslist']==='') $msg .="&&msg6=lista tag assente, inserire almeno un tag";
    else{
	$tags_array=explode("|",$_POST['tagslist']);
	$er=false;
	for($i=0; $i<count($tags_array) && !$er; $i++){
	    $tags_array[$i]=trim($tags_array[$i]);
	    if($tags_array[$i]==='') $er=true;
	}
	if($er) $msg .= "&&msg6=tag vuoti";
    }
    //controllo campi dati per le tracce audio
    $tr_alt_array=$_POST['altaudio'];
    $tr_name_array=$_FILES["srcaudio"]["name"];
    $tr_type_array=$_FILES["srcaudio"]["type"];
    $tr_size_array=$_FILES["srcaudio"]["size"];
    $tr_tmp_name_array=$_FILES["srcaudio"]["tmp_name"];
    for($i=0; $i<count($tr_tmp_name_array) && $tr_tmp_name_array[$i]!==""; $i++){
	$uploadaudiodir = "/audio/"; $traccia = "TracciaPost$id-$i.mp3";
	$uploadaudiodirname[$i] = $uploadaudiodir.$traccia; 
	$uploadaudioalt[$i]=$tr_alt_array[$i];
	if($tr_name_array[$i]==="") $msg.="&&msg".(6+$i)."=nome del file assente";
	elseif (!(($tr_type_array[$i] === "audio/mp4")||($tr_type_array[$i] === "audio/mpeg")))$msg.="&&msg".(6+$i)."=file non compatibile";
	elseif(($tr_size_array[$i]/(1024*1024))>7) $msg.="&&msg".(6+$i)."=audio articolo troppo pesante";
	//elseif(!move_uploaded_file($tr_tmp_name_array[$i] , getcwd().$uploadaudiodirname[$i])) $msg.="&&msg".(6+$i)."=upload audio non riuscito";
	if (!$tr_alt_array[$i]) $msg.="&&msg".(9+$i)."=descrizione traccia audio assente";
    }
    //controlli terminati
    if($msg!==""){//in caso di errore
	header("location: $path/backend.php?type=$type&&$msg");
    }else{
	inserisciArticolo($_POST['titolo'],$uploadfotodirname,$_POST['altfoto'],$_POST['descrizione'],$_POST['testo'],$tags_array,$uploadaudiodirname,$uploadaudioalt);
	move_uploaded_file($_FILES['srcfoto']['tmp_name'] , getcwd().$uploadfotodirname);
	for($i=0; $i<count($uploadaudiodirname); $i++)
	    move_uploaded_file($tr_tmp_name_array[$i],getcwd().$uploadaudiodirname[$i]);
	header("location: $path/post.php?id=$id");
    } 
break;
case "r":
    echo "Stai scrivendo una Recensione.";
    //controllo che le variabili siano settate
    if(!isset($_POST['titolo']) && !isset($_POST['srcfoto']) && 
      !isset($_POST['altfoto']) && !isset($_POST['descrizione']) &&
      !isset($_POST['testo']) && !isset($_POST['tagslist']) &&
      !isset($_FILES['srcgal']) && !isset($_POST['altgal']))	die('<h1>Errore</h1>');
    if(!$_POST['titolo']) $msg.="&&msg1=Titolo vuoto";
    //controllo per le foto del post
    $uploadfotodir="/img/"; $name="photopost$id.jpg";
    $uploadfotodirname=$uploadfotodir.$name;
    if($_FILES['srcfoto']['tmp_name']==="") $msg.="&&msg2=foto di copertina assente";
    elseif($_FILES['srcfoto']['name']==="") $msg.="&&msg2=nome del file assente";
    elseif (!(($_FILES["srcfoto"]["type"] === "image/jpeg")||($_FILES["srcfoto"]["type"] === "image/jpg")))$msg.="&&msg2=file non compatibile";
    elseif(($_FILES["srcfoto"]["size"]/(1024*1024))>5) $msg.="&&msg2=foto articolo troppo pesante";
    
    if (!$_POST['altfoto']) $msg.="&&msg3=descrizione foto assente";
    if (!$_POST['descrizione']) $msg.="&&msg4=descrizione post assente";
    if (!$_POST['testo']) $msg.="&&msg5=stesura del post assente";
    //controllo per la lista dei tag
    $tags_array;
    if($_POST['tagslist']==='') $msg .="&&msg6=lista tag assente, inserire almeno un tag";
    else{
	$tags_array=explode("|",$_POST['tagslist']);
	$er=false;
	for($i=0; $i<count($tags_array) && !$er; $i++){
	    $tags_array[$i]=trim($tags_array[$i]);
	    if($tags_array[$i]==='') $er=true;
	}
	if($er) $msg .= "&&msg6=tag vuoti";
    }
    //controllo campi dati per le foto della galleria
    $gl_alt_array=$_POST['altgal'];
    $gl_name_array=$_FILES["srcgal"]["name"];
    $gl_type_array=$_FILES["srcgal"]["type"];
    $gl_size_array=$_FILES["srcgal"]["size"];
    $gl_tmp_name_array=$_FILES["srcgal"]["tmp_name"];
    if(count($gl_tmp_name_array)==0) $msg .= "&&gall=inserire almeno una foto";
    else{
    for($i=0; $i<count($gl_tmp_name_array) && $gl_tmp_name_array[$i]!==""; $i++){
	$uploadgalldir = "/img/gallery/"; $photo = "FotoGalleria$id-$i.jpg";
	$uploadgalldirname[$i] = $uploadgalldir.$photo; 
	$uploadgallalt[$i]=$gl_alt_array[$i];
	if($gl_name_array[$i]==="") $msg.="&&srcgall$i=nome del file assente";
	elseif (!(($gl_type_array[$i] === "image/jpeg")||($gl_type_array[$i]==="image/jpg"))) $msg.="&&srcgall$i=file non compatibile";
	elseif(($gl_size_array[$i]/(1024*1024))>7) $msg.="&&srcgall$i=immagine troppo pesante";
	//elseif(!move_uploaded_file($tr_tmp_name_array[$i] , getcwd().$uploadaudiodirname[$i])) $msg.="&&msg".(6+$i)."=upload audio non riuscito";
	if (!$gl_alt_array[$i]) $msg.="&&altgall$i=descrizione immagine assente";
	}
    }
    //controlli terminati
    if($msg!==""){//in caso di errore
	header("location: $path/backend.php?type=$type&&$msg");
    }else{
	inserisciRecensione($_POST['titolo'],$uploadfotodirname,$_POST['altfoto'],$_POST['descrizione'],$_POST['testo'],$tags_array,$uploadgalldirname,$uploadgallalt);
	move_uploaded_file($_FILES['srcfoto']['tmp_name'] , getcwd().$uploadfotodirname);
	for($i=0; $i<count($uploadgalldirname); $i++){
	    move_uploaded_file($gl_tmp_name_array[$i], getcwd().$uploadgalldirname[$i]);
	}
	header("location: $path/post.php?id=$id");
    } 

break;
case "e":
    echo "Stai scrivendo un Evento.";
    //controllo che le variabili siano settate
    if(!isset($_POST['titolo'])
    && !isset($_POST['srcfoto'])
    && !isset($_POST['altfoto'])
    && !isset($_POST['descrizione'])
    && !isset($_POST['testo'])
    && !isset($_POST['day'])
    && !isset($_POST['month'])
    && !isset($_POST['year'])
    && !isset($_POST['location'])
    && !isset($_POST['InizioOre'])
    && !isset($_POST['InizioMinuti'])
    && !isset($_POST['FineOre'])
    && !isset($_POST['FineMinuti'])
    && !isset($_POST['price'])
    && !isset($_POST['email']) ) die('<h1>Errore</h1>');
    if(!$_POST['titolo']) $msg.="&&emttl=Titolo vuoto";
    //controllo per le foto del post
    $uploadfotodir="/img/"; $name="photopost$id.jpg";
    $uploadfotodirname=$uploadfotodir.$name;
    if($_FILES['srcfoto']['tmp_name']==="") $msg.="&&emft=foto di copertina assente";
    elseif($_FILES['srcfoto']['name']==="") $msg.="&&emft=nome del file assente";
    elseif (!(($_FILES["srcfoto"]["type"] === "image/jpeg")||($_FILES["srcfoto"]["type"] === "image/jpg")))$msg.="&&emft=file non compatibile";
    elseif(($_FILES["srcfoto"]["size"]/(1024*1024))>5) $msg.="&&emft=foto articolo troppo pesante";
    
    if (!$_POST['altfoto']) $msg.="&&emfa=descrizione foto assente";
    if (!$_POST['descrizione']) $msg.="&&emds=descrizione post assente";
    if (!$_POST['testo']) $msg.="&&emtx=stesura del post assente";
    //controllo per la lista dei tag
    $tags_array;
    if($_POST['tagslist']==='') $msg .="&&emtgs=lista tag assente, inserire almeno un tag";
    else{
	$tags_array=explode("|",$_POST['tagslist']);
	$er=false;
	for($i=0; $i<count($tags_array) && !$er; $i++){
	    $tags_array[$i]=trim($tags_array[$i]);
	    if($tags_array[$i]==='') $er=true;
	}
	if($er) $msg .= "&&emtgs=tag vuoti";
    }

    
    if($_POST['day']==='' || $_POST['month']==='' || $_POST['year']==='' )	$msg.="&&emdate=errore nella data";
    if($_POST['location']==='') $msg.="&&emloc=location assente";
    if($_POST['InizioOre']==='' || $_POST['InizioMinuti']==='')	$msg.="&&emoi=errore nell'orario di inizio";
    if($_POST['FineOre']==='' || $_POST['FineMinuti']==='')	$msg.="&&emof=errore nell'orario di fine";
    $dataEvento=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
    $oraInizio=$_POST['InizioOre'].':'.$_POST['InizioMinuti'].':00';
    $oraFine=$_POST['FineOre'].':'.$_POST['FineMinuti'].':00';

    if($_POST['price']==='') $msg.="&&empr=prezzo vuoto";
    if($_POST['email']==='') $msg.="&&eme=email vuota";
    //controlli terminati
    if($msg!==""){//in caso di errore
	header("location: $path/backend.php?type=$type&&$msg");
    }else{
	inserisciEvento($_POST['titolo'],$uploadfotodirname,$_POST['altfoto'],$_POST['descrizione'],$_POST['testo'],$tags_array,$dataEvento,$_POST['location'],$oraInizio,$oraFine,$_POST['price'],$_POST['email']);
	move_uploaded_file($_FILES['srcfoto']['tmp_name'] , getcwd().$uploadfotodirname);
	header("location: $path/post.php?id=$id");
    }
break;
}
?>
