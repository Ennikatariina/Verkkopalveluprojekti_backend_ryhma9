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
    http_response_code("401");
    echo "Käyttäjää ei löytynyt. ";
    return;
}

//tutkitaan onko käyttäjätunnus järkevä
if(preg_match('/^[a-zA-Z0-9]+$/', $user->kayttajatunnus)== 0){
    echo "Käyttäjätunnus ei kelpaa.";
    return;
} 

//tutkitaan onko salasanassa riittävästi merkkejä

if(strlen($user->salasana)<= 5) {
    echo "Salasanan tulee sisältää vähintään 5 merkkiä.";
    return;
} 

$id_asiakas= strip_tags($user->id_asiakas);
$etunimi= strip_tags($user->etunimi);
$sukunimi= strip_tags($user->sukunimi);
$osoite= strip_tags($user->osoite);
$postinro= strip_tags($user->postinro);
$postitmp= strip_tags($user->postitmp);
$puhelinnro= strip_tags($user->puhelinnro);
$email= strip_tags($user->email);
$kayttajatunnus= strip_tags($user->kayttajatunnus);
$salasana= strip_tags($user->salasana);

registerUser($id_asiakas, $etunimi, $sukunimi, $osoite, $postinro, $postitmp, $puhelinnro, $email, $kayttajatunnus, $salasana);

$_SESSION['kayttajatunnus']=$kayttajatunnus;

http_response_code('200');
echo "User $user->etunimi registered";