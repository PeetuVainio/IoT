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