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
#### Täydennetty viimeviikon asioita
### 19.9.2022
#### koodi, jolla liikeanturi toimii ja vie tiedot taulukkoon
import time = nykyisen ajan saaminen, ohjelman suorittamisen keskeyttäminen import Pri.GPIO as GPIO = viittaa kaikkiin moduulin toimintoihin lyhyemmällä nimellä GPIO impport mariadb = vaikuttaa mariadb:n mukaan tähän koodiin  

GPIO.setmode(GPIO.BCM) =  
GPIO.setup(23, GPIO.IN) =  
conn = mariadb.connect(user="", password="", host="", database="") = kirjautuu valitsemaan tietokantaan cur = conn.cursor() =  

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
   SET PASSWORD FOR ''@localhost=PASSWORD(");  = laittaa salasanan tietokannalle
   flush privileges; = tyhjentää tai lataa uudelleen erilaisia MariaDB:n käyttämiä sisäisiä välimuistia

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
 
 conn = mariadb.connect(user="", password="", host="", database="")  
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

## 26.9.2022
Tehtiin raspin localhost sivua:  
-liitettiin kuva, tekstiä ja linkki  
-etsittiin hyvä taulukko ja muokattiin sitä  


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
            $servername ="esimerkki_servername";  
            $username ="root";  
            $password ="esimerkki_salasana";  
            $dbname ="esimerkki_SRYHMA_Peetu";  
            
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

$servername ="esimerkki_servername";  
$username ="esimerkki_username";  
$password ="esimerkki_salasana";  
$dbname ="esimerkki_dbname";  

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
$sql = "INSERT INTO esimerkki (nimi, viesti) VALUES ('".$name."', '".$viesti."')";  


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
            $sql = "SELECT * FROM esimerkki";  
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
Use esimerkki  
create database esimerkki  
create table esimerkki (id int primary key auto_increment. nimi varchar(255), viesti varchar(1000))  
## 12.10.2022  
sain tehtyä keskustelu lomakkeen loppuun  
#### koodit
### config.php  

<?php  

$servername ="esimerkki_servername";  
$username ="esimerkki_username";  
$password ="esimerkki_salasana";  
$dbname ="esimerkki_dbname";  

?>  

### database.php  

<?php  
$con=mysqli_connect("esimerkki_servername","esimerkki_username","esimerkki_salasana","esimerkki_dbname");  
  
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
$stmt = $conn->prepare('INSERT INTO esimerkki (nimi, viesti) VALUES (?, ?)');  
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
  
## 14.10.2022
Sain aseteltua datan tietokannasta html taulukkoon  
Sain tehtyä datasta google chartin  
Siirsin koodit omiin external tiedostoihin  
Laitoin READ.me kuntoon  

### database.php
  
<?php  
$con=mysqli_connect("esimerkki_servername","esimerkki_username","esimerkki_salasana","esimerkki_dbname");  
  
if (mysqli_connect_errno())  
{  
echo "Failed to connect to MySQL: " . mysqli_connect_error();  
}  
  
$result = mysqli_query($con,"SELECT * FROM esimerkki");  
  
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
  
-SQL-injektio on tekniikka tietoturva-aukkojen hyödyntämiseksi järjestelmiin tunkeutumisessa. Niitä esiintyy tietokantapohjaisissa sovelluksissa. Ne ovat varsin yleisiä WWW-pohjaisissa sovelluksissa joissa käyttäjät käyttävät tietokantaa WWW-rajapinnan yli, mutta SQL-injektiot eivät sinällään ole WWW-sidonnaisia.  
-SQL-injektion voi estää simppelillä koodilla
### Koodi SQL-injektion estämiseksi
  
$name = $_POST['name'];  
$viesti = $_POST['viesti'];  
$stmt = $conn->prepare('INSERT INTO Keskustelu (nimi, viesti) VALUES (?, ?)');  
$stmt->bind_param('ss', $name, $viesti);  
  
$stmt->execute();  
  
$conn->close();   
  
-Tein uuden taulukon tietokantaan:  
use esimerkki  
create table anturidata(id int primary key auto_increment, liike int, aika datetime)  
insert into anturidata (liike, aika) values (1, now())  
insert into anturidata (liike, aika) values (0, now())  
select * from anturidata  

## 17.10
-siirsin projektin raspille  
-laitoin vielä READmen kuntoon  
