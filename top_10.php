<?php
require_once 'main.php';
$users= User::getAll();
$cats= Cat::getAll();
$com=Comment::lastComme();
$ca=Cat::get($com["catId"]);
$top = Rating::top10();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php foreach ($top as $top10) : ?>
<?php foreach ($users as $user): ?>
    <?php foreach ($cats as $cat) : ?>
                <?php  if ($top10->id_cat === $cat->id): ?>
            <?php  if ($user->id === $cat->userId): ?>
                    <?php  $comm = Comment::count($cat->id); ?>
                    <?php $rating = Rating::sumRating($cat->id); ?>
                    <td><input type="image" size="2" src="image/<?= $cat->userFotoCat ?>" width="250" height="250"></td>
                    <br>
                    User :<a href="user_cat.php?user_cats=<?= $user->id ?>"> <?= $user->user ?></a>
                    Cat :<a href="cats.php?cat=<?= $cat->id ?>"> <?= $cat->cat ?></a>
                    Vote:<a href="reting.php?cat_rating=<?= $cat->id ?>&rating=<?= 1 ?>"> +1</a> /
                    <a href="reting.php?cat_rating=<?= $cat->id ?>&rating=<?= -1 ?>"> -1</a>
                    <?=' Age cat: ' . $cat->age . '. ' . ' public: ' . $cat->date . '.' . '  Comment: ' . $comm . '.' . '  Rating: ' . $rating?>
                    <br>


                <?php endif?><?php endif?>
            <?php endforeach?><?php endforeach?><?php endforeach?>
</form>
</body>
</html>
