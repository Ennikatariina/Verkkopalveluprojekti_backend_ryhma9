<?php
require("../inc/headers.php");
require("../inc/functions.php");
require("db_order_functions.php");

$body = file_get_contents("php://input");
$dataObject =json_decode($body);
$username=$dataObject[0]->kayttajatunnus;

$shoppingCart=$dataObject[1];
//$kayttajatunnus=$_SESSION['kayttajatunnus'];


if(!isset($username)){
    http_response_code(401);
    echo "User not defined. Give valid username";
    return;
}

//Määritetään muuttujat
$tilaupvm=date("Y/m/d");

//Haetaan tietokannasta id_asiakas käyttäjätunnuksesta
try {
    $db = openDb();
    $id_asiakas= checkId_asiakas ($db, $username);
}catch(PDOException $pdoex) {
    returnError($pdoex);
}

//Tallentaan tilaustauluun tilauksen
//ja ottaa sieltä viimeisen tilausen tilausnumeron
try {
    $db = openDb();
    $viimeinenTilausnro=insertTilaus($db, $tilaupvm, $id_asiakas);
}catch(PDOException $pdoex) {
    returnError($pdoex);
}

//Tallentaa tilausrivi tauluun tilausen tiedot
try {
    $db = openDb();
    insertTilausrivi($db, $viimeinenTilausnro, $shoppingCart);
}catch(PDOException $pdoex) {
    returnError($pdoex);
}

?>