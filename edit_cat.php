<?php
require_once 'main.php';
$currUser = User::getCurrUser();
$response = Cat::uploadsFoto();
$params = $_GET;
if (!key_exists('cat_id', $params)) {
    echo 'Cat not found';
    die();
}
$catId = $params['cat_id'];
if (!$cat = User::getCatById($catId)) {
    echo 'Cat not found by id: ' . $catId;
    die();
}

if ($params = $_POST) {
    $param = new Cat();
    $param->cat=$params['cat'];
    $param->age=$params['age'];
    $param->description=$params['description'];
    if (!empty($response['name'])){
        $param->userFotoCat = $response['name'];
    }else{
        $param->userFotoCat = $cat->userFotoCat;
    }
    $param->id=$catId;
    $param->update();
    header("Location: list_cat.php");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>
<body>

<form method="post" enctype="multipart/form-data">
    <p>foto cat
        <input type="file" name="uploads[]"/><br/></p>
    <div>
        <input type="image" size="2" src="image/<?= $cat->userFotoCat ?>" width="100" height="100">
    </div>
    <input type="text" name="cat" placeholder="name cat" value="<?= $cat->cat ?>">
    <input type="text" name="age" placeholder="age cat" value="<?= $cat->age ?>">
    <input type="text" name="description" placeholder="description" value="<?= $cat->description ?>">
    <br>
    <button type="submit">Change</button>
    <button type="button" value="user_list" onClick='location.href="list_cat.php"'>list cats</button>
    <button type="button" onClick='location.href="index.php"'>exit</button>
</form>

</body>
</html>