
DELIMITER $

DROP TRIGGER IF EXISTS UpdVal $
CREATE TRIGGER UpdVal AFTER INSERT ON Valutazioni FOR EACH ROW
BEGIN
    
    DROP VIEW IF EXISTS MediaVoti;
    CREATE VIEW MediaVoti AS 
	SELECT p.Id, sum(Voto)/count(*)
	FROM Posts p JOIN Valutazioni v ON p.Id=v.IdPost 
	GROUP BY p.Id;
    
END $

DELIMITER ;


