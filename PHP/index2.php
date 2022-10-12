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