<?php
try {
    $userName = "waziri";
    $password = "0000";
    $con = new PDO('mysql:host=localhost;dbname=pdfBooksOnline', $userName, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $th) {
    print "Error!: " . $th->getMessage . "<br />";
    die();
}