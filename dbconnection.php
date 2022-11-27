<?php
//Tämä funktio luo tietokanta yhteyden.
function createDbConnection()
{
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
        //Tässä laitetaan virheen käsittely päälle. Eli jos tulee virhe, niin se aiheuttaa poikkeuksen ja mennään catchiin. 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        return $conn;
    } catch (PDOException $e) {
        //pitääkö olla virheen käsittely header('HTTP/1.1 500 Internal Sever Error')?
        echo "Connection failed: " . $e->getMessage();
    }
    return null;
}
