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

#### Täydennetty viimeviikon asioita
### 19.9.2022
#### koodi, jolla liikeanturi toimii ja vie tiedot taulukkoon
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

#### komennot, jolla saadaan salasana omaan tietokantaan  
   SET PASSWORD FOR 'root'@localhost=PASSWORD("Jopee31v);  = laittaa salasanan tietokannalle
   flush privileges; = tyhjentää tai lataa uudelleen erilaisia MariaDB:n käyttämiä sisäisiä välimuistia
### 20.9.2022
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
### 21.9.2022
Tutustuttiin eri KTinker komentoihin pythonilla ja aloitettiin suomenlipun koodin tekemistä  
#### Esimerkkikoodi
import tkinter as tk = tunnistaa- tkinterin tk:na ja sitä rataa loputkin = koodit window = tk. Tk() lb=tk.Label(text="real python")= Tekstiksi tulee se, mitä suluissa lukee entry = tk.Entry()  
name=entry.get() = nimeksi tulee se, minkä kirjoitat = name lb.pack() = mahdollistaa lb:n käytön entry.pack()= mahdollistaa entryn käytön  
window.mainloop()  
### 22.9.2022
#### Tehtävä 1
A)Miten tietokantapalvelimella?  
SHOW DATABASES;  
B)Miten tietokantataulukko on muodostettu?  
DESCRIBE tbl_name  
#### Tehtävä 2
Loopissa ei kovakoodattua sisältöä, 3kpl esimerkkejä sql stringin muokkaamisesta %, format() ja f-string  
 import time  
 import datetime  
 import mariadb  
 import PRi.GPIO as GPIO  
 
 InputPin = 23  
 
 GPIO.setmode(GPIO.SCM)  
 GPIO.setup(InputPin, GPIO.IN  
 
 conn = mariadb.connect(user="root", password="Jopee31v", host="localhost", database="SRYHMA")  
 cur = conn.cursor()  
 waitloop = 5  
 print(datetime. datetime. now(1)  
 
 try:  
  while True:  
    sql5tr = "INSERT INTO Liike (arvo, aika) VALUES (5, now())"  
    sql5trPercentage = "INSERT INTO Liike (arvo, aika) VALUES (%s, %s)" %(GPIO.input(InputPin), datetime.datetime.now())   
    sql5trFormat = "INSERT INTO Liike (arvo, aika) VALUES ({},{})" .format(GPIO.input(InputPin),datetime.datetime.now())  
    sql5trF = f"INSERT INTO Liike (arvo, aika) VALUES ({GPIO.input(InputPin)}, now())  
   
    print("A: ", sql5tr)  
    print("B: ", sql5trPercentage)  
    print("C: ", sql5trFormat)  
    print("D: ", sql5trF)  
   
    time.sleep(waitloop)  
    cur.execute(sqlStrF)  
    conn.commit()  
except:  
  print("ei toimi")  
  time.sleep(waitloop)  
  window.mainloop()  
#### Tehtävä 3
DHT11 harjoitus  
### 23.9.2022
Suunniteltiin käyttöliittymää ja tehtiin sille graafinen ohjelmisto, saatiin myös projekti valmiiksi, joka aloitettiin 21-päivä, ja missä frame koodien avulla saatiin aikaiseksi suomenlippu  
#### Koodi
import tkinter as tk  

window = tk.Tk() = luo tyhjän ruudun  

frame123 = tk.Frame(master=window, width=50, height=50, bg="blue") = tekee framen ja sen korkeuden, leveyden ja värin  
frame123.pack(side=tk.RIGHT) = mahdollistaa framen käytön ja asettelee sen ruutuunsa  
frame134 = tk.Frame(master=window, width=50, height=50, bg="blue")  
frame134.pack(side=tk.RIGHT)  
frame145 = tk.Frame(master=window, width=50, height=50, bg="blue")  
frame145.pack(side=tk.LEFT)  
frame156 = tk.Frame(master=window, width=50, height=50, bg="blue")  
frame156.pack(side=tk.RIGHT)  
frame167 = tk.Frame(master=window, width=50, height=50, bg="blue")  
frame167.pack()  
frame177 = tk.Frame(master=window, width=50, height=50, bg="blue")  
frame177.pack()  
frame1 = tk.Frame(master=window, width=50, height=50, bg="blue")  
frame1.pack()  

## 26.9.2022
Tehtiin raspin localhost sivua:  
-liitettiin kuva, tekstiä ja linkki  
-etsittiin hyvä taulukko ja muokattiin sitä  
## 27.9.2022
Käytiin html anatomiaa  
tehtiin html nettisivua  
## 28.9.2022
-jatkettiin eilistä html sivuston tekemistä/muokkaamista  
#### koodi
</DOCTYPE html>  
<html large="en-US">  
<head>  
	<meta charset="utf-8">  
	<meta name="viewport" content="width=device-width">  
    <title>Peetun sivusto</title>  

</head>  
<body style="background-color:rgb(241, 112, 159)">  
    <style>* {color: rgba(245, 245, 245, 0.769);}</style>  

	<h1>Yleistä sivustosta</h1>  
	öö joo täällä on jotain joo...  

    <h3>Asioita joista tykkään</h3>  
    <ul>  
        <li>Pelaaminen</li>  
    </ul>  

    <h3>Pelit joita pelaan(aina välillä)</h3>  
    <ol>  
        <li>Sea of Thieves</li>  
        <li>OW</li>  
        <li>Roblox</li>  
        <li>CS:GO</li>  
    </ol>  

    <script type="text/javascript">  
        var clicks = 0;  
        function onClick() {  
            clicks += 1;  
            document.getElementById("clicks").innerHTML = clicks;  
        };  
        </script>  
        <button type="button" onClick="onClick()">klikkaa mua</button>  
        <p>Clicks: <a id="clicks">0</a></p>  
    <br>  

    <img src="downloads/humuhumunukunukuapuaa.jpg"alt=humuhumunukunukuapuaa>  
    <br>  
    ^humuhumunukunukuapuaa  
    <br>  
    <br>  
    <br>  
    <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0">Ilmaisia V-Buckseja</a>  

</body>
</html>

## 29.9.2022

-käytiin läpi mitä kieliä ollaan tähän asti käytetty  
-koodattiin php:tä  
-Tehtiin PIR liikeanturi toimivaksi   
-Tehtiin index.html sivu   
-Tehtiin meille jokaiselle omat php sivut   
-Linkitettiin meidän php sivut html sivuun   
-saatiin omista tietokannoista taulukot toimimaan php sivuille  

#### omien php sivujen koodi

<!DOCTYPE html>  
<html>  
      <head>  
            <title>varashälytin</title>  
      </head>  
      <body>  
            
            <div style="border:1px solid black;text-align:center">  
                  <h1><img src="Kuvat/img.gg" width="300px">jopee Varashälytin</h1>  
                  <table width="40%" style="margin:auto;border:0px solid black;">  
                  <tr>  
                        <th>id</th>  
                        <th>arvo</th>  
                        <td>0</td>  
                        <td>Liikettä</td>  
                  </tr>  
                  <tr>  
                        <td>1</td>  
                        <td>Hiljaista</td>  
                  </tr>  
                  <tr>  
                  <div>  
<?php  
            $servername ="localhost";  
            $username ="root";  
            $password ="Jopee31v";  
            $dbname ="SRYHMA_Peetu";  
            
            $conn = new mysqli($servername, $username, $password, $dbname);  
            
            if ($conn->connect_error){  
                  die("connection failed: " . $conn->connect_error);  
            }
            $sql = "SELECT id, arvo FROM Liike_Peetu";  
            $result = $conn->query($sql);  
            
            while($row = $result->fetch_assoc()){  
                  echo $row["id"]." arvo: ".$row["arvo"]."<br>";  
            }  
            $conn->close();  
            ?>  


            </table>  
            <div>  
            Powered by Jopee<br>  
            </div>  
            </div>  
            </div>  
      </body>  
</html>  

#### html koodi

<html>  
      <head>  
            <title>MOI</title>  
      </head>  
      <body>  
      <div>  
            <a href="http://localhost/Peetu.php">Peetun tietokanta taulukko</a>  
            <a href="http://localhost/Joel.php">Joelin tietokanta taulukko</a>  
            <a href="http://localhost/Luca.php">Lucan tietokanta taulukko</a>  
            </div>  
      </body>  
</html>  

## 30.9.2022
Tehtiin html form, jossa oli täytettävänä:  
-nimi  
-ikä  
-päivämäärä  
-tekstiboksi (max 120 merkkiä)  
-formin nollaus nappi  

#### koodi
<!DOCTYPE html>  
<html>  
<head>  
    <title>Tärkeä formi</title>  

</head>  

<body style="background-color:rgb(252, 96, 169)">  
    <style>* {color: rgb(0, 255, 255);}</style>  

<h2>Todella tärkeä formi</h2>  

<form action="/action_page.php">  
    
  <label for="fname">Nimi:</label><br>  
  <input type="text" id="fname" name="fname" value=""><br>  

     Ikä:<br>  
         <input type="number" min="1" max="100"><br>  
	
     Päivämäärä:<br>  
         <input type="date"><br>  

     max 120 merkkiä:<br>  
         <input type="text" maxlength="120" required><br>  

  <input type="reset" value="nollaa">  
  <input type="Submit" value="Lähetä">  

</form>   

</body>  
</html>  

## 3.10.2022
Tein google chartsia  

#### Koodi

<html>  
  <head>  

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script type="text/javascript">  

      google.charts.load('current', {'packages':['corechart']});  

      google.charts.setOnLoadCallback(drawChart);  

      function drawChart() {  

        var data = new google.visualization.DataTable();  
        data.addColumn('string', 'Topping');  
        data.addColumn('number', 'Slices');  
        data.addRows([  
          ['Maanantai', 8],  
          ['Tiistai', 8],  
          ['Keskiviikko', 10],  
          ['Torstai', 13],  
          ['Perjantai', 14],  
          ['Lauantai', 12],  
          ['Sunnuntai', 10]  
          
        ]);  

        var options = {'title':'Lämpötilat tällä viikolla asteina',  
                       'width':400,  
                       'height':300};  

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));  
        chart.draw(data, options);  
      }  
    </script>  
  </head>  

  <body>  
    <div id="chart_div"></div>  
  </body>  
