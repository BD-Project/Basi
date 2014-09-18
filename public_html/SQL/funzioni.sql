DELIMITER $

CREATE FUNCTION univoqueIdPost() RETURNS INT
BEGIN
    DECLARE Idpost INT;
    IF (SELECT count(*) FROM Posts)=0 THEN 
	SET Idpost := 1;
    ELSE
	SELECT max(Id)+1 INTO Idpost FROM Posts;
    END IF;
    RETURN Idpost;
END $

CREATE FUNCTION mediaValPost(id INT) RETURNS FLOAT
BEGIN
    DECLARE media FLOAT;
    SELECT sum(Voto)/count(*) INTO media
    FROM Posts p JOIN Valutazioni v ON p.Id=v.IdPost
    WHERE p.Id=id;
    RETURN media;
END $

DELIMITER ;