<?php
    $host = "localhost";
    //$host = "sql107.infinityfree.com";
    $user= "root";
    //$user= "if0_39198372";
    $password = "";
    //$password = "yVPewas3OFl3JV";
    $database = "UniFormity";
    //$database = "if0_39198372_UniFormity";

    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>