</html>  

## 4.10.2022
Tein google chartsia
#### koodi

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
<script type="text/javascript">  
  google.charts.load("current", {packages:['corechart']});  
  google.charts.setOnLoadCallback(drawChart);  
  function drawChart() {  
    var data = google.visualization.arrayToDataTable([  
      ["Element", "Density", { role: "style" } ],  
      ["Maanantai", 8, "color: #76A7FA"],  
      ["Tiistai", 8, "color: #76A7FA"],  
      ["Keskiviikko", 10, "color: #76A7FA"],  
      ["Torstai", 13, "color: #76A7FA"],  
      ["Perjantai", 14, "color: #76A7FA"],  
      ["Lauantai", 12, "color: #76A7FA"],  
      ["Sunnuntai", 10, "color: #76A7FA"]  
    ]);  

    var view = new google.visualization.DataView(data);  
    view.setColumns([0, 1,  
    { calc: "stringify",  
    sourceColumn: 1,  
    type: "string",  
    role: "annotation" },  
    2]);  

    var options = {  
   				  title: "Tämän viikon lämpötilat asteina",  
    				  width: 800,  
    				  height: 400,  
    				  bar: {groupWidth: "95%"},  
    				  legend: { position: "none" },  
    };  
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));  
    chart.draw(view, options);  
}  
</script>  
<div id="columnchart_values" style="width: 900px; height: 300px;"></div>  

