CREATE TABLE Tapahtuma
(
id SERIAL PRIMARY KEY,
nimi varchar(255),
kuvaus varchar(255),
paikka varchar(255),
pvm date,
aika time,
pisteet integer
);

CREATE TABLE Fuksiryhma
(
id SERIAL PRIMARY KEY,
nimi varchar(255)
);

CREATE TABLE Kayttaja
(
id SERIAL PRIMARY KEY,
nimimerkki varchar(255),
etunimi varchar(255),
sukunimi varchar(255),
salasana varchar(255),
tuutori boolean,
admin boolean,
ryhmaID integer references Fuksiryhma(id) ON DELETE CASCADE
);

CREATE TABLE Osallistuminen
(
id SERIAL PRIMARY KEY,
hyvaksytty boolean,
tapahtumaID integer references Tapahtuma(id) ON DELETE CASCADE,
kayttajaID integer references Kayttaja(id) ON DELETE CASCADE
);

CREATE TABLE Extrapisteet
(
id SERIAL PRIMARY KEY,
kuvaus varchar(255),
pisteet integer,
fuksiID integer references Kayttaja(id) ON DELETE CASCADE,
tuutoriID integer references Kayttaja(id) ON DELETE CASCADE
);
