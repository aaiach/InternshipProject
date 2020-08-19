CREATE TABLE Membre(
	ID SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(255) NOT NULL UNIQUE,
	name VARCHAR(40) NOT NULL,
	password TEXT NOT NULL
);


CREATE TABLE Professions(
	ID SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(40) NOT NULL,
	definition TEXT NOT NULL

);

INSERT INTO Professions (name, definition) VALUES ("Coach", "a coach");
INSERT INTO Professions (name, definition) VALUES ("Yoga", "a yoga coach");
INSERT INTO Professions (name, definition) VALUES ("Kiné", "a kiné");


CREATE TABLE Professional(
	ID SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(255) NOT NULL UNIQUE,
	name VARCHAR(40) NOT NULL,
	password TEXT NOT NULL,
	profilePicture VARCHAR(255) DEFAULT "https://i.ibb.co/GncjmpR/profilepic.png",
	proffesionID_ref SMALLINT UNSIGNED,
	FOREIGN KEY(proffesionID_ref) REFERENCES Professions(ID)
);

CREATE TABLE Product(
	ID SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(40) NOT NULL,
	price INT NOT NULL,
	description VARCHAR(100) NOT NULL,
	proffesionalID_ref SMALLINT UNSIGNED,
	FOREIGN KEY(proffesionalID_ref) REFERENCES Professional(ID)
);