## 5.10.2022
Yritin saada yhdistettyä Azuren tietokantaan (en saanut toimimaan)  

## 10.10.2022
#### Tein viimeviikon juttuja

-Asensin MySQL Workbenchin  
-loin tietokannan  

CREATE DATABASE SRYHMA; =Luo tietokannan  
USE SRYHMA =Avaa tietokannan  
CREATE TABLE Peetu (id int AUTO_INCREMENT NOT NULL PRIMARY KEY, arvo boolean, aika datetime);  
SELECT * FROM Peetu;  
INSERT INTO Peetu (arvo, aika) VALUES (true,now());  
SELECT * FROM Peetu;  
INSERT INTO Peetu (arvo, aika) VALUES (false,now());  
SELECT * FROM Peetu;  

-Tein paikallisen PHP-Palvelimen  
-Ongelmanratkaisua ja tiedonhankintaa  
-keskustelupalsta  

index2.php  
#### koodi

<?php  

$servername ="hyvis.mysql.database.azure.com";  
$username ="db_projekti";  
$password ="Sivuh2022";  
$dbname ="Peetu";  

?>  

index.php  
#### koodi

<html>  
    <body>  
        <form action="handle.php" method="post">  
            Nimimerkki: <input type="text" name="name"><br>  
            Viesti: <textarea name="viesti"></textarea><br>  
            <input type="submit">  
        </form>  
    </body>  
</html>  

handle.php  
#### koodi

<?php  
include "index2.php";  

