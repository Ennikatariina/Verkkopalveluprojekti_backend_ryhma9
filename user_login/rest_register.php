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
//if(preg_match('/^[a-Za-Z0-9]+$/', $_POST["kayttajatunnus"])== 0){
  //  echo "Käyttäjätunnus ei kelpaa.";
    //return;
//}

//tutkitaan onko salasanassa riittävästi merkkejä

//if(strlen($_POST["salasana"]) <= 5) {
  //  return "Salasanan tulee sisältää vähintään 5 merkkiä.";
//}


registerUser($user->id_asiakas, $user->etunimi, $user->sukunimi, $user->osoite, $user->postinro, $user->postitmp, $user->puhelinnro, $user->email, $user->kayttajatunnus, $user->salasana);

$_SESSION['kayttajatunnus']=$user->kayttajatunnus;

http_response_code('200');
echo "User $user->etunimi registered";