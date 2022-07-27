<?php
require_once'class/Dbconnection.php';
require_once'class/BaseModel.php';
class  Comment  extends BaseModel
{
    protected static $tableName = 'comment';
    public $id;
    public $comment;
    public $userName;
    public $userId;
    public $catId;
    public $date;

    public function save()
    {

        $conn = Dbconnection::get();
        $table = 'comment';
        $query = "INSERT INTO $table (comment,userName,userId,catId)
                VALUES ('$this->comment','$this->userName','$this->userId','$this->catId')";
        $result = $conn->query($query);
        return $result;

    }

    public static function commentNew()
    {
        $currCat = $_GET["cat"];
        $user = User::getCurrUser();
        if (!empty($_POST['comment'])) {
            $comment = new Comment();
            $comment->comment = $_POST['comment'];
            $comment->userName = $user->user;
            $comment->userId = $user->id;
            $comment->catId = $currCat;
            $comment->save();
        }
    }

    public static function count($catId)
    {
        $conn = Dbconnection::get();
        //$id = $conn->real_escape_string($userId);
        $table = self::$tableName;
        $query = "SELECT count(userId) FROM $table WHERE catId='$catId'";
        $result = $conn->query($query);
        $arrData = $result->fetch_assoc();
        return (int)array_values($arrData)[0];
    }
    public static function lastComme()
    {
        $conn = Dbconnection::get();
        $table = self::$tableName;
        $query = "SELECT * FROM $table ORDER BY `date` DESC limit 3";
        $result = $conn->query($query);
        $arrData = $result->fetch_assoc();

        return $arrData;
    }
}
