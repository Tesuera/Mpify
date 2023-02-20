<?php

//index.php

//Include Configuration File
include('./config_login.php');
use Libs\Database\UsersTable;
use Libs\Database\MySQL;
use Libs\Helpers\Auth;
use Libs\Helpers\HTTP;

if(isset($_GET["code"]))
{

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    $email = '';
    $google_id = '';

    if(!isset($token['error']))
    {
    
    $google_client->setAccessToken($token['access_token']);

    
    $_SESSION['access_token'] = $token['access_token'];


    $google_service = new Google_Service_Oauth2($google_client);

    
    $data = $google_service->userinfo->get();

    if(!empty($data['email']))
    {
        $email = $data['email'];
    }

    $google_id = $data['id'];
    }

    $table = new UsersTable(new MySQL()); 
    $user = $table->loginWithGoogle($email, $google_id);
    if(isset($user->id)) {
        Auth::attempt([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'google_id' => $user->google_id
        ]);
        HTTP::redirect('land.php');
    } else {
        HTTP::redirect('login.php?user_not_found=1');
        exit();
    }
}
   
    
?>