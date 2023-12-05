<?php
define("SITE_URL", "http://localhost/coffeshop/");


define("MAIL_HOST", "smtp.office365.com");
define("MAIL_USER", "fierro2116@outlook.com");
define("MAIL_PASS", "FierroR23.");
define("MAIL_PORT", "587");



define("CLIENT_ID", "AV6jBxCPG1xasRKk2yf3imAe3_zKn4fAeVQTRK9L_FoSTQth73ESL4Nis8VuEGzOHROuJggo_-wVTDnL"); //AV6jBxCPG1xasRKk2yf3imAe3_zKn4fAeVQTRK9L_FoSTQth73ESL4Nis8VuEGzOHROuJggo_-wVTDnL
define("CURRENCY", "MXN");
define("KEY_TOKEN", "Cgp3cs1%6*");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}


?>