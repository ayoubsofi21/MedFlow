<?php
try {

$conn = new pdo("mysql:host=localhost;dbname=gestion_rendezvous_medical", "root", "");
// echo "connected with successfully";
}catch(PDOException $e){
     echo("Connection failed: " . $e->getMessage());
}

?>