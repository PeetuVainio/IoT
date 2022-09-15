# IoT
## 12.9.2022
### Projektisuunnitelma
#### Peetu Vainio, Joel Utriainen Ja Luca Lappalainen
Asennettu raspberry pi
-ohjeet
1.yhdistä tarvittavat johdot raspberry pi tietokoneeseen (tarvitset näytön)
2.ota raspberrystä sd kortti pois ja lataa siihen raspbian käyttöjärjestelmä (tarvitset sd kortin lukijan, jonka liität tietokoneeseesi)
3.odota kun käyttöjärjestelmä lataa
4.Kun käyttöjärjestelmä on ladannut, siirrä SD kortti raspberry pi tietokoneeseen ja odota kun se lataa.
5.tee käyttäjänimi ja salasana ja paina next
6.kun olet työpöydällä seuraa seuraavia ohjeita: linkki- https://www.tomshardware.com/news/raspberry-pi-web-server,40174.html
## 13.9.2022
Tehty testejä Arduino UNO laitteella.
-Blinkin Test
-Temperature Sensor testi (DHT11)
Tutustuttu Ardunon Käyttöön
## 14.9.2022
Testailtu Arduino UNOlla erilaisia asioita
-Temperature sensor
-4 digit 7 segment LED display
-Matrix 8x8 LED
-Yritetty tehdä 4 digit 7 display lämpösensorin kanssa. (ei onnistunut)
-Mikrofooni
-distance sensor (ei toiminut)
## 15.9.2022
Vaihettu Hostname raspberry pi käyttöjärjestelmään
-Ohjeet: https://www.tomshardware.com/news/raspberry-pi-web-server,40174.html
Tietokannan tekeminen:

sudo mariadb
CREATE DATABASE SRYHMA;
USE SRYHMA
CREATE TABLE Liike (id int AUTO_INCREMENT NOT NULL PRIMARY KEY, arvo boolean, aika datetime);
SELECT * FROM Liike;
INSERT INTO Liike (arvo, aika) VALUES (true,now());
SELECT * FROM Liike;
INSERT INTO Liike (arvo, aika) VALUES (false,now());
SELECT * FROM Liike;
ctrl c

sudo mariadb
CREATE DATABASE SRYHMA_Peetu;
USE SRYHMA_Peetu
CREATE TABLE Liike_Peetu (id int AUTO_INCREMENT NOT NULL PRIMARY KEY, arvo boolean, aika datetime);
SELECT * FROM Liike_Peetu;
INSERT INTO Liike_Peetu (arvo, aika) VALUES (true,now());
SELECT * FROM Liike_Peetu;
INSERT INTO Liike_Peetu (arvo, aika) VALUES (false,now());
SELECT * FROM Liike_Peetu;
