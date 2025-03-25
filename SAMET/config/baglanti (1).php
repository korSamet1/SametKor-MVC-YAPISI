<?php
    function baglan()
    {
        $servername = "sql100.infinityfree.com";
        $username = "if0_37711758";
        $password = "NIgEfU0PtG";
        $dbname = "if0_37711758_samet";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_set_charset($conn, "utf8");
        return $conn;
    }
?>