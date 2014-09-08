<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Europe/Rome');
$path="";//"/basidati/~aandelie";
session_start();

function getPath(){
    global $path;
    return $path;
}

function isLogged(){
    if(isset($_SESSION['user']))	return true;
    else	return false;
}

function isEditor(){
    $usr=$_SESSION['user'];
    $query="SELECT e.Editore FROM Editori e WHERE e.Editore='$usr';";
    $aux=sql_query($query);
    $dtu=mysql_fetch_row($aux);
    if($dtu[0] == "")	return false;
    else	return true;
}

function isArticle($id){
    $query="SELECT p.Id FROM Posts p JOIN Articoli a ON p.Id=a.IdArticolo WHERE p.Id=$id;";
    $ans=sql_query($query);
    if(mysql_fetch_row($ans))
	return true;
    else
	return false;
}

function isReview($id){
    $query="SELECT p.Id FROM Posts p JOIN Recensioni r ON p.Id=r.IdRecensione WHERE p.Id=$id;";
    $ans=sql_query($query);
    if(mysql_fetch_row($ans))
	return true;
    else
	return false;
}

function isEvent($id){
    $query="SELECT p.Id FROM Posts p JOIN Eventi e ON p.Id=e.IdEvento WHERE p.Id=$id;";
    $ans=sql_query($query);
    if(mysql_fetch_row($ans))
	return true;
    else
	return false;
}

function getMediaPost($id){
    $query="SELECT sum(Voto)/count(*) FROM Posts p JOIN Valutazioni v ON p.Id=v.IdPost WHERE p.Id=$id GROUP BY p.Id;";
    $aux=sql_query($query);
    $val=mysql_fetch_row($aux);
    return $val[0];
}

function getListTags($id){
    $query="SELECT t.Label FROM Tag t JOIN Tags ts ON t.Label=ts.IdTag WHERE ts.IdPost='$id';";
    $uax=sql_query($query);
    $i=0;
    while($t=mysql_fetch_row($uax)){
	$tags[$i]=$t[0]; $i++;
    }
    return $tags;
}

function getListTracks($id){
    $query="SELECT a.Traccia, a.Descrizione FROM Audio a JOIN Articoli ar ON a.IdArticolo=ar.IdArticolo WHERE ar.IdArticolo=$id ;";
    $aux=sql_query($query);
    $i=0;
    while($tr=mysql_fetch_row($aux)){
	$tracks[$i]=array( Traccia => $tr[0], Descrizione => $tr[1] );
	$i++;
    }
    return $tracks;
}

function getListGallery($id){
    $query="SELECT g.FPath, g.FAlt FROM Gallerie g JOIN Recensioni r ON (g.IdPost=r.IdRecensione) WHERE r.IdRecensione='$id'";
    $fux=sql_query($query);
    $i=0;
    while($g=mysql_fetch_row($fux)){
	$gall[$i]=array( FPath => $g[0], FAlt => $g[1]);
	$i++;
    }
    return $gall;
}

function getListComments($id){
    $query="SELECT a.Nome, a.Cognome, c.Commento FROM Commenti c JOIN Account a ON (c.Utente=a.User) WHERE c.IdPost='$id' ORDER BY c.Tempo ";
    $cux=sql_query($query);
    $i=0;
    while ($c=mysql_fetch_row($cux)){
	$comm[$i]=array(Nome => $c[0], Cognome => $c[1], Commento => $c[2] );
	$i++;
    }
    return $comm;
}

