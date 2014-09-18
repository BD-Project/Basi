CREATE TABLE Account(
		User		VARCHAR(32),
		Password	CHAR(32),/*utilizzo 32 caratteri perchè utilizzo MD5*/
		Nome		VARCHAR(32),
		Cognome 	VARCHAR(32),
		Iscrizione	DATE,
	PRIMARY KEY(User)
) ENGINE=InnoDB;


CREATE TABLE Editori(
		Editore		VARCHAR(32),
	PRIMARY KEY(Editore),
	FOREIGN KEY(Editore) REFERENCES Account(User) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE Utenti(
		Utente		VARCHAR(32),
	PRIMARY KEY(Utente),
	FOREIGN KEY(Utente) REFERENCES Account(User) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE Posts(
		Id 		INT,
		Titolo		TEXT,
		FPath		VARCHAR(255) NOT NULL,
		FAlt		VARCHAR(125),/*lunghezza consigliata per l'attributo alt di una foto*/
		Descrizione	TEXT,
		Testo		TEXT,
		Autore		VARCHAR(32) NOT NULL,
		Data		DATETIME,
	PRIMARY KEY(Id),
	UNIQUE(FPath),
	FOREIGN KEY(Autore) REFERENCES Editori(Editore) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE Articoli(
		IdArticolo	INT,
	PRIMARY KEY(IdArticolo),
	FOREIGN KEY(IdArticolo) REFERENCES Posts(Id) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;


CREATE TABLE Recensioni(
		IdRecensione	INT,	
	PRIMARY KEY(IdRecensione),	
	FOREIGN KEY(IdRecensione) REFERENCES Posts(Id) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;


CREATE TABLE Eventi(
		IdEvento	INT,
		DataEvento	DATE,
		Locazione	TEXT,
		OraInizio	TIME,
		OraFine		TIME,
		Prezzo		FLOAT(24),
		Email		VARCHAR(50),
	PRIMARY KEY(IdEvento),
	FOREIGN KEY(IdEvento) REFERENCES Posts(Id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE Tag(
		Label		VARCHAR(32),
	PRIMARY KEY(Label)
) ENGINE=InnoDB;


CREATE TABLE Tags(
		IdTag		VARCHAR(32),
		IdPost		INT,
	PRIMARY KEY(IdTag,IdPost),
	FOREIGN KEY(IdTag) REFERENCES Tag(Label) ON UPDATE CASCADE,
	FOREIGN KEY(IdPost) REFERENCES Posts(Id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE Gallerie(
		IdPost		INT,
		FPath		VARCHAR(255),
		FAlt		VARCHAR(125),/*lunghezza consigliata per l'attributo alt di una foto*/ 
	PRIMARY KEY(IdPost,FPath),
	FOREIGN KEY(IdPost) REFERENCES Recensioni(IdRecensione) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE Audio(
		Traccia		VARCHAR(255),
		Descrizione	TEXT,
		IdArticolo	INT,
    PRIMARY KEY(Traccia, IdArticolo),
    FOREIGN KEY(IdArticolo) REFERENCES Articoli(IdArticolo) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE Commenti(
		Utente		VARCHAR(32),
		IdPost		INT,
		Tempo		DATETIME,
		Commento	TEXT,
	PRIMARY KEY(Utente,IdPost,Tempo),
	FOREIGN KEY(Utente) REFERENCES Account(User) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(IdPost) REFERENCES Posts(Id) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;


CREATE TABLE Valutazioni(
		Utente		VARCHAR(32),
		IdPost		INT,
		Voto		INT(10) UNSIGNED NOT NULL,
	PRIMARY KEY(Utente,IdPost),
	FOREIGN KEY(Utente) REFERENCES Utenti(Utente) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(IdPost) REFERENCES Posts(Id) ON UPDATE CASCADE  ON DELETE CASCADE
) ENGINE=InnoDB;


DROP TABLE IF EXISTS Error;
CREATE TABLE Error(
		Cod    INT,
		Info   TEXT, 
	PRIMARY KEY(Cod)
) ENGINE = InnoDB;
INSERT INTO Error VALUES(1, "Errore generico"),(2,"Valutazione fuori range");