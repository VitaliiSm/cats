<?php
require_once 'main.php';
$user = User::getAll();
$cats =Cat::getAll();
$user= User::getCurrUser();
$curruser=user::getCurrUser();
$currCat = $_GET["cat"];
if (!empty($_POST['comment'])) {
    Comment::commentNew();}
$com= Comment::getAll();
Comment::delete();


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <?php foreach ($cats as $cat) : ?>
        <?php if ($cat->id === $currCat): ?>
            <td><input type="image" size="2" src="image/<?= $cat->userFotoCat ?>" width="250" height="250"></td>
            <br>
            <?='Name cat: ' . $cat->cat.'.' . ' Age cat: ' . $cat->age.'.' . ' description: ' .$cat->description?><br>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php foreach ($com as $comment) : ?>
        <?php  if (($_GET['cat'] === $comment->catId)): ?><br>
            <?php  echo 'Name: ' . $comment->userName.'. '. 'Comment:   ' .$comment->comment ; ?>
           <?php if($user->id === $comment->userId ):?>
                <br>  <button name="delete" type="submit" value="<?= $comment->id ?>"'>delete</button>
        <?php endif; ?>
     <?php endif; ?><?php endforeach; ?>
    <br> <label for="story">Write your comment:</label><br>
        <textarea id="story" name="comment"
                  rows="5" cols="33">
</textarea><br>
        <button type="submit"  onClick='location.href="cats.php"'>add comment</button>

    <button type="button" value="back" onClick='location.href="index.php"'>back</button>
    </form>
</body>
</html>
