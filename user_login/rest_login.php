<?php
require("../inc/headers.php");

//Rekisteröinnissä startataan sessio.
session_start();
require("./db_user_controller.php");

//kun käyttäjä yrittää kirjautua, niin katsotaan onko sessio jo käynnissä eli käyttäjä kirjautuneena
if(isset($_SESSION['kayttajatunnus'])){
    http_response_code(200);
    //echo $_SESSION['kayttajatunnus'];
    //palauttaa tiedon käyttäjästä ja admin oikeuksista? pitää adminin kirjautuneena sivua päivittäessä
    $data["username"]=$_SESSION['kayttajatunnus'];
    $data["admin"]=$_SESSION['admin'];
    echo json_encode($data);
    return;
}



//Onko asetettu post-parametria: onko määritelty kayttajatunnus parametria ja salasana parametria
if(!isset($_POST['kayttajatunnus']) || !isset($_POST['salasana'])){
    http_response_code(401);
    echo "User not defined. Give valid username and password rest_login";
    return;
}

$uname= $_POST['kayttajatunnus'];
$pw= $_POST['salasana'];

$verified_uname= checkUser($uname, $pw);
$admin= checkAdmin($uname);
if($verified_uname){
    $_SESSION["kayttajatunnus"]=$verified_uname;
    $_SESSION["admin"]=$admin;
    http_response_code(200);
    $data["username"]=$verified_uname;
    $data["admin"]=$admin;
    echo json_encode($data);
}else{
    http_response_code(401);
    echo"Wrong username or password.";
}
