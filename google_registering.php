<?php

//index.php

//Include Configuration File
include('./config_register.php');
use Libs\Database\UsersTable;
use Libs\Database\MySQL;
use Libs\Helpers\Auth;
use Libs\Helpers\HTTP;

if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 $givenArr = [];

 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $givenArr['first_name'] = $data['given_name'];
  } else {
    $givenArr['first_name'] = '';
  }

  if(!empty($data['family_name']))
  {
   $givenArr['last_name'] = $data['family_name'];
  }else {
    $givenArr['last_name'] = '';
  }

  if(!empty($data['email']))
  {
   $givenArr['email'] = $data['email'];
  }

  $givenArr['google_id'] = $data['id'];
 }

$table = new UsersTable(new MySQL()); 
if(!$table->checkEmailExists($givenArr['email'])) {
    $role = 'member';
    $user_id = $table->registerWithGoogle([
        'name' => $givenArr['first_name'] . ' ' . $givenArr['last_name'],
        'email' => $givenArr['email'],
        'google_id' => $givenArr['google_id'],
        'role' => $role
    ]);
    Auth::attempt([
        'id' => $user_id,
        'name' => $givenArr['first_name'] . ' ' . $givenArr['last_name'],
        'email' => $givenArr['email'],
        'role' => $role,
        'google_id' => $givenArr['google_id']
    ]);
    HTTP::redirect('land.php');
} else {
    HTTP::redirect('register.php?email_exist=1');
    exit();
}
}
?>