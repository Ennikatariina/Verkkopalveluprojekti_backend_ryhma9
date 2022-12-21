<?php

require_once "../inc/functions.php";
require_once "../inc/headers.php";

//Tuoteryhmien ylläpito. Tuoteryhmän(kategoria) lisäys frontissa tietokantaan.

$input = json_decode(file_get_contents('php://input'));
//$name = filter_var($input->name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//$name = filter_var($input->tuoteryhmanimi,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//ääkköset toimivat, kun loppurimpsun jätti pois.
$name = $input->tuoteryhmanimi;
try {
    $db = openDb();
    //lisätään tuoteryhmä 
    //$sql = "insert into category (name) values ('$name')";
    $sql = "insert into tuoteryhma (tuoteryhmanimi) values ('$name')";
    executeInsert($db,$sql);
    //tulostaa jsonina viimeisimmän tuoteryhmanro: ja tuoteryhmanimi:
    //$data = array('id' => $db->lastInsertId(), 'name' => $name);
    $data = array('tuoteryhmanro' => $db->lastInsertId(), 'tuoteryhmanimi' => $name);
    print json_encode($data);
}
catch(PDOException $pdoex) {
    returnError($pdoex);
}

//tämän lukee tuoteryhmän nimen ja lisää tuoteryhman/kategorian tietokantaan.
//tämä toiminto siis adminille


