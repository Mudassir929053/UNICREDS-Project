<?php

// SenangPay
$merchant_id = '634163391725439';
$secretkey = '4053-1869385280';

// BillPlz Configuration
$api_key = "8fc6dae8-abed-48b1-8c5e-12fe23800e9c";
$x_signature = "S-J8J047STUUAs8I97Fkupxg";
$is_sandbox = true;

$websiteurl = 'http://'.$_SERVER['SERVER_NAME'].'/unicreds/';
$successpath = 'http://'.$_SERVER['SERVER_NAME'].'/unicreds/success.php';
$fallbackurl = 'http://'.$_SERVER['SERVER_NAME'].'/unicreds/fail.php';

// Get IP Function
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}