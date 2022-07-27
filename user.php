<?php
require_once 'main.php';
$currUser = User::getCurrUser();
$message = Cat::uploadsFoto();
Cat::userCat();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>
<body>

<?php if($currUser):?>
    <p>Hello...<?=$currUser->user?></p>
<?php endif;?>
<?php if($message['success'] == true):?>
    <p>Done</p>
<?php endif;?>
<?php if($message['error'] == true):?>
    <p>Error</p>
<?php endif;?>
<form method="post" enctype="multipart/form-data">
    <p>foto cat
        <input type="file" name="uploads[]" /><br /></p>
    <input type="text" name="cat" placeholder="name cat">
    <input type="text" name="age" placeholder="age cat">
    <input type="text" name="description" placeholder="description">
    <br>
    <button type="submit">add</button>
    <button type="button" value="user_list" onClick='location.href="list_cat.php"'>list cats</button>
    <button type="button" value="user_list" onClick='location.href="edit_user.php?user_id=<?= $currUser->id ?>"'>edit profile</button>
</form>

</body>
</html>