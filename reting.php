<?php
require_once 'main.php';
require_once 'class/Rating.php';
$user = User::getCurrUser();
$currCat = $_GET["cat_rating"];
$rati = $_GET["rating"];
$userRating=Rating::userRating();
$curRating = Rating::curRating($currCat);
$allRatings= Rating::getAll();
foreach ($allRatings as $ratin){
if($curRating===$rati&&$ratin->id_cat===$currCat){
    $rati = 0;
}
}
if ($userRating !== $user->id){
        $rating = new rating();
        $rating->id_user = $user->id;
        $rating->id_cat = $currCat;
            $rating->rating = $rati;
            $rating->save();
            header("Location: index.php");
    }
else{Rating::update($rati,$currCat); header("Location: index.php");}





