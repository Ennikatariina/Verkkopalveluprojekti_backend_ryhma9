<?php
require("../inc/headers.php");

session_start();
session_destroy();
unset($_SESSION["kayttajatunnus"]);

http_response_code(200);
echo "Logged out";