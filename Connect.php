<?php
   
   $connection = mysqli_connect("sql1.njit.edu","xxxx","xxxx");
        if(!$connection) {
            die("Couldn't connect to SQL server.");
        }
   $SQLdb = mysqli_select_db($connection, "xxxx");
        if(!$SQLdb) {
            die("Couldn't open the database");
        }
?>
