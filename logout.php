<?php

//logout.php

include('./config_login.php');
use Libs\Helpers\Auth;
$auth = Auth::check();
//Reset OAuth access token
if($auth['google_id']) {
    $google_client->revokeToken();
}
//Destroy entire session data.
unset($_SESSION['auth']);
session_destroy();

//redirect page to index.php
header('location:index.php');

?>