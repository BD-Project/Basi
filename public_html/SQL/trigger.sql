DELIMITER $

DROP TRIGGER IF EXISTS checkTags $
CREATE TRIGGER checkTags 
AFTER DELETE ON Posts
FOR EACH ROW
BEGIN 
    DECLARE utag VARCHAR(32);
    SELECT t.Label INTO utag
    FROM Tag t 
    WHERE t.Label NOT IN (SELECT ts.IdTag 
			    FROM Tags ts 
			    GROUP BY ts.IdTag); 
    DELETE FROM Tag
    WHERE Label=utag;
END $

DROP TRIGGER IF EXISTS checkVal $
CREATE TRIGGER checkVal
BEFORE INSERT ON Valutazioni
FOR EACH ROW
BEGIN
    IF (NEW.Voto < 0) OR (NEW.Voto > 10) THEN
	INSERT INTO Error VALUES (2,"Valutazione fuori range");
    END IF;
END $

DELIMITER ;