$conn = new mysqli($servername, $username, $password, $dbname);  
if ($conn->connect_error){  
die("connection failed: " . $conn->connect_error);  
}  

$name = $_POST['name'];  
$viesti = $_POST['viesti'];  
$sql = "INSERT INTO Keskustelu (nimi, viesti) VALUES ('".$name."', '".$viesti."')";  


if ($conn->query($sql) === TRUE) {  
    echo "New record created successfully";  
} else {  
    echo "Error: " . $sql . "<br>" . $conn->error;  
    die();  
}  

$conn->close();  
header("location: index.php");  
die();  
?>  

.php  
#### koodi

<?php  
include "index2.php";  

            $conn = new mysqli($servername, $username, $password, $dbname);  
            if ($conn->connect_error){  
            die("connection failed: " . $conn->connect_error);  
            }  
            $sql = "SELECT * FROM Keskustelu";  
            $result = $conn->query($sql);  

            if ($result->num_rows > 0) {}  
            while($row = $result->fetch_assoc()){  
                echo $row["id"]." arvo: ".$row["arvo"]."<br>";  
            }  
            $conn->close();  
            ?>    
<html>  
    <body>  
        <form action="handle.php" method="post">  
            Nimimerkki: <input type="text" name="name"><br>  
            Viesti: <textarea name="viesti"></textarea><br>  
            <input type="submit">  
        </form>  
    </body>  
</html>  

## 11.10.2022
-tein html sivua jossa käytin css  
-laitettiin MySQL Workbenchiin uusi taulukko  
tee tässä järjestyksessä:  
Use peetu  
create database keskustelu  
create table keskustelu (id int primary key auto_increment. nimi varchar(255), viesti varchar(1000))  
## 12.10.2022  
sain tehtyä keskustelu lomakkeen loppuun  
#### koodit
### config.php  

<?php  

$servername ="hyvis.mysql.database.azure.com";  
$username ="db_projekti";  
$password ="Sivyh2022";  
$dbname ="Peetu";  

?>  

### database.php  

<?php  
$con=mysqli_connect("hyvis.mysql.database.azure.com","db_projekti","Sivyh2022","Peetu");  
// Check connection  
if (mysqli_connect_errno())  
{  
echo "Failed to connect to MySQL: " . mysqli_connect_error();  
}  

$result = mysqli_query($con,"SELECT * FROM keskustelu");  

echo "<table border='1'>  
<tr>  
<th>nimimerkki</th>  
<th>viesti</th>  
</tr>";  

while($row = mysqli_fetch_array($result))  
{  
echo "<tr>";  
echo "<td>" . $row['nimi'] . "</td>";  
echo "<td>" . $row['viesti'] . "</td>";  
echo "</tr>";  
}  
echo "</table>";  

mysqli_close($con);  
?>  

### handle.php

<?php  
include "config.php";  

$conn = new mysqli($servername, $username, $password, $dbname);  
if ($conn->connect_error){  
die("connection failed: " . $conn->connect_error);  
}  

$name = $_POST['name'];  
$viesti = $_POST['viesti'];  
$stmt = $conn->prepare('INSERT INTO Keskustelu (nimi, viesti) VALUES (?, ?)');  
$stmt->bind_param('ss', $name, $viesti);  

$stmt->execute();  

$conn->close();  
 
header("location: index.php");  
die();  
?>  

### index.php  

<?php  
include "database.php";  
?>  
<html>  
    <body>  
        <form action="handle.php" method="post">  
            Nimimerkki: <input type="text" name="name"><br>  
            Viesti: <textarea name="viesti"></textarea><br>  
            <input type="submit">  
        </form>  
    </body>  
</html>  

### index2.php  

<?php  
include "config.php";  

            $conn = new mysqli($servername, $username, $password, $dbname);  
            if ($conn->connect_error) {  
                die("connection failed: " . $conn->connect_error);  
            }  
            $sql = "SELECT * FROM Keskustelu";  
            $result = $conn->query($sql);  

            if ($result->num_rows > 0) {  
            while($row = $result->fetch_assoc()) {  
                echo "<br>".$row["nimi"]."</br><br>" . $row["viesti"]. "<br><br>";  
            }
        }

$conn->close();  
?>  
<html>  
    <body>  
        <form action="handle.php" method="post">  
            Nimimerkki: <input type="text" name="name"><br>  
            Viesti: <textarea name="viesti"></textarea><br>  
            <input type="submit">  
        </form>  
    </body>  
</html>  
