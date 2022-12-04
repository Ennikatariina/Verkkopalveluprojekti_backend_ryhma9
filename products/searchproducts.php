<?php
require_once '../inc/functions.php';
require_once '../inc/headers.php';

// lukee parametrit urlista
$uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
//Parametrit erotellaan (/)
$parameters = explode('/',$uri);

//
$phrase = $parameters[1];

try {
    $db = openDb();
    $sql = "select * from product where name like '%$phrase%'";
    selectAsJson($db,$sql);
}
catch (PDOException $pdoex){
    returnError($pdoex);
}