<?php
 
        // servername => localhost
        // username => root
        // password => empty
        // database name => businesscarddb
        $conn = mysqli_connect("localhost", "root", "", "businesscarddb");
         
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }

        
?>