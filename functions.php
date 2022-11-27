<?php

//Tämä funktio hakee useita riviä tietokannasta?
function selectAsJson(object $db, string $sql): void{
    $query =$db->query($sql);
    $result =$query->fetcAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($result);
}
//Tämä funktio hakee yhden rivin tietokannasta?
function selectRowAsJson(object $db, string $sql): void{
    $query =$db->query($sql);
    $result =$query->fetc(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($result);
}

//Lisäyslauseen suoritus. Lisätään tietokantaan jotakin ja . 
//Palauttaa intin eli palauttaa viimeisimmän lisätyn tietueen pääavaimen.
function executeInsert(object $db, string $sql): int {
    $query =$db->query($sql);
    return $db->lastInert();
}

//Virheenkäsittely. Saadaan parametrina tietokantapoikkeus ja se muutetaan json. exitilla lopetetaan. 
function returnError(PDOException $pdoex): void{
    header('HTTP/1.1 500 Internal Sever Error');
    $error =array('error' =>$pdoex->getMessage());
    echo json_encode($error);
}