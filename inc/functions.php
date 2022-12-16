<?php

//Avaa tietokantayhteyden
function openDb(): object
{
    //Ottaa yhteyden myconf.ini tiedostoon. Jos kansiorakenne muuttuu, niin tätä polkua pitää käydä muuttamassa 
    $ini = parse_ini_file('../myconf.ini', true);
    //myconf.ini tiedostosta haetaan tiedot ja tallennetaan ne muuttujiin
    $servername = $ini["servername"];
    $username = $ini["username"];
    $password = $ini["password"];
    $database = $ini["database"];

    $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception 
    //Tässä laitetaan virheen käsittely päälle. Eli jos tulee virhe, niin se aiheuttaa poikkeuksen ja mennään catchiin. 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

//Tämä funktio hakee useita riviä tietokannasta?
function selectAsJson(object $db, string $sql): void
{
    $query = $db->query($sql);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($result);
}
//Tämä funktio hakee yhden rivin tietokannasta?
function selectRowAsJson(object $db, string $sql): void
{
    $query = $db->query($sql);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($result);
}

//Lisäyslauseen suoritus. Lisätään tietokantaan jotakin ja . 
//Palauttaa intin eli palauttaa viimeisimmän lisätyn tietueen pääavaimen.
function executeInsert(object $db, string $sql): int
{
    $query = $db->query($sql);
    //return $db->lastInert(); //kuuluuko olla insert?
    return $db->lastInsertId();
}

//Virheenkäsittely. Saadaan parametrina tietokantapoikkeus ja se muutetaan json. exitilla lopetetaan. 
function returnError(PDOException $pdoex): void
{
    header('HTTP/1.1 500 Internal Sever Error');
    $error = array('error' => $pdoex->getMessage());
    echo json_encode($error);
}
