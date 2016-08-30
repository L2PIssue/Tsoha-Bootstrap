INSERT INTO Kayttaja
        (nimimerkki, etunimi, sukunimi, salasana, tuutori, admin)
VALUES ('Fuksi', 'Essi', 'Esimerkki', 'fuksi', false, false);

INSERT INTO Kayttaja
        (nimimerkki, etunimi, sukunimi, salasana, tuutori, admin)
VALUES ('Tuutori', 'Matti', 'Malli', 'tuutori', true, false);

INSERT INTO Kayttaja
        (nimimerkki, etunimi, sukunimi, salasana, tuutori, admin)
VALUES ('Admin', 'Apua', 'Ähinää', 'admin', true, true);

INSERT INTO Tapahtuma
        (nimi, kuvaus, paikka, pvm, aika, pisteet)
VALUES ('Fuksiaiset', 'Hauska tapahtuma', 'Helsinki', '2016-09-20', '16:00', 5);

INSERT INTO Extrapisteet
        (kuvaus, pisteet, fuksiid, tuutoriid)
VALUES ('Kannoit kaljaa vau', 10, 1, 2);

