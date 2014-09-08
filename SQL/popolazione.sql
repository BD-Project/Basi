DELETE FROM Tags;
DELETE FROM Tag;
DELETE FROM Eventi;
DELETE FROM Gallerie;
DELETE FROM Recensioni;
DELETE FROM Audio;
DELETE FROM Articoli;
DELETE FROM Commenti;
DELETE FROM Valutazioni;
DELETE FROM Posts;
DELETE FROM Editori;
DELETE FROM Utenti;
DELETE FROM Account;


/*POPOLAZIONE*/

CALL creaUtente("teciocross","progetto","Marco","Trattore");
CALL creaUtente("cat_king","progetto","Davide","Cattaneo");
CALL creaUtente("gazz90","progetto","Davide","Gazzoa");
CALL creaEditore("andeliero92","progetto","Alberto","Andeliero");
CALL creaEditore("frigo.math","progetto","Matteo","Frezer");

/*Sfrutto queste tabelle temporanee per poter passare degli array nelle procedure*/
DROP TEMPORARY TABLE IF EXISTS tmp_tags;
CREATE TEMPORARY TABLE tmp_tags (lbl VARCHAR(32) PRIMARY KEY);
DROP TEMPORARY TABLE IF EXISTS tmp_tracks;
CREATE TEMPORARY TABLE tmp_tracks (pth VARCHAR(255) PRIMARY KEY, alt TEXT);
DROP TEMPORARY TABLE IF EXISTS tmp_gallery;
CREATE TEMPORARY TABLE tmp_gallery (fp varchar(255) PRIMARY KEY, fa varchar(255));


INSERT INTO tmp_tags VALUES ("pop"),("blues");
INSERT INTO tmp_tracks VALUES ("/audio/TracciaPost1-1.mp3", "Estratto del singolo di Bruse Sprigsteen");
CALL inserisciArticolo("Bruce Springsteen, High hopes finisce in rete, le prime recensioni","/img/photopost1.jpg","foto copertina album del grande boss","Come riportato da Rockol.com ieri, sabato è finito in rete il nuovo album di Bruce Springsteen","Come riportato da Rockol.com ieri, sabato è finito in rete il nuovo album di Bruce Springsteen, High hopes, atteso per il 14 gennaio. L'album è stato messo accidentalmente in rete da Amazon, che l'ha reso regolarmente acquistabile sulla versione mobile del proprio store americano. Dopo qualche ora il link è stato rimosso, ma diversi fan hanno fatto in tempo a comprarlo legelamente (ed è partita la discussione su board, blog e social network). Conseguentemente, ecco anche le prime recensioni del disco, tra cui quella dei nostri cugini di Rockol.com che potete leggere qua","andeliero92");

INSERT INTO tmp_tags VALUES ("pop"),("sanremo");
INSERT INTO tmp_gallery VALUES ("/img/gallery/gallery2-1.jpg","foto della gallery"),("/img/gallery/gallery2-2.jpg","foto della gallery"),("/img/gallery/gallery2-3.jpg","foto della gallery"),("/img/gallery/gallery2-4.jpg","foto della gallery"),("/img/gallery/gallery2-5.jpg","foto della gallery"),("/img/gallery/gallery2-6.jpg","foto della gallery"),("/img/gallery/gallery2-7.jpg","foto della gallery"),("/img/gallery/gallery2-8.jpg","foto della gallery"),("/img/gallery/gallery2-9.jpg","foto della gallery"),("/img/gallery/gallery2-10.jpg","foto della gallery");
CALL inserisciRecensione("Noemi: Sanremo, The Voice e un nuovo disco. Dopo Londra, sono pronta per rimettermi in gioco","/img/photopost2.jpg","noemi che canta sopre il palco","Sanremo, The Voice e il nuovo disco. Un anno intenso per la rossa Noemi, che in attesa di salire sul palco dell'Ariston ci parla di sé e dei suoi mille impegni. Made in London, che uscirà il prossimo 20 febbraio, è il nuovo album di Noemi.","Sanremo, The Voice e il nuovo disco. Un anno intenso per la rossa Noemi, che in attesa di salire sul palco dell'Ariston ci parla di sé e dei suoi mille impegni. Made in London, che uscirà il prossimo 20 febbraio, è il nuovo album di Noemi.Sanremo, The Voice e il nuovo disco. Un anno intenso per la rossa Noemi, che in attesa di salire sul palco dell'Ariston ci parla di sé e dei suoi mille impegni. Made in London, che uscirà il prossimo 20 febbraio, è il nuovo album di Noemi.Sanremo, The Voice e il nuovo disco. Un anno intenso per la rossa Noemi, che in attesa di salire sul palco dell'Ariston ci parla di sé e dei suoi mille impegni. Made in London, che uscirà il prossimo 20 febbraio, è il nuovo album di Noemi.",'andeliero92');

