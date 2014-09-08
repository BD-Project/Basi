
DELIMITER $

/*procedure per la creazione delle due tipologie di utenze*/
DROP PROCEDURE IF EXISTS creaEditore $
CREATE PROCEDURE creaEditore(IN username VARCHAR(32), pass VARCHAR(32), name VARCHAR(32), surname VARCHAR(32))
BEGIN
    START TRANSACTION;
	INSERT INTO Account VALUES(username,md5(pass),name,surname,now());
	INSERT INTO Editori VALUES(username);
    COMMIT;
END $
DROP PROCEDURE IF EXISTS creaUtente $
CREATE PROCEDURE creaUtente(IN username VARCHAR(32), pass VARCHAR(32), name VARCHAR(32), surname VARCHAR(32))
BEGIN
    START TRANSACTION;
	INSERT INTO Account VALUES(username,md5(pass),name,surname,now());
	INSERT INTO Utenti VALUES(username);
    COMMIT;
END $



/*procedure per la creazione di articoli,recensioni ed eventi*/
DROP PROCEDURE IF EXISTS inserisciArticolo $
CREATE PROCEDURE inserisciArticolo(IN ttl TEXT, fph VARCHAR(32), alt VARCHAR(125), dscr TEXT, tst TEXT, auth VARCHAR(32))
BEGIN
    DECLARE Idpost INT;
    IF (SELECT count(*) FROM Posts)=0 THEN 
	SET Idpost := 1;
    ELSE
	SELECT max(Id)+1 INTO Idpost FROM Posts;
    END IF;
    START TRANSACTION;
	INSERT INTO Posts VALUES(Idpost,ttl,fph,alt,dscr,tst,auth,now());
	INSERT INTO Articoli VALUES (Idpost);
	INSERT INTO Tag
	    SELECT lbl FROM tmp_tags WHERE lbl NOT IN (SELECT Label FROM Tag);
	INSERT INTO Tags
	    SELECT lbl,Idpost FROM tmp_tags;
	INSERT INTO Audio SELECT pth, alt, Idpost FROM tmp_tracks;
    COMMIT;
    DELETE FROM tmp_tags;
    DELETE FROM tmp_tracks;
END $


DROP PROCEDURE IF EXISTS inserisciEvento $
CREATE PROCEDURE inserisciEvento(IN ttl TEXT, pth VARCHAR(32), alt VARCHAR(125), dscr TEXT, tst TEXT, auth VARCHAR(32), dtev DATE, loc TEXT, oin TIME, ofn TIME, price FLOAT, eml VARCHAR(50))
BEGIN
    DECLARE Idpost INT;
    IF (SELECT count(*) FROM Posts)=0 THEN 
	SET Idpost := 1;
    ELSE
	SELECT max(Id)+1 INTO Idpost FROM Posts;
    END IF;
    START TRANSACTION;
	INSERT INTO Posts VALUES (Idpost,ttl,pth,alt,dscr,tst,auth,now());
	INSERT INTO Eventi VALUES (Idpost,dtev,loc,oin,ofn,price,eml);
	INSERT INTO Tag
	    SELECT lbl FROM tmp_tags WHERE lbl NOT IN (SELECT Label FROM Tag);
	INSERT INTO Tags
	    SELECT lbl,Idpost FROM tmp_tags;
    COMMIT;
    DELETE FROM tmp_tags;
END $


DROP PROCEDURE IF EXISTS inserisciRecensione $
CREATE PROCEDURE inserisciRecensione(IN ttl TEXT, pth VARCHAR(32), alt VARCHAR(125), dscr TEXT, tst TEXT, auth VARCHAR(32))
BEGIN
    DECLARE Idpost INT;
    IF (SELECT count(*) FROM Posts)=0 THEN 
	SET Idpost := 1;
    ELSE
	SELECT max(Id)+1 INTO Idpost FROM Posts;
    END IF;
    START TRANSACTION;
	INSERT INTO Posts VALUES (Idpost,ttl,pth,alt,dscr,tst,auth,now());
	INSERT INTO Recensioni VALUES (Idpost);
	IF(SELECT count(*) FROM tmp_gallery)!=0 THEN
	    INSERT INTO Gallerie
		SELECT Idpost,fp,fa FROM tmp_gallery;
	ELSE
	    ROLLBACK;
	END IF;
    COMMIT;
    DELETE FROM tmp_tags;
    DELETE FROM tmp_gallery;
END $

/*system rm ../img/photopost8.jpg          per rimuovere file*/
DROP PROCEDURE IF EXISTS inserisciCommento $
CREATE PROCEDURE inserisciCommento(IN usr VARCHAR(32), pst INT, cmt TEXT)
BEGIN
    START TRANSACTION;
	INSERT INTO Commenti 
	    VALUES (usr,pst,now(),cmt);
    COMMIT;
END $
DELIMITER ;