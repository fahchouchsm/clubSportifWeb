USE clubsportif;

CREATE TABLE Admin (
    adminId INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100) UNIQUE not null,
    password VARCHAR(255) not null,
    tel VARCHAR(20)
);

CREATE TABLE Client (
    clientId INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
	dateNais DATE NOT NULL ,
    email VARCHAR(100) UNIQUE not null,
    password VARCHAR(255)not null,
    tel VARCHAR(20)
);

CREATE TABLE Coach (
    coachId INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    tel VARCHAR(20)
);

CREATE TABLE Abonnement (
    abonnementId INT PRIMARY KEY AUTO_INCREMENT,
    clientId INT,
    dateAbo DATE,
    dateExpiration DATE,
    FOREIGN KEY (clientId) REFERENCES Client(clientId) ON DELETE CASCADE
);

CREATE TABLE Paiment (
    paimentId INT PRIMARY KEY AUTO_INCREMENT,
    clientId INT,
    abonnementId INT,
    date DATE,
    montantPaiement DECIMAL(10,2),
    FOREIGN KEY (clientId) REFERENCES Client(clientId) ON DELETE CASCADE,
    FOREIGN KEY (abonnementId) REFERENCES Abonnement(abonnementId) ON DELETE CASCADE
);

ALTER TABLE Abonnement
ADD COLUMN paimentId INT,
ADD FOREIGN KEY (paimentId) REFERENCES Paiment(paimentId) ON DELETE SET NULL;

CREATE TABLE Feedback (
    feedbackId INT PRIMARY KEY AUTO_INCREMENT,
    clientId INT,
    competence TEXT,
    evaluation TEXT,
    dateFeedback DATE,
    FOREIGN KEY (clientId) REFERENCES Client(clientId) ON DELETE CASCADE
);

CREATE TABLE Seance (
    seanceId INT PRIMARY KEY AUTO_INCREMENT,
    dateSeance DATE,
    description TEXT,
    coachId INT,
    FOREIGN KEY (coachId) REFERENCES Coach(coachId) ON DELETE SET NULL
);

CREATE TABLE ClientSeance (
    clientId INT,
    seanceId INT,
    PRIMARY KEY (clientId, seanceId),
    FOREIGN KEY (clientId) REFERENCES Client(clientId) ON DELETE CASCADE,
    FOREIGN KEY (seanceId) REFERENCES Seance(seanceId) ON DELETE CASCADE
);