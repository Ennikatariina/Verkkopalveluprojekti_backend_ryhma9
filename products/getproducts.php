<?php
require_once "../inc/functions.php";
require_once "../inc/headers.php";

//Tuotteet esille tuoteryhmittäin frontissa.

//"bäkkärissä luetaan osoitteesta viimeiset osa eli / ja numero."
$uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH); //luetaan osoite. Frontista tuleva kutsu.
$parameters = explode('/',$uri); //"hajottaa osoiteen palasiksi"
//print_r($parameters); //tällä voi tarkistaa mitä parameters tulostaa
$tuoteryhmanro = $parameters[1]; //lukee kauttaviivalla erotetun numeron eli viimeisen numeron. Herjaa, joten lisää tuotekategorian numero perään selain rivillä.



try {
    $db =openDb();
    $sql = "select * from tuoteryhma where tuoteryhmanro = $tuoteryhmanro";
    $query = $db->query($sql);
    $category = $query->fetch(PDO::FETCH_ASSOC);
    //fetch palauttaa yhden tietueen.
    $sql = "select * from tuote where tuoteryhmanro = $tuoteryhmanro";
    $query = $db->query($sql);
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    //fetchAll palauttaa monta tietuetta.
    header('HTTP/1.1 200 OK');
    echo json_encode(array(
       "category" => $category['tuoteryhmanimi'],
       "products" => $products 
    ),JSON_PRETTY_PRINT);
}catch (PDOException $pdoex){
    returnError($pdoex);
}

?>