INSERT INTO tmp_tags VALUES ("alternative") ;
INSERT INTO tmp_tracks VALUES ("/audio/TracciaPost3-1.mp3", "Leaks del nuovo album dei Tool");
CALL inserisciArticolo("Tool, il nuovo album finito al 100%","/img/photopost3.jpg","La band Tool al completo","La notizia più bella per i fan della band di Maynard James Keenan, che intanto si prepara a festeggiare i suoi primi 50 anni con un evento dal vivo","Non ce la faranno a uscire nella prima parte del 2014, come speravano lo scorso autunno, ma di sicuro è conclusa la registrazione del nuovo disco dei Tool, che era in lavorazione da diversi mesi a causa degli impegni multipli del frontman Maynard James Keenan. Lo ha confermato al sito Crave Online il chitarrista Adam Jones, specificando che una data di uscita non è decisa ma che il lavoro potrebbe arrivare nella seconda metà dell’anno, e che la lavorazione è completata al 100%.A proposito di Maynard, il 10 maggio il cantante festeggerà i propri primi 50 anni con i Tool ma solo fra il pubblico di un evento dal vivo che lo vedrà come protagonista su un palco sia alla testa degli A Perfect Circle che dei Puscifer: un concerto di compleanno, insomma, al Greek Theatre di Los Angeles. Aperto a tutti (in teoria… i biglietti sono già esauriti!).","andeliero92");

INSERT INTO tmp_tags VALUES ("blues");
CALL inserisciArticolo("B.B. King si scusa per il concerto disastroso di St Louis","/img/photopost4.jpg","BB King al microfono che canta","Anche i grandi hanno le loro serate no. E a B.B. King ne è capitata una davvero storta, lo scorso 4 aprile, quando si è esibito","Anche i grandi hanno le loro serate no. E a B.B. King ne è capitata una davvero storta, lo scorso 4 aprile, quando si è esibito - o meglio, ha tentato di esibirsi - alla Peabody Opera House di St. Louis; purtroppo il leggendario bluesman non riusciva a suonare e - stando a quanto riportato dal St Louis Post-Dispatch ha proposto solo Rock Me Baby, poi una versione di 15 minuti di You Are My Sunshine, durante cui B.B. parlava col pubblico e salutava. Alla fine di questo brano molti degli spettatori avevano già lasciato il locale e B.B. si è congedato suonando altri tre brani in maniera approssimativa.Ora è giunto un documento ufficiale di scuse, tramite un portavoce di B.B. King, che ha spiegato come l accaduto sia da imputare al fatto che il musicista, quella sera, aveva dimenticato di prendere le sue medicine. Mr. King soffre di diabete, spiega il portavoce, e per errore ha dimenticato di assumere una dose delle sue medicine proprio il giorno del concerto. Per farla breve, è stata una serataccia per una delle leggende viventi del blues americano e Mr. King si scusa e chiede umilmente ai suoi fan di comprenderlo.B.B. King avrà 89 anni il prossimo 16 settembre e ancora si esibisce dal vivo ed è stato stimato che negli ultimi 64 anni abbia tenuto più di 15.000 concerti.","andeliero92");

INSERT INTO tmp_tags VALUES ("jazz"),("r&b");
CALL inserisciEvento("TAKIN' OFF Original Vinyl Session","/img/photopost5.jpg","Volantino dell evento","A distanza di un anno torna TAKIN' OFF per la sua terza edizione. Location nuova e città nuova ma energia e qualità musicale invariate.","Ad accogliervi al SARTEA BAR di Vicenza ci saranno i dischi originali a 45 r.p.m. dei i due promotori della serata!!! G.J.(Mod Jazz/Hammond Groove/Jazzy) RB/ComboBeeBomStyle SHEPHERD(Mod79/PowerPop/TwoTone/BritPop) A seguire il prezioso Live Set de: I RUDI(Power Pop/RB) from Milano Who, Small Faces e Jam nel cuore, ma senza una chitarra in formazione: i Rudi sono un power trio che spazia dall' r'n'b al mod revival e al garage-beat anni '60. L'ingrediente principale sono le tastiere, a cui si aggiungono voce, basso e batteria, il risultato finale non è lontano dal sound spurio dei Merton Parkas o dei Prisoners. Il repertorio dei Rudi si divide equamente tra cover (i classici Ray Charles, Booker T end the Mg's e Brian Auger, ma anche Secret Affair e Chords) e pezzi in italiano di loro composizione contenuti nell' ep di recente uscita intitolato Tre Pezzi di Routine. A mettere a dura prova le vostre caviglie-rotule-anche ci penseranno i nostri guest djs: TOMMY ROUGHTOUGH(Ska/Rocksteady/Reggae) PIERONI(Soul/Motown/RB)","frigo.math","2014-04-25","Loc. Sartea Vicenza Corso dei Santi Felice e Fortunato","21:00:00","01:00:00","10","info@takinoff.com");