function getPost($id){
    $query="SELECT p.Titolo, u.Nome, u.Cognome, p.Data, p.FPath, p.FAlt, p.Descrizione, p.Testo FROM Posts p JOIN Recensioni r ON p.Id=r.IdRecensione JOIN Editori e ON (p.Autore=e.Editore) JOIN Account u ON (e.Editore=u.User) WHERE p.Id='$id'";
    $aux=sql_query($query);
    $dtr=mysql_fetch_row($aux);
    if($dtr){
	return array(
	    Type => "recensione",
	    Titolo => $dtr[0],
	    NomeAutore => $dtr[1],
	    CognomeAutore => $dtr[2],
	    Data => $dtr[3],
	    FotoPath => $dtr[4],
	    FotoAlt => $dtr[5],
	    Descrizione => $dtr[6],
	    Testo => $dtr[7],
	    Tags => getListTags($id),
	    Gallery => getListGallery($id),
	    Commenti => getListComments($id),
	);
    }

    $query="SELECT p.Titolo, u.Nome, u.Cognome, p.Data, p.FPath, p.FAlt, p.Descrizione, p.Testo FROM Posts p JOIN Articoli a ON p.Id=a.IdArticolo JOIN Editori e ON (p.Autore=e.Editore) JOIN Account u ON (e.Editore=u.User) WHERE p.Id='$id'";
    $aux=sql_query($query);
    $dtp=mysql_fetch_row($aux);
    if($dtp){
	return array(
	    Type => "articolo",
	    Titolo => $dtp[0],
	    NomeAutore => $dtp[1],
	    CognomeAutore => $dtp[2],
	    Data => $dtp[3],
	    FotoPath => $dtp[4],
	    FotoAlt => $dtp[5],
	    Descrizione => $dtp[6],
	    Testo => $dtp[7],
	    Tags => getListTags($id),
	    Tracks => getListTracks($id),
	    Commenti => getListComments($id),
	);
    }
    
    $query="SELECT p.Titolo, u.Nome, u.Cognome, p.Data, p.FPath, p.FAlt, p.Descrizione, p.Testo, ev.DataEvento, ev.Locazione, ev.OraInizio, ev.OraFine, ev.Prezzo, ev.Email FROM Posts p JOIN Eventi ev ON p.Id=ev.IdEvento JOIN Editori e ON (p.Autore=e.Editore) JOIN Account u ON (e.Editore=u.User) WHERE p.Id='$id'";
    $eox=sql_query($query);
    $dte=mysql_fetch_row($eox);
    if($dte){
	return array(
	    Type => "evento",
	    Titolo => $dte[0],
	    NomeAutore => $dte[1],
	    CognomeAutore => $dte[2],
	    Data => $dte[3],
	    FotoPath => $dte[4],
	    FotoAlt => $dte[5],
	    Descrizione => $dte[6],
	    Testo => $dte[7],
	    Tags => getListTags($id),
	    DataEvento => $dte[8],
	    Locazione => $dte[9],
	    OraInizio => $dte[10],
	    OraFine => $dte[11],
	    Prezzo => $dte[12],
	    Email => $dte[13],
	    Commenti => getListComments($id),
	);
    }
    

}

