INSERT INTO Kayttaja
        (nimimerkki, etunimi, sukunimi, salasana, tuutori, admin)
VALUES ('Fuksi', 'Essi', 'Esimerkki', 'fuksi', false, false);

INSERT INTO Kayttaja
        (nimimerkki, etunimi, sukunimi, salasana, tuutori, admin)
VALUES ('Tuutori', 'Matti', 'Malli', 'tuutori', true, false);

INSERT INTO Kayttaja
        (nimimerkki, etunimi, sukunimi, salasana, tuutori, admin)
VALUES ('Paloma', 'Paloma', 'Ruiz', 'fuksi', true, true);

INSERT INTO Tapahtuma
        (nimi, kuvaus, paikka, aika, pisteet)
VALUES ('Fuksiaiset', 'Hauska tapahtuma', 'Helsinki', '2016-09-20', 5);

INSERT INTO Fuksiryhma
        (nimi)
VALUES ('YoloFuksit');
