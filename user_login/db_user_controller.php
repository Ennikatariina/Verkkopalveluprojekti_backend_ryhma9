<?php
//Tässä tiedostossa on käyttäjän ja tietokantaan hallintaan funktiot. 
require('../inc/functions.php');

/**
 * Insert a new user in the database
 */

function registerUser($id_asiakas, $etunimi, $sukunimi, $osoite, $postinro, $postitmp, $puhelinnro, $email, $kayttajatunnus, $salasana)
{
    $db = openDb();
    //Tässä vaiheessa pitäisi testata, että käyttäjätunnut ja salasana ovat oikeanlaisia
    try {
        $salasana = password_hash($salasana, PASSWORD_DEFAULT, ["cost" => 16]); //tekee salasanan vaikeammaksi hakkeroida
        $sql = "INSERT INTO asiakas (id_asiakas, etunimi, sukunimi, osoite, postinro, postitmp, puhelinnro, email, kayttajatunnus, salasana) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $statement = $db->prepare($sql);
        $statement->execute(array($id_asiakas, $etunimi, $sukunimi, $osoite, $postinro, $postitmp, $puhelinnro, $email, $kayttajatunnus, $salasana));
    } catch (PDOException $e) {
        echo "Somerthing went wrong";
    }
    //Tässä pitäisi olla try cath rakenne, jos jokin menee pieleen. Nyt oletetaan että kaikki menee hyvin. 
}


/**
 * Checks the user credentials and returns the username
 */
function checkUser($uname, $pw)
{
    $db = openDb();
    $sql = "SELECT salasana FROM asiakas WHERE kayttajatunnus=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));
    //fetchColumn hakee ensimäisen rivin ensimmäisen sarakkeen
    $hashedpw = $statement->fetchColumn();

    //tutkitaan onko salasana oikea
    if (isset($hashedpw) && password_verify($pw, $hashedpw)) {
        return $uname;
    } else {
        return null;
    }
}
// tutkii onko käyttäjä admin vai ei
function checkAdmin($uname)
{
    $db = openDb();
    $sql = "SELECT admin FROM asiakas WHERE kayttajatunnus=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));
    //fetchColumn hakee ensimäisen rivin ensimmäisen sarakkeen
    $admin = $statement->fetchColumn();
    return $admin;
}
