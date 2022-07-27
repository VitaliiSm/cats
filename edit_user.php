<?php
require_once 'main.php';

$currUser = User::getCurrUser();
$params = $_GET;
if (!key_exists('user_id', $params)) {
    echo 'Cat not found';
    die();
}
$UserId = $params['user_id'];
if (!$user = User::getCurrUser($UserId)) {
    echo 'Cat not found by id: ' . $UserId;
    die();
}
if ($params = $_POST) {
if (!empty($params['old_password'])){
$pass1 = trim($params['pass3']);
$pass2 = trim($params['pass4']);
if (filter_var($_POST['email1'], FILTER_VALIDATE_EMAIL)) {
    $email = $_POST['email1'];
    if ($currUser->pass === md5($params['old_password'])) {
        if ($pass1 === $pass2) {
            $param = new User();
            $param->user = $params['name1'];
            $param->email = $params['email1'];
            $param->pass = md5($pass1);
            $param->auth_token = $currUser->auth_token;
            $param->id = $UserId;
            $param->update();
            header("Location: user.php");
        }else echo 'Repeat new  password';
    }  else echo 'Wrong old password';
}else echo 'Repeat email';
}
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>
<body>
<form action="" method="post" >
    <p>old password:<input type="text" name="old_password" placeholder="password"><br></p>

    <br>
    <p>new login:<input type="text" name="name1" placeholder="name" value="<?= $currUser->user ?>"><br></p>
    <p> new email<input type="text" name="email1" placeholder="email" value="<?=$currUser->email ?>"><br></p>
    <p>new password<input type="text" name="pass3" ><br></p>
    <p> Repeat password<input type="text" name="pass4" ></p>
    <br>
    <button type="submit">Change</button>
</form>

</body>
</html>