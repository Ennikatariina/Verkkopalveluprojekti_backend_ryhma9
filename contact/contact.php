<?php

require("../inc/headers.php");
require("../inc/functions.php");

$body = file_get_contents("php://input");
$dataObject =json_decode($body);

// tallentaa yhteyslomake tauluun viestit
function insertcontact($db, $etunimi, $sukunimi, $email, $puhnro, $viesti){
   $sql= "INSERT INTO yhteyslomake (etunimi, sukunimi, email, puhnro, viesti) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = $db->prepare($sql);
    $statement->execute(array($etunimi, $sukunimi, $email, $puhnro, $viesti));
    $viimeinenViesti=  $db->lastInsertId();
    return $viimeinenViesti;
    }

    
