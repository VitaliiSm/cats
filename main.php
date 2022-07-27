<?php
require_once 'class/Cat.php';
require_once 'class/BaseModel.php';
require_once 'class/Dbconnection.php';
require_once 'class/User.php';
require_once 'class/Auth.php';
require_once 'class/Comment.php';
require_once 'class/Rating.php';
require_once 'class/Other.php';

$users =User::getAll();
$currUser = User::getCurrUser();
$login = Auth::logIn();
//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <?php    if($login !== true):?>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="register.php">register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="top_10.php">top 10</a>
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php else:?>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="list_cat.php">my cat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="user.php">my profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="top_10.php">top 10</a>
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php endif;?>
    <title>Document</title>
</head>
<body>

</body>
</html>
