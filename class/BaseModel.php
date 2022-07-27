<?php
require_once'class/Auth.php';
require_once'class/Dbconnection.php';
class BaseModel
{
    protected $_isNew=true;
    protected static $tableName;

    public static function get($id)
    {
        $conn= Dbconnection::get();
        $id = $conn->real_escape_string($id);
        $table= static::$tableName;
        $query = "SELECT * FROM $table WHERE id='$id'";
        $result = $conn->query($query);
        $arrData= $result->fetch_assoc();
        $user= static::arrayToObject($arrData);
        return $user;
    }
    public static function getAll()
    {
        $conn=Dbconnection::get();
        $table= static::$tableName;
        $query="SELECT * FROM $table";
        $result = $conn->query($query);
        $user = [] ;
        $arrData = $result->fetch_assoc();
        while ($arrData){
            $user[]=static::arrayToObject($arrData);
            $arrData= $result->fetch_assoc();
        }
        return $user;

    }

    protected static function arrayToObject($data)
    {

        $entity= new static();
        foreach ($data as $key=>$value){
            $entity->$key=$value;
        }
        $entity->_isNew=false;
        return $entity;

    }
    public static function delete()
    {
        if (isset( $_POST['delete']))
        {$delete = $_POST['delete'];
        $conn= Dbconnection::get();
        $table= static::$tableName;
        $query="DELETE FROM $table WHERE id='$delete'";
        $result = $conn->query($query);
        return $result;}

    }
}