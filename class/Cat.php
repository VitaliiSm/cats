<?php
require_once 'class/BaseModel.php';
require_once 'class/User.php';
class Cat extends BaseModel
{
    public $id;
    public $cat;
    public $age;
    public $description;
    public $userFotoCat;
    public $userId;
    public $date;

    protected static $tableName = 'cat';

    public static function userCat()
    {
        if (!empty($_POST["cat"]) && !empty($_POST["age"]) && !empty($_POST["description"])) {
            $currUser = User::getCurrUser();
            $name = $_POST["cat"];
            $age = $_POST["age"];
            $userFotoCat = self::uploadsFoto();
            $userFotoCat = $userFotoCat['name'];
            $description = $_POST["description"];
            $cat = new Cat();
                $cat->cat = $name;
               $cat->age = $age;
              $cat->description = $description;
               $cat->userId = $currUser->id;
              $cat->userFotoCat = $userFotoCat;

            $cat->save();
        }
    }
    public static function uploadsFoto()
    {
        $response = [
            'success' => false,
            'error' => false,
            'name' => ''
        ];
        if (!empty($_POST["cat"]) && !empty($_POST["age"]) && !empty($_POST["description"])) {
            foreach ($_FILES["uploads"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["uploads"]["tmp_name"][$key];
                    $name = $_FILES["uploads"]["name"][$key];
                    $response['name'] = $name;
                    $fileNameCmps = explode(".", $name);
                    $fileExtension = strtolower(end($fileNameCmps));
                    $allowedfileExtensions = array('jpg', 'gif', 'png');

                    if (in_array($fileExtension, $allowedfileExtensions)) {
                        move_uploaded_file($tmp_name, "image/$name");
                        $response ['success'] = true;
                    } else {
                        $response ['error'] = true;
                    }


                }
            }

        }
return $response;
    }
    public function save()
    {
        $conn = Dbconnection::get();
        $table = static::$tableName;
            $query = "INSERT INTO $table (cat, age,description,userFotoCat,userId)
                VALUES ('$this->cat','$this->age','$this->description','$this->userFotoCat','$this->userId')";
            $result = $conn->query($query);
            return $result;
    }
       public function update()
    {
        $conn = Dbconnection::get();
        $table = static::$tableName;
        $query = "UPDATE $table SET cat='$this->cat',
                                   age='$this->age',
                                    description='$this->description',
                                    userFotoCat='$this->userFotoCat'
                                        WHERE id= $this->id";
        $result = $conn->query($query);
            return $result;
        }



}