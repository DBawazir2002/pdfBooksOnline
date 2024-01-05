<?php
try {
    $userName = "root";
    $password = "";
    $con = new PDO('mysql:host=localhost;dbname=pdfbooks', $userName, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $th) {
    print "Error!: " . $th->getMessage . "<br />";
    die();
}