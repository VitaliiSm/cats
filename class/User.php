<?php
require_once 'class/BaseModel.php';
require_once 'class/Cat.php';
class User extends BaseModel
{
    public $id;
    public $user;
    public $email;
    public $pass;
    public $auth_token;
    public $date;

    protected static $tableName='user';

    public static function getCurrUser()
    {
        if (!isset($_COOKIE['auth_token'])) {
            return false;
        } else {
            $token = $_COOKIE['auth_token'];
            $users = self::getAll();
            $isUserFound = false;
            foreach ($users as $user) {
                if ($user->auth_token === $token) {
                    $isUserFound = true;
                    return $user;
                }
            }
            if (!$isUserFound) {
                return false;
            }
        }
    }
    public function save()
    {
        $conn= Dbconnection::get();
        $table = static::$tableName;
            $query="INSERT INTO $table (user, email, pass, auth_token)
                VALUES ('$this->user','$this->email','$this->pass','$this->auth_token')";
            $result= $conn->query($query);
            return $result;
        }

        public function update()
    {
        $conn= Dbconnection::get();
        $table = static::$tableName;
            $query= "UPDATE $table SET user='$this->user',
                                    email='$this->email',
                                   pass='$this->pass',
                                    auth_token='$this->auth_token'
                                        WHERE id= $this->id";
            $result=$conn->query($query);
            return $result;
        }

    public static function getCatById($catId)
    {
        $currUser = User::getCurrUser();

        $cats = Cat::getAll();
        foreach ($cats as $cat) {
            if ($cat->id === $catId && $currUser->id === $cat->userId
            ) {
                return $cat;
            }
        }
        return null;
    }
}