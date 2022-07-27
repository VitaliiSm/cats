<?php
require_once'class/Dbconnection.php';
require_once'class/BaseModel.php';
class Rating extends BaseModel
{
    public $id_user;
    public $id_cat;
    public $rating;

    protected static $tableName = 'rating';

    public function save()
    {

        $conn = Dbconnection::get();
        $table = self::$tableName;
        $query = "INSERT INTO $table (id_user,id_cat,rating)
                VALUES ('$this->id_user','$this->id_cat','$this->rating')";
        $result = $conn->query($query);
        return $result;

    }

    public static function userRating()

    {
        $user = User::getCurrUser();
        $conn = Dbconnection::get();
        $table = self::$tableName;
        $query = "SELECT id_user FROM $table WHERE id_user='$user->id'";
        $result = $conn->query($query);
        $arrData = $result->fetch_assoc();
        if (!empty($arrData["id_user"])){
        return $arrData["id_user"];}
    }
    public static function update($ret,$currCat)
    {
        $currating=self::userRating();
        $conn= Dbconnection::get();
        $table = static::$tableName;
        $query= "UPDATE $table SET rating=$ret,
                                    id_cat=$currCat
                                        WHERE id_user= $currating";
        $result=$conn->query($query);
        return $result;
    }
    public static function curRating($cat)

    {
        $user = User::getCurrUser();
        $conn = Dbconnection::get();
        $table = self::$tableName;
        $query = "SELECT rating FROM $table WHERE id_user='$user->id'AND id_cat=$cat";
        $result = $conn->query($query);
        $arrData = $result->fetch_assoc();
         if (!empty($arrData["rating"])){
            return $arrData["rating"];}
    }
    public static function sumRating($catId)

    {
        $conn = Dbconnection::get();
        $table = self::$tableName;
        $query = "select sum(rating) from $table where id_cat= $catId ;";
        $result = $conn->query($query);
        $arrData = $result->fetch_assoc();
        if (!empty($arrData["sum(rating)"])) {
            return $arrData["sum(rating)"];}

    }
    public static function top10()
    {
        $conn=Dbconnection::get();
        $table= self::$tableName;
        $query="select id_cat, sum(rating)from $table group by id_cat limit 10";
        $result = $conn->query($query);
        $rating = [] ;
        $arrData = $result->fetch_assoc();
        while ($arrData){
            $rating[]=static::arrayToObject($arrData);
            $arrData= $result->fetch_assoc();
        }
        return $rating;

    }
}