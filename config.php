<?php
function checkinput($val1)
{
	return strip_tags($val1);
}
function checkemail($val1)
{
	return filter_var($val1,FILTER_VALIDATE_EMAIL);
}

include('google/vendor/autoload.php');

$google_client = new Google_Client();

$google_client->setClientId('50472435839-5in0smmcrsu6ftc67d6nguomsou77qg4.apps.googleusercontent.com');

$google_client->setClientSecret('Z9lZY-mchMmN1L4kmGdsOrvW');

$google_client->setRedirectUri('http://localhost/myproject/index.php');

$google_client->addScope('email');

$google_client->addScope('profile');

$guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));

$google_client->setHttpClient($guzzleClient);

//api login with linkdin
/*
 * Configuration and setup LinkedIn API
 */
$client_id     = '78vp26t582536v';
$client_secret  = 'oe8ldiElwX8hHx5Q';
$redirect_url= 'http://localhost/myproject/index.php';
$scope= 'r_basicprofile r_emailaddress'; 

//API permissions

session_start();


?> 