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