CALL inserisciCommento ('andeliero92',1,"Vivamus at sagittis lorem. Nunc molestie turpis facilisis libero varius, nec vulputate elit accumsan. Fusce et dictum lectus. Mauris at odio nisl. Nulla facilisi. Nunc eu erat non quam lacinia porttitor. Praesent vitae nunc diam. Maecenas eget mauris porta, viverra dui consequat, commodo tellus.");
CALL inserisciCommento ('teciocross',1,"Etiam eros dui, sollicitudin vel rhoncus ac, iaculis ac dolor. Nunc sit amet aliquet felis. Integer pharetra feugiat quam, sagittis mattis sapien fermentum a. Nam ligula ante, elementum et risus egestas, suscipit tristique nunc. Morbi at ipsum erat. Curabitur nec dignissim metus. Phasellus quis eros ut augue semper lacinia quis a massa. Sed egestas mollis consectetur. Phasellus laoreet id enim nec ornare. Proin mi lacus, hendrerit ut ullamcorper non, vehicula ut urna. Vestibulum mattis arcu nec gravida tristique. Quisque auctor facilisis dapibus. Proin eget malesuada sapien. Mauris posuere molestie sollicitudin.");
CALL inserisciCommento ('frigo.mat',2,"Vivamus non magna mi. Ut congue mollis nunc, vel vestibulum erat vehicula nec. Nam convallis mauris est, vel fermentum erat mattis ac. Phasellus vel nibh ut lacus condimentum imperdiet. Cras auctor massa elementum dui blandit aliquam. Fusce in mollis risus. Ut in ornare mi.");
CALL inserisciCommento ('cat_king',2,"Vivamus non magna mi. Ut congue mollis nunc, vel vestibulum erat vehicula nec. Nam convallis mauris est, vel fermentum erat mattis ac. Phasellus vel nibh ut lacus condimentum imperdiet. Cras auctor massa elementum dui blandit aliquam. Fusce in mollis risus. Ut in ornare mi.");
CALL inserisciCommento ('gazz90',2,"In hendrerit fringilla metus, sit amet vehicula sapien. Duis ultricies, nisi eget dictum dapibus, nisi libero commodo est, et molestie metus justo eget eros. Nulla ultrices eros quis vulputate accumsan. Phasellus imperdiet lacus volutpat, venenatis dolor et, cursus nulla. Maecenas non sem luctus, fermentum augue non, tempus magna. Praesent lorem mauris, hendrerit eu viverra mattis, interdum ac turpis. Donec quis dictum odio, vitae placerat dolor. Donec vulputate, orci a sagittis sodales, nulla nulla congue risus, sit amet sodales arcu eros eu purus.");
CALL inserisciCommento ('andeliero92',3,"Cras gravida sit amet magna sit amet ornare. Fusce semper sodales tortor, sit amet tristique ante faucibus eget. Fusce bibendum nec tortor a ullamcorper. Mauris nulla lacus, malesuada ut tempor ac, tempus sit amet augue. Praesent non odio malesuada turpis faucibus scelerisque. Cras congue faucibus tempor. Suspendisse potenti. Suspendisse sed ligula aliquet, luctus sem sit amet, euismod nisl. Integer purus sem, pretium id hendrerit vitae, elementum id nisl. Vestibulum non fringilla nulla. Aenean porta mollis risus id pretium. Phasellus et odio in justo cursus tempor.");
CALL inserisciCommento ('frigo.mat',3,"Fusce eget lacus ultricies, blandit ipsum quis, sagittis nunc. Vestibulum adipiscing tincidunt augue, vitae mollis nisl. Donec vestibulum, turpis eget mattis aliquam, magna tellus semper mauris, vel porta ante quam sed tortor. Proin tempor ipsum nec felis rutrum consequat. Sed dui lectus, viverra non sollicitudin sit amet, malesuada vel purus. Suspendisse semper eros lacus, sed suscipit tellus aliquam a. Sed pretium, nunc quis iaculis rutrum, ipsum massa elementum velit, in ultrices arcu mi eget nisi. Integer non vulputate augue. Curabitur congue adipiscing gravida. Vestibulum aliquam massa neque, a egestas nisi blandit sit amet. Nunc vestibulum dui felis, placerat porta enim aliquet nec. Cras euismod tellus quis eros eleifend vehicula. Fusce congue sodales est at ultrices. Aliquam dignissim blandit lectus, eu iaculis orci faucibus eget. Nunc sit amet lacus metus. Integer bibendum libero id elit sagittis, eu malesuada quam vestibulum.");
CALL inserisciCommento ('teciocross',3,"Ut non enim at augue hendrerit venenatis. Praesent id varius erat, nec venenatis est. Nulla facilisi. Vestibulum faucibus ipsum et iaculis imperdiet. Nam sodales feugiat lorem in rhoncus. Donec elit dui, egestas a enim id, rutrum tristique eros. Suspendisse sem neque, euismod non orci a, suscipit placerat eros. Fusce ullamcorper vulputate lectus, quis aliquet nisi pellentesque varius. Quisque quis libero id diam lacinia auctor in in nisl. Donec ultricies porttitor sapien, eget suscipit eros malesuada iaculis. Donec at gravida nibh. Aenean accumsan urna quis nisl mollis, convallis vulputate dui consectetur. Nullam sed diam viverra, sollicitudin justo a, tincidunt ipsum. Phasellus tempus ante sit amet est pulvinar condimentum. Aliquam id pulvinar dolor.");
CALL inserisciCommento ('cat_king',4,"In mollis blandit orci id scelerisque. Praesent vitae ligula nulla. Nam ipsum lacus, vestibulum et felis quis, gravida volutpat libero. Donec aliquet posuere arcu quis rutrum. Suspendisse varius enim id hendrerit dictum. Aliquam erat volutpat. Suspendisse sapien nisi, pharetra et convallis eu, accumsan eget diam. Praesent at nisi mollis, congue enim elementum, tempus diam. Aenean diam leo, mollis nec mauris ut, dictum tincidunt odio. Etiam in leo ultricies, pellentesque metus eget, imperdiet dui. Sed imperdiet ligula magna, in tincidunt libero consectetur in. Curabitur sed viverra elit. In mattis ligula urna, et scelerisque tellus euismod quis. In dapibus, libero ac iaculis pellentesque, tellus diam fermentum magna, quis mattis enim libero a mi. Mauris vel varius enim.");
CALL inserisciCommento ('gazz90',4," Praesent eget condimentum metus. Fusce aliquam, turpis in hendrerit pulvinar, augue tortor scelerisque metus, in iaculis leo lectus quis mi. Maecenas a diam diam. Integer feugiat congue sem vel elementum. Sed et interdum magna. Nullam sed sodales ipsum. Sed fermentum, enim eget vehicula elementum, lorem ligula dictum ipsum, et feugiat diam leo ut nulla.");
CALL inserisciCommento ('andeliero92',4," Praesent eget condimentum metus. Fusce aliquam, turpis in hendrerit pulvinar, augue tortor scelerisque metus, in iaculis leo lectus quis mi. Maecenas a diam diam. Integer feugiat congue sem vel elementum. Sed et interdum magna. Nullam sed sodales ipsum. Sed fermentum, enim eget vehicula elementum, lorem ligula dictum ipsum, et feugiat diam leo ut nulla. ");
CALL inserisciCommento ('frigo.mat',5,"Vestibulum scelerisque id nisi ut tincidunt. Sed ultricies semper massa. Duis enim mauris, mattis id mattis id, mollis at elit. Aliquam elementum nunc quis nulla lobortis lacinia. Curabitur id aliquam diam, eu dapibus metus. Cras laoreet erat vel sem facilisis, at elementum nibh vehicula. Cras sed odio imperdiet urna euismod euismod in ac nulla. ");
CALL inserisciCommento ('teciocross',5,"Ut lorem eros, placerat et varius nec, interdum vitae purus. Sed nec est malesuada, facilisis diam quis, fringilla risus. Morbi bibendum pellentesque ligula, eget tincidunt purus rhoncus ut. Etiam tortor magna, porta tempor suscipit sit amet, venenatis id elit. Cras tristique sollicitudin risus, vel mollis neque feugiat eget. Cras at posuere augue, ac interdum leo. In hac habitasse platea dictumst. Donec quis ultricies erat, vel gravida lectus. ");


/*Per le valutazione non sono necessarie procedure*/
INSERT INTO Valutazioni VALUES
('teciocross',1,7),
('cat_king',1,9),
('gazz90',1,6),
('teciocross',2,7),
('cat_king',2,7),
('gazz90',2,9),
('teciocross',3,7),
('cat_king',3,6),
('gazz90',3,7),
('teciocross',4,8),
('cat_king',4,5),
('gazz90',4,5),
('teciocross',5,4),
('cat_king',5,5),
('gazz90',5,3);