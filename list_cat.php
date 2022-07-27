<?php
require_once 'main.php';
$catData = Cat::getAll();
$currUser = User::getCurrUser();
cat::delete();
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>


<table style="border: 1px solid black;
">
    <thead>
    <td>foto</td>
    <td>name</td>
    <td>age</td>
    <td>description</td>
    <td>actions</td>
    </thead>
    <tbody>

    <?php
    foreach ($catData as $value): ?>
        <?php if ($value->userId === $currUser->id): ?>
            <tr>
                <td><input type="image" size="2" src="image/<?= $value->userFotoCat ?>" width="100" height="100"></td>
                <td><b><a href="cats.php?cat=<?= $value->id ?>"><?= $value->cat ?></a></b></td>
                <td><i><?= $value->age ?> </i></td>
                <td><i><?= $value->description ?> </i></td>
                <form action="" method="post">
                    <td>
                        <button name="delete" type="submit" value="<?= $value->id ?>"
                        '>delete</button></td>
                    <td><a href="edit_cat.php?cat_id=<?= $value->id ?>">edit</a></td>
            </tr>
        <?php endif ?>
    <?php endforeach;; ?>
    </tbody>
</table>
<button name="3" type="button" onClick='location.href="user.php"'>back</button>

</form>

</body>
</html>
