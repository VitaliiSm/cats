<?php
require_once 'class/User.php';
require_once 'class/Cat.php';

class Auth
{
    public static function register()
    {
        $response = [
            'success' => false,
            'error' => '',
        ];

        $users = User::getAll();
        foreach ($users as $value){
          if (isset($_POST['name'])&&isset($_POST['pass1'])&&isset($_POST['pass2'])&&isset($_POST['email'])) {
              if ($value->user !== $_POST['name'] && $value->email !== trim($_POST['email'])) {

                      if ($_POST['name']) {
                          $pass1 = trim($_POST['pass1']);
                          $pass2 = trim($_POST['pass2']);
                          if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                              $email=$_POST['email'];

                              if ($pass1 === $pass2) {
                                  $name = trim($_POST['name']);
                                  $user = new User();
                                  $user->user = $name;
                                  $user->email = $email;
                                  $user->pass = md5($pass1);
                                  $user->save();
                                  $response['success'] = true;
                              } else {
                                  $response['error'] = 'ERROR! Check password!';
                              }
                      }else{
                              $response['error']= 'wrong email';
                      }

                      } elseif (empty($_POST['name']) && !empty($_POST['pass1']) && $_POST['pass2']) {
                          $response['error'] = 'Name not write';
                      } elseif (empty($_POST['pass1']) && empty($_POST['pass2']) && $_POST['pass1'] === $_POST['pass2'] && !empty($_POST['name'])) {
                          $response['error'] = 'Password  not write or wrong';
                      }elseif(!isset($email)){
                          $response['error']= 'not write email';
                      }

                  if ((isset($_POST['name']) && $value->user === $_POST['name'])) {
                      $response['error']='this nickname is already taken sorry';
                  }
              } return $response;
          }
    }
    }
    public static function logIn()
    {
        $logIn= false;
        $users=User::getAll();
        foreach ($users as $user){
            if(!empty($_COOKIE['auth_token'])){
            if($user->auth_token===$_COOKIE['auth_token']){
                $logIn=true;
            }
        }
    }
        return $logIn;
    }
    private static function generateRandomString($length = 10)
    {
        $characters = '0123456789#abcdefghilkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
public static function authFromPost()
{
    $response = [
        'success' => false,
        'error' => '',
    ];

    if (isset($_POST['name'])) {
        $users = User::getAll();
        $name = trim($_POST['name']);
        $pass = trim($_POST['pass']);
        $email =trim($_POST['email']);
        $isUserFound = false;
        $isEmailFound = false;
        for ($i = 0; $i < count($users); $i++) {
            $user = $users[$i];
            $userInputHash = md5($pass);
            if ($user->user === $name && $user->pass === $userInputHash && $user->email === $email) {
                $isUserFound = true;
                $isEmailFound= true;
                if ($user->pass) {
                    $token = self::generateRandomString(32);
                    $user->auth_token = $token;
                    setcookie('auth_token', $token, time() + 60 * 60 * 24);
                    $response['success'] = true;
                } else {
                    $response['error'] = "Wrong password";
                }
                break;
            }
        }
      $user->save();
        if (!$isUserFound) {
            $response['error'] = 'User not found';
        }
        if (!$isEmailFound) {
            $response['error'] = 'Email not found';
        }
    }

    return $response;
}
}