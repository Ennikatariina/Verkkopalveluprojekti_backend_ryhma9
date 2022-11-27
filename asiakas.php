<?php
//Ottaa yhteyden myconf.ini tiedostoon. Jos kansiorakenne muuttuu, niin tätä polkua pitää käydä muuttamassa 
$ini = parse_ini_file('myconf.ini');
//myconf.ini tiedostosta haetaan tiedot ja tallennetaan ne muuttujiin
$servername = $ini["servername"];
$username = $ini["username"];
$password = $ini["password"];
$database = $ini["database"];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>