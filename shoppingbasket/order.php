<?php
require("../inc/headers.php");
require("../inc/functions.php");
require("db_order_functions.php");

$body = file_get_contents("php://input");
$dataObject =json_decode($body);
$kayttajatunnus=strip_tags("jussi");
//$kayttajatunnus=$_SESSION['kayttajatunnus'];


if(!isset($_POST['kayttajatunnus'])){
    http_response_code(401);
    echo "User not defined. Give valid username";
    return;
}

//Määritetään muuttujat
$tilaupvm=date("Y/m/d");

//Haketaan tietokannasta id_asiakas käyttäjätunnuksesta
try {
    $db = openDb();
    $id_asiakas= checkId_asiakas ($db, $kayttajatunnus);
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
    insertTilausrivi($db, $viimeinenTilausnro, $dataObject);
}catch(PDOException $pdoex) {
    returnError($pdoex);
}

?>