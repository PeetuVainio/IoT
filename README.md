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
Tietokannan ja taulukon tekeminen:  

sudo mariadb =avaa tietokanta palvelun  
CREATE DATABASE SRYHMA; =Luo tietokannan  
USE SRYHMA =Avaa tietokannan  
CREATE TABLE Liike (id int AUTO_INCREMENT NOT NULL PRIMARY KEY, arvo boolean, aika datetime); =luo taulukon  
SELECT * FROM Liike; =Näyttää taulukon sisällön  
INSERT INTO Liike (arvo, aika) VALUES (true,now()); =Lisää annetut arvot taulukkoon  
SELECT * FROM Liike; =Näyttää taulukon sisällön  
INSERT INTO Liike (arvo, aika) VALUES (false,now()); =Lisää annetut arvot taulukkoon  
SELECT * FROM Liike; =Näyttää taulukon sisällön  
ctrl c =poistuu tietokanta palvelusta  

sudo mariadb  
CREATE DATABASE SRYHMA_Peetu;  
USE SRYHMA_Peetu  
CREATE TABLE Liike_Peetu (id int AUTO_INCREMENT NOT NULL PRIMARY KEY, arvo boolean, aika datetime);  
SELECT * FROM Liike_Peetu;  
INSERT INTO Liike_Peetu (arvo, aika) VALUES (true,now());  
SELECT * FROM Liike_Peetu;  
INSERT INTO Liike_Peetu (arvo, aika) VALUES (false,now());  
SELECT * FROM Liike_Peetu;  
## 16.9.2022
Testailtu Ardunoa raspberryn kanssa  

lataa arduino IDE Raspiin  
Terminal:  
-Sudo apt install arduino =Lataa arduinon  
-Sudo adduser käyttäjänimi dialout  
pyserial_kirjasto  
-pip install pyserial / sudo pip3 install pyserial  
apt list --installed -> python3-serial   

Testataan toimiiko Arduino IDE oikein:  
-Simppeli koodi (Serial)  
-Arduino UNO  
-Com-port  
^
/dev/ttyACM0  
/dev/ttyUSB0  

Laitettu Arduino ja Python koodit raspiin  
Arduino:  

void setup() {  
  // put your setup code here, to run once:  
Serial.begin(9600);  
}  

void loop() {  
  // put your main code here, to run repeatedly:  
Serial.println("Heippa");  
delay(100);  
}  

Python:  

#!/usr/bin/env python3  
#kirjasto  
import serial  

if __name__ == '__main__':  
    #serialin kommunikaatioon alustamisseen kutsutaan muutamilla parametreillä  
    ser = serial.Serial('/dev/ttyACM0', 9600, timeout=1)  
    ser.reset_input_buffer()  

    while True:  
        if ser.in_waiting > 0:  
            line = ser.readline().decode('utf-8').rstrip()  
            print(line)  

Välkkyvä LED valo, joka on yhdistetty ardunosta serialiin  
-Ohjeet: https://forum.arduino.cc/t/blinking-an-led-from-a-raspberry-pi-gpio-signal/695120  

Testattiin Servo moottoria (ei saatu toimimaan)  
## 26.9.2022
### Täydennetty viimeviikon asioita
#### 19.9.2022
import time = nykyisen ajan saaminen, ohjelman suorittamisen keskeyttäminen import Pri.GPIO as GPIO = viittaa kaikkiin moduulin toimintoihin lyhyemmällä nimellä GPIO impport mariadb = vaikuttaa mariadb:n mukaan tähän koodiin  

GPIO.setmode(GPIO.BCM) =
GPIO.setup(23, GPIO.IN) =
conn = mariadb.connect(user="root", password="Jopee31v", host="localhost", database="SRYHMA") = kirjautuu valitsemaan tietokantaan cur = conn.cursor() =

try: = yrittää ensimmäiseksi tehdä tämän  
while True: = kun on päällä  
if GPIO.input(23): = jos 23 portissa on anturi  
cur.execute("INSERT INTO Liike(arvo,aika) VALUES (true,now())") = siirtää ja luo tiedot mariedb taulukkoon  
conn.commit() = lähettää COMMIT käskyn Mariadblle nykyisen tapahtuman. print("koodi toimii") = tulostaa sanan sulkeiden sisällä  
time.sleep(5) = pitää niin pitkän tauon kuin numeroita löytyy suluista  

     else:  = jos ei pysty suorittamaan  
        print("ei toimi")  
        time.sleep(5)  
except: = yrittää ensimmäisen jälkeen tehdä tämän  
conn.close() = sulkee kaikki odottavat tai lukemattomat tulokset  
GPIO.cleanup() = puhdista kaikki käyttämäsi portit  

komennot, jolla saadaan salasana omaan tietokantaan  
   SET PASSWORD FOR 'root'@localhost=PASSWORD("Jopee31v);  = laittaa salasanan tietokannalle
   flush privileges; = tyhjentää tai lataa uudelleen erilaisia MariaDB:n käyttämiä sisäisiä välimuistia
#### 20.9.2022
apt-get-update, päivittää kaiken ajantasalle  
clear,tyhjentää taulukon  
date, kertoo päivämäärän ja ajan  
find/-name esimerkki.txt, etsii nimetyn tiedoston  
nano example.txt, pystyy muokata jotakin tiedostoa terminaalista  
poweroff, sammuttaa järjestelmän  
raspi-config,pääset muokkaamaan asetuksia  
reboot, käynnistää järjestelmän uudelleen  
shutdowm-h-now,sammuttaa järjestelmän nyt  
shutdown-h-01:22:, sammuttaa järjestelmän tiettyyn kellonaikaan  
startx, komento, jolla voidaan käynnistää x palvelin  
cat esimerkki.txt,yhdistää tiedostoja  
cd/abc/xyz,kopioi tiedoston tai hakemiston ja liittää sen määritettyyn paikkaan  
is-| ei löydy  
mkdir esimerkki_polku,luo hakemiston  
my XXX, ei löydy  
rm esimerkki,poistaa tiedoston  
scp user@10.0.0.32:/some/path/tiedosto.txt, lataa koneelta tietyn tiedoston raspberryyn  
touch example.txt,luo tiedoston tai muokkaa sitä  
ifconfig, verkkoliitännän tarkastelu komento  
iwconfig,langaton ifconfig komento  
iwlist wlan0 scan, skannaa langattoman tukiaseman  
iwlist wlan0I grep ESSID,ei löydy  
nmap,työkalu, jolla tutkia ja turvata nettiä  
ping,kertoo netin nopeuden  
wget :http://www.website.com/example.txt,vie tietylle nettisivulle  
cat/proc/meminfo,määrittää kuinka paljon muista löytyy  
cat/proc/partitions,näyttää dataa osoitteista  
cat/proc/verion,näyttää version  
df-h, näyttää tiedostojärjestelmän levytilastot  
df/,näyttää toedostojärjestelmän tietoja ja käytettävissä olevan tilan  
dpkg--get selections I grep XXX, ei löytynyt  
dpkg--get-selections,antaa luettelon kaikista pakettien nimisistä ja tilasta  
free, hostname-|, näyttää mem:it  
Isusb, näyttää USB- väylistä tietoja  
UP key,pääsee takasinpäin koodeissa, eli voi käyttää jo käytettyjä koodeja uudelleen  
vcgencmd measure_temp, kertoo järjestelmän lämpötilan vcgencmd get_mem arm&& vcgencmd get_mem gpu, kertoo gpu:n ja arm:in tilavuuden.  
#### 21.9.2022
