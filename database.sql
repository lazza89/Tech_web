aggiungere stelle per le recensioni

CREATE TABLE userInfo(
    email               VARCHAR(50)     NOT NULL        CHECK (Email LIKE '%_@__%.__%'),
    nome                VARCHAR(30)     NOT NULL        
    cognome             VARCHAR(30)     NOT NULL
    paese               VARCHAR(30)     DEFAULT NULL,
    CAP                 VARCHAR(10)     DEFAULT NULL,
      
    PRIMARY KEY(Email)
);   

CREATE TABLE user(
    username            VARCHAR(30),
    email               VARCHAR(50)     UNIQUE          NOT NULL    CHECK (Email LIKE '%_@__%.__%'),
    _password            VARCHAR(30)     NOT NULL,                   

    PRIMARY KEY (Username),
    FOREIGN KEY (Email) REFERENCES userInfo(Email) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE `admin`(
    username            VARCHAR(30),
    numTelefono         VARCHAR(15)     DEFAULT NULL,
    email               VARCHAR(50)     UNIQUE          NOT NULL    CHECK (Email LIKE '%_@__%.__%'),
    `password`            VARCHAR(30)     NOT NULL,

    PRIMARY KEY (username)
);  

CREATE TABLE commento(
    idCommento          AUTO_INCREMENT,
    membro              VARCHAR(30)		 NOT NULL,
    nStelle             TINYINT          NOT NULL,
    commento            VARCHAR(2048)    NOT NULL,
    dataC               DATE             DEFAULT current_date,
    `admin`              VARCHAR(30)      DEFAULT NULL,
 
    PRIMARY KEY (idCommento),
    FOREIGN KEY (`admin`) REFERENCES _admin(Username) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (user) REFERENCES user(Username) ON UPDATE CASCADE ON DELETE CASCADE,
); 