function getListPosts($type){
    if($type==='h'){
	$query="SELECT p.Id, p.Titolo, u.Nome, u.Cognome, p.Data, p.FPath, p.FAlt, p.Descrizione FROM Posts p JOIN Editori ed ON (p.Autore=ed.Editore) JOIN Account u ON (ed.Editore=u.User) ORDER BY p.Data DESC LIMIT 0,4;";
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
	return $posts;
    }
    if($type==="a"){
	$query="SELECT p.Id, p.Titolo, u.Nome, u.Cognome, p.Data, p.FPath, p.FAlt, p.Descrizione FROM Posts p JOIN Articoli a ON p.Id=a.IdArticolo JOIN Editori ed ON p.Autore=ed.Editore JOIN Account u ON ed.Editore=u.User ORDER BY p.Data DESC";
	$aux = sql_query($query);
	$i=0;
	while($dtr=mysql_fetch_row($aux)){
	    $articoli[$i]=array(
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
	return $articoli;
    }
    if($type==="r"){
	$query="SELECT p.Id, p.Titolo, u.Nome, u.Cognome, p.Data, p.FPath, p.FAlt, p.Descrizione FROM Posts p JOIN Recensioni r ON p.Id=r.IdRecensione JOIN Editori ed ON p.Autore=ed.Editore JOIN Account u ON ed.Editore=u.User ORDER BY p.Data DESC";
	$aux = sql_query($query);
	$i=0;
	while($dtr=mysql_fetch_row($aux)){
	    $recensioni[$i]=array(
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
	return $recensioni;
    }
    if($type==="e"){
	$query="SELECT p.Id, p.Titolo, u.Nome, u.Cognome, p.Data, p.FPath, p.FAlt, p.Descrizione FROM Posts p JOIN Eventi e ON p.Id=e.IdEvento JOIN Editori ed ON p.Autore=ed.Editore JOIN Account u ON ed.Editore=u.User ORDER BY e.DataEvento DESC";
	$aux = sql_query($query);
	$i=0;
	while($dtr=mysql_fetch_row($aux)){
	    $recensioni[$i]=array(
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
	return $recensioni;
    }
    
}

function getSideBar(){
    $query = "SELECT p.Id, p.Titolo FROM Posts p JOIN Articoli a ON p.Id=a.IdArticolo ORDER BY p.Data DESC LIMIT 0,3;";
    $apx = sql_query($query);
    $i=0;
    while($a=mysql_fetch_row($apx)){
	$articoli[$i]= array( Id => $a[0], Titolo => $a[1],);
	$i++;
    }

    $query = "SELECT p.Id, p.Titolo FROM Posts p JOIN Recensioni r ON p.Id=r.IdRecensione ORDER BY p.Data DESC LIMIT 0,3;";
    $rpx = sql_query($query);
    $i=0;
    while($r=mysql_fetch_row($rpx)){
	$recensioni[$i]= array( Id => $r[0], Titolo => $r[1],);
	$i++;
    }

    $query = "SELECT p.Id, p.Titolo FROM Posts p JOIN Eventi e ON p.Id=e.IdEvento ORDER BY p.Data DESC LIMIT 0,3;";
    $epx = sql_query($query);
    $i=0;
    while($e=mysql_fetch_row($epx)){
	$eventi[$i]= array( Id => $e[0], Titolo => $e[1],);
	$i++;
    }

    return array( Articoli => $articoli, Recensioni => $recensioni, Eventi => $eventi);
}

function inserisciArticolo($titolo,$fotosrc,$fotoalt,$descrizione,$testo,$tags,$audioSrc,$audioAlt){
    $host="localhost";
    $user="aandelie";
    $myFile = "SQL/bd2014.password";
    $fh = fopen($myFile, 'r');
    $pwd = fread($fh, 8);
    $conn=mysql_connect($host,$user,$pwd)
        or die($_SERVER['PHP_SELF']."Connessione fallita!");
    $dbname="aandeliePR";
    mysql_select_db($dbname);
    $query="CREATE TEMPORARY TABLE tmp_tags (lbl VARCHAR(32) PRIMARY KEY);";
    mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    $query="CREATE TEMPORARY TABLE tmp_tracks (pth VARCHAR(255) PRIMARY KEY, alt TEXT);";
    mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    foreach($tags as $tag){
	$query="INSERT INTO tmp_tags VALUES(\"$tag\");";
	mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    }
    for($i=0; $i<count($audioSrc); $i++){
	$query ="INSERT INTO tmp_tracks VALUES(\"$audioSrc[$i]\",\"$audioAlt[$i]\");";
	mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    }
    $editor=$_SESSION['user'];
    $query="CALL inserisciArticolo(\"$titolo\",\"$fotosrc\",\"$fotoalt\",\"$descrizione\",\"$testo\",\"$editor\");";
    mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    mysqli_close($conn);
}

function inserisciRecensione($titolo,$fotosrc,$fotoalt,$descrizione,$testo,$tags,$GallSrc,$GallAlt){
    $host="localhost";
    $user="aandelie";
    $myFile = "SQL/bd2014.password";
    $fh = fopen($myFile, 'r');
    $pwd = fread($fh, 8);
    $conn=mysql_connect($host,$user,$pwd)
        or die($_SERVER['PHP_SELF']."Connessione fallita!");
    $dbname="aandeliePR";
    mysql_select_db($dbname);
    $query="CREATE TEMPORARY TABLE tmp_gallery (fp varchar(255) PRIMARY KEY, fa varchar(255));";
    mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    $query="CREATE TEMPORARY TABLE tmp_tags (lbl VARCHAR(32) PRIMARY KEY);";
    mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    foreach($tags as $tag){
	$query="INSERT INTO tmp_tags VALUES(\"$tag\");";
	mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    }
    for($i=0; $i<count($GallSrc); $i++){
	$query="INSERT INTO tmp_gallery VALUES(\"$GallSrc[$i]\",\"$GallAlt[$i]\");";
	mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    }
    $editor=$_SESSION['user'];
    $query="CALL inserisciRecensione(\"$titolo\",\"$fotosrc\",\"$fotoalt\",\"$descrizione\",\"$testo\",\"$editor\");";
    mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    mysqli_close($conn);
}

function inserisciEvento($titolo,$fotosrc,$fotoalt,$descrizione,$testo,$tags,$dataEvento,$location,$oraInizio,$oraFine,$price,$email){
    $host="localhost";
    $user="aandelie";
    $myFile = "SQL/bd2014.password";
    $fh = fopen($myFile, 'r');
    $pwd = fread($fh, 8);
    $conn=mysql_connect($host,$user,$pwd)
        or die($_SERVER['PHP_SELF']."Connessione fallita!");
    $dbname="aandeliePR";
    mysql_select_db($dbname);
    $query="CREATE TEMPORARY TABLE tmp_tags (lbl VARCHAR(32) PRIMARY KEY);";
    mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    foreach($tags as $tag){
	$query="INSERT INTO tmp_tags VALUES(\"$tag\");";
	mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    }
    $editor=$_SESSION['user'];
    $query="CALL inserisciEvento(\"$titolo\",\"$fotosrc\",\"$fotoalt\",\"$descrizione\",\"$testo\",\"$editor\",\"$dataEvento\",\"$location\",\"$oraInizio\",\"$oraFine\",\"$price\",\"$email\");";
    mysql_query($query,$conn) or die("Query fallita".mysql_error($conn));
    mysqli_close($conn);
}

function inserisciCommento(){
    
}

function heVoted($id,$user){
    $query="SELECT Voto FROM Valutazioni WHERE IdPost=$id && Utente='$user';";
    $vux=sql_query($query);
    if(mysql_fetch_row($vux)) return true;
    else return false;
}

function head($title){
    $path=getPath();
    header('Content-Type: text/html; charset=utf-8');
	$aux = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='it' lang='it'>
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                <meta name='author' content='Alberto Andeliero'/>
                <meta name='language' content='italian it'/>
                <meta name='rating' content='safe for kids' />
                <meta name='description' content='Il portale di news, articoli, recensioni ed eventi dedicato alla musica'/>
                <meta name='robots' content='all' />
                <link rel='icon' href='$path/img/fav.ico' type='image/icon' />
                <link rel='stylesheet' type='text/css' media='handheld, screen' href='$path/css/screen.css'/>
                <link rel='stylesheet' type='text/css' media='print' href='$path/css/print.css'/>
                <link rel='stylesheet' type='text/css' media='speech' href='$path/css/aural.css'/>
                <title>$title</title>
            </head>
            <body>";
	return $aux;
}

function top(){
    $path=getPath();
    $aux = "<div><a href='$path/home.php'>
                    <img id='logo' src='$path/img/tazza-di-caffe.jpg' alt='Tazza di caffè fumante in cui viene immersa  una pausa di semiminima'/>
                </a>
                <h1><a href='$path/home.php'>Music Break</a></h1>
                <p>Il portale di notizie dedicato alla musica</p>
            </div>";
    return $aux;
}

function usrnav(){
	$path=getPath();
	$addB="";
    if(isLogged()){
	$addB.="<a href='$path/profile.php'>Mio Profilo</a>";
	if(isEditor()){
		$addB .= " <a href='$path/backend.php'>Scrivi Articolo...</a>";
	}
        $addB .= " <a href='$path/logout.php'>Logout</a>";
    }else{
        $addB .= "<a href='$path/login.php'>Login</a>";
    }
	print $addB;
}

function nav($type){
    $path=getPath();
    
    $aux="<ul>";
    if ($type=='h')	$aux .= "<li>Home</li>";
    else	$aux .= "<li><a href='$path/home.php'>Home</a></li>";
    
    if ($type=='a')	$aux .= "<li>Articoli</li>";
    else	$aux .= "<li><a href='$path/show.php?type=a'>Articoli</a></li>";

    if ($type=='r')	$aux .= "<li>Recensioni</li>";
    else	$aux .= "<li><a href='$path/show.php?type=r'>Recensioni</a></li>";
    
    if ($type=='e')	$aux .= "<li>Eventi</li>";
    else	$aux .= "<li><a href='$path/show.php?type=e'>Eventi</a></li>";
    
    $aux .= "<li><a href='$path/search.php'>Fai una ricerca...</a></li></ul>";
    return $aux;
}


function footer(){
    $path=getPath();
    $aux = "</body></html>";
    return $aux;
}

function sql_query($query) {
    $host="localhost";
    $user="aandelie";
    $myFile = "SQL/bd2014.password";
    $fh = fopen($myFile, 'r');
    $pwd = fread($fh, 8);
    $conn=mysql_connect($host,$user,$pwd)
        or die($_SERVER['PHP_SELF']."Connessione fallita!");
    $dbname="aandeliePR";
    mysql_select_db($dbname);
    $ritorno=mysql_query($query,$conn)
        or die("Query fallita".mysql_error($conn));
    return $ritorno;
}

?>
