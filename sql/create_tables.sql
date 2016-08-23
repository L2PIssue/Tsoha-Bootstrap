CREATE TABLE Kayttaja
(
userID SERIAL PRIMARY KEY,
nimimerkki varchar(255),
etunimi varchar(255),
sukunimi varchar(255),
salasana varchar(255),
tuutori boolean,
admin boolean,
ryhmaID integer references Fuksiryhma(ryhmaID)
);

CREATE TABLE Tapahtuma
(
tapahtumaID SERIAL PRIMARY KEY,
nimi varchar(255),
kuvaus varchar(255),
paikka varchar(255),
aika timestamp,
pisteet integer
);

CREATE TABLE Osallistuminen
(
osallistumisID SERIAL PRIMARY KEY,
hyvaksytty boolean,
tapahtumaID integer references Tapahtuma(tapahtumaID),
kayttajaID integer references Kayttaja(kayttajaID)
);

CREATE TABLE Extrapisteet
(
pisteID SERIAL PRIMARY KEY,
kuvaus varchar(255),
pisteet integer,
kayttajaID integer references Kayttaja(kayttajaID)
);

CREATE TABLE Fuksiryhma
(
ryhmaID SERIAL PRIMARY KEY,
nimi varchar(255)
);