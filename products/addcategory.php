<?php

require_once "../inc/functions.php";
require_once "../inc/headers.php";


$input = json_decode(file_get_contents('php://input'));
//$name = filter_var($input->name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name = filter_var($input->tuoteryhmanimi,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

try {
    $db = openDb();
    //$sql = "insert into category (name) values ('$name')";
    $sql = "insert into tuoteryhma (tuoteryhmanimi) values ('$name')";
    executeInsert($db,$sql);
    //$data = array('id' => $db->lastInsertId(), 'name' => $name);
    $data = array('tuoteryhmanro' => $db->lastInsertId(), 'tuoteryhmanimi' => $name);
    print json_encode($data);
}
catch(PDOException $pdoex) {
    returnError($pdoex);
}

//tämän pitäisi lukea tuoteryhmän nimi ja lisätä tiedot tietokantaan.
