<?php
require_once('../inc/functions.php');
//Tämä funktio hakee kayttajatunnuksesta asiakas id (id_asiakas) tietokannasta
function checkId_asiakas ($db, $kayttajatunnus){
    $sqlhaku="SELECT id_asiakas FROM asiakas WHERE kayttajatunnus=?";
    $statement =$db -> prepare($sqlhaku);
    $statement ->execute(array($kayttajatunnus));
//fetchColumn hakee ensimäisen rivin ensimmäisen sarakkeen
    $id_asiakas=$statement->fetchColumn();
    return $id_asiakas;
}

//Tämä funktio tallentaa tilaus tauluun tilauksen
function insertTilaus($db, $tilaupvm, $id_asiakas){
    $sql= "INSERT INTO tilaus (tilauspvm, id_asiakas) VALUES (?,?)";
    $statement = $db->prepare($sql);
    $statement->execute(array($tilaupvm, $id_asiakas));
    $viimeinenTilausnro=  $db->lastInsertId();
    return $viimeinenTilausnro;
    }

//Tämä funktio tallentaa tilausrivi tauluun tilausen tiedot
function insertTilausrivi($db, $viimeinenTilausnro, $dataObject){
    $rivinro=1;
        foreach($dataObject as $tuote){
            $sql="INSERT INTO tilausrivi (rivinro, tilausnro, tuotenro, kpl) VALUES (?,?,?,?)";
            $statement = $db->prepare($sql);
            $statement->execute(array($rivinro,$viimeinenTilausnro, $tuote ->tuotenro, $tuote->amount));
            $rivinro++;
    };
}