<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once './vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('717629841145-r24i6l1f17h4eht8bdbmf3vnsa0i1qhs.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/mpify/google_registering.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>