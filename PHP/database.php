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