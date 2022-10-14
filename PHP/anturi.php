<?php  

$servername ="hyvis.mysql.database.azure.com";  
$username ="db_projekti";  
$password ="Sivyh2022";  
$dbname ="Peetu";  

$conn = new mysqli($servername, $username, $password, $dbname);  
if ($conn->connect_error) {  
    die("connection failed: " . $conn->connect_error);  
}

$sql = "SELECT * FROM anturidata ORDER BY id DESC limit 10";  
$result = $conn->query($sql);  
$liiketta = 0;
$hiljaista = 0;
$tulos = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {  
        if ($row["liike"] == 1) {
            $liiketta++;
        }
        else {
            $hiljaista++;
        }
        $tulos.="<tr><td>".$row["liike"]."</td><td>" . $row["aika"]. "</td></tr>";
    }
}
$conn->close();  
?>  
<html>
    <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['liike', 'aika'],
          ['1',     <?php echo $liiketta ?>],
          ['0',      <?php echo $hiljaista ?>]

        ]);

        var options = {
          title: 'liike anturidataa'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    </head>
        <body>
        <table>
  <tr>
    <th>liike</th>
    <th>aika</th>
  </tr>
<?php
    echo $tulos;
?>
</table>
<div id="piechart" style="width: 900px; height: 500px;"></div>
        </body>  
</html>  