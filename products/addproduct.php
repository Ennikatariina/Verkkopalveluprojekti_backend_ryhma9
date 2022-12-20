<?php

require_once "../inc/functions.php";
require_once "../inc/headers.php";

//Alkuperäiset rivit kommenteissa. kuviin lisätty 'varakuva.jpg' jospa se toimisi tässä "placeholderina"


$input = json_decode(file_get_contents('php://input'));
//$name = filter_var($input->name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//$name = filter_var($input->tuotenimi,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//näin toimii ääkköset kun jättää loppurimpsun pois. Lukee tuotenimen, mikä lisätään frontissa
$name = $input->tuotenimi;
//$price = filter_var($input->price,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//lukee hinnan, mikä lisätään frontissa
$price = filter_var($input->hinta,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//$category_id = filter_var($input->categoryid,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//Lisää mukaan tuoteryhmänro tuotteeseen kun tuote lisätään tuotekategoriaan.
$category_id = filter_var($input->tuoteryhmanro,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//pitääkö tehdä kuvakselle tällainen rivi kans? huomaa myös alempana arrayssä tämä lisättynä.
//ääkköset toimii kun jättää loppurimpsun pois.
$description = $input->kuvaus;

try {
    $db = openDb();
    //$sql = "insert into product (name,price,image,category_id) values ('$name',$price,'placeholder.png',$category_id)";
    $sql = "insert into tuote (tuotenimi,kuvaus,kuvannimi,hinta,tuoteryhmanro) values ('$name','$description','varakuva.jpg',$price,$category_id)";
    //järjestys tuotetaulun mukaan.
    executeInsert($db,$sql);
    //$data = array('id' => $db->lastInsertId(),'name' => $name,'price' => $price, 'image' => 'placeholder.png'); //Lisätty kuvaus.
    $data = array('tuotenro' => $db->lastInsertId(),'tuotenimi' => $name,'kuvaus'=> $description,'hinta' => $price, 'kuvannimi' => 'varakuva.jpg');
    print json_encode($data);
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}


?>
