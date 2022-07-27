<?php
require_once 'main.php';
$users= User::getAll();
$cats= Cat::getAll();
$currUser = $_GET["user_cats"];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    <?php foreach ($users as $user): ?>
        <?php foreach ($cats as $cat) : ?>
            <?php  if ($currUser === $cat->userId && $currUser===$user->id): ?>
                <?php  $comm = Comment::count($cat->id); ?>
                <td><input type="image" size="2" src="image/<?= $cat->userFotoCat ?>" width="250" height="250"></td>
                <br>
                User :<?= $user->user ?>
                Cat :<a href="cats.php?cat=<?= $cat->id ?>"> <?= $cat->cat ?></a>
                <?=' Age cat: ' . $cat->age.'.'.'  Comment: ' .$comm.'.'?><br>


            <?php endif; ?>
        <?php endforeach; ?><?php endforeach; ?>
</form>
</body>
</html>
