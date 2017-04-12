<?php
   
   $connection = mysqli_connect("sql1.njit.edu","ac482","Z498qJCz");
        if(!$connection) {
            die("Couldn't connect to SQL server.");
        }
   $SQLdb = mysqli_select_db($connection, "ac482");
        if(!$SQLdb) {
            die("Couldn't open the database");
        }
?>