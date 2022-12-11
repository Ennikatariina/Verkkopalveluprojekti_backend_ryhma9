<?php
require("../inc/headers.php");

//Rekisteröinnissä startataan sessio.
session_start();
require("./db_user_controller.php");
//rekisteröinnissa otetaan vastaan json tiedon
$body =file_get_contents("php://input");
$user=json_decode($body);

//Onko syötteitä asetettu
if(!isset($user ->kayttajatunnus) || !isset($user ->salasana)){
    http_response_code("400");
    echo "Käyttäjää ei löytynyt. ";
    return;
}

//tähän pitäisi tehdä funktio, joka tutkii onko käyttäjätunnus järjevä ja
//onko salasanassa rittävämäärä merkkejä ja oikeanlaisia merkkejä
// Jos nämä eivät ole kunnossa, ilmoitetaan käyttäjällä siitä
//Ilman tätä funktiot oletetaan, että käyttäjä antama käyttäjätunnus ja salasana ovat aina oikeita


registerUser($user->id_asiakas, $user->etunimi, $user->sukunimi, $user->osoite, $user->postinro, $user->postitmp, $user->puhelinnro, $user->email, $user->kayttajatunnus, $user->salasana);

$_SESSION['username']=$user->kayttajatunnus;

http_response_code('200');
echo "User $user->etunimi registered";