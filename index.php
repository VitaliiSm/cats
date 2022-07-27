<?php
require_once 'main.php';
$users= User::getAll();
$cats= Cat::getAll();
$errorMessage = false;
$successMessage = false;
$response = Auth::authFromPost();
$com=Comment::lastComme();
$ca=Cat::get($com["catId"]);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<?php if ($errorMessage = $response['error']): ?>
    <p><?= $errorMessage ?></p>
<?php endif; ?>

<?php if ($response['success']): ?>
    <p><?php header("Location: user.php");
        exit(); ?></p>
<?php endif; ?>

<?= Other::wether() ?>
<form action="" method="post">
    <p>Name:<input type="text" name="name"></p>
    <p>email:<input type="text" name="email"></p>
    <p>Password:<input type="password" name="pass"></p>
    <button type="submit" >Login</button>
    <button type="button" value="register" onClick='location.href="register.php"'>register</button>

    <p>last comment <br>
    <textarea name="textarea"
              rows="5" cols="30"
              readonly><?= 'name cat: '.$ca->cat.'.'.' comment: '.$com["comment"]?></textarea><br></p>
    <?php foreach ($users as $user): ?>
        <?php foreach ($cats as $cat) : ?>
            <?php  if ($user->id === $cat->userId): ?>
                 <?php  $comm = Comment::count($cat->id); ?>
                <?php $rating = Rating::sumRating($cat->id); ?>
                <td><input type="image" size="2" src="image/<?= $cat->userFotoCat ?>" width="250" height="250"></td>
                <br>
                User :<a href="user_cat.php?user_cats=<?= $user->id ?>"> <?= $user->user ?></a>
                Cat :<a href="cats.php?cat=<?= $cat->id ?>"> <?= $cat->cat ?></a>
                Vote:<a href="reting.php?cat_rating=<?= $cat->id ?>&rating=<?= 1 ?>"> +1</a> /
                <a href="reting.php?cat_rating=<?= $cat->id ?>&rating=<?= -1 ?>">  -1</a>
                <?=' Age cat: ' . $cat->age.'. '.' public: ' .$cat->date.'.'.'  Comment: ' .$comm.'.'.'  Rating: ' .$rating?><br>


            <?php endif; ?>
        <?php endforeach; ?><?php endforeach; ?>
</form>
</body>
</html>
