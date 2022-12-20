<?php

require("../inc/headers.php");
require("../inc/functions.php");

$body = file_get_contents("php://input");
$dataObject =json_decode($body);
$db = openDb();

// tallentaa yhteyslomake tauluun viestit
function insertcontact($db, $etunimi, $sukunimi, $email, $puhnro, $viesti){
   $sql= "INSERT INTO yhteyslomake (etunimi, sukunimi, email, puhnro, viesti) VALUES (?, ?, ?, ?, ?)";
    $statement = $db->prepare($sql);
    $statement->execute(array($etunimi, $sukunimi, $email, $puhnro, $viesti));
    $viimeinenViesti=  $db->lastInsertId();
    return $viimeinenViesti;
}
    //poimii tiedot
    $etunimi = $dataObject->etunimi;
    $sukunimi = $dataObject->sukunimi;
    $email = $dataObject->email;
    $puhnro = $dataObject->puhnro;
    $viesti = $dataObject->viesti;

    //työntää viestit tietokantaan
    insertcontact($db, $etunimi, $sukunimi, $email, $puhnro, $viesti);

    
