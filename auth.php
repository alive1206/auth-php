<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


$sec_key = 'your_secret_key';

$header = apache_response_headers();
// var_dump($header);
if (isset($header['Authorization'])) {
    $header = $header['Authorization'];
    // Giả sử token có dạng "Bearer token"
    list($jwt) = sscanf($header, 'Bearer %s');
    
    if ($jwt) {
        try {
            $decode = JWT::decode($jwt, new Key($sec_key, 'HS256'));
            echo $decode->username;
        } catch (Exception $e) {
            // Xử lý lỗi nếu token không hợp lệ
            echo 'Token không hợp lệ: ' . $e->getMessage();
        }
    }
}


$users = [
    "thang" => "1"
];
$cookie_name = "user";
// $currentDir = getcwd();
// ini_set('session.save_path', "$currentDir/sessions");
session_start();

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32)); 
}


if (isset($_POST['user'])) { 
    $username = $_POST['user'];
    $password = $_POST['password'];


    if (isset($users[$username]) && $users[$username] == $password) {
        $_SESSION['username'] = $username; 
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
        
        setcookie($cookie_name, $username, time() + (86400 * 30), "/");
      
        $token = trim($_POST['token']);
        if (!$token || $token !== $_SESSION['token']) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit();
        } else {
            // header("Location: index.php"); 
            $payload = array(
                'isd' => 'localhost',
                'aud' => 'localhost',
                'username' => 'thang',
                'password' => '1',
            );
          
            $encode = JWT::encode($payload, $sec_key, 'HS256');
            echo $encode;
            exit();
        }
    }       
        
    else {
        $failed = true; 
    }
}

if(isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}


