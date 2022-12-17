<?php
require("../inc/headers.php");
require("../inc/functions.php");
require("db_order_functions.php");

$body = file_get_contents("php://input");
$dataObject =json_decode($body);
$kayttajatunnus=strip_tags("jussi");
//$kayttajatunnus=$_SESSION['kayttajatunnus'];

//Määritetään muuttujat
$tilaupvm=date("Y/m/d");

//Haketaan tietokannasta id_asiakas käyttäjätunnuksesta
$id_asiakas= checkId_asiakas ($kayttajatunnus);

//Tallentaan tilaustauluun tilauksen
//ja ottaa sieltä viimeisen tilausen tilausnumeron
$viimeinenTilausnro=insertTilaus($tilaupvm, $id_asiakas);

//Tallentaa tilausrivi tauluun tilausen tiedot
insertTilausrivi($viimeinenTilausnro, $dataObject);


?>