<?php
require_once 'main.php';
$response = Auth::register();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>
<body>
<?php if (isset($response['error'])):?>
    <p><?=$response['error']?></p>
<?php endif;?>
<?php if (!empty($response['success'])):?>
    <p><?php header("Location: index.php"); ?></p>
<?php endif;?>
<form action="" method="post">
    <p>Name:<input type="text" name="name"></p>
    <p>email:<input type="text" name="email"></p>
    <p>Password:<input type="password" name="pass1"></p>
    <p>Repeat password:<input type="password" name="pass2"></p>
    <button type="submit">register</button>
    <button type="button" value="back" onClick='location.href="index.php"'>back</button>
</form>
</body>
</html>