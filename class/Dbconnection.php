<?php
class Dbconnection
{
    private static  $_connection = false;

    public static function get()
    {
        if (!self::$_connection){
            self::$_connection = new mysqli('localhost','root','', 'cat');
        }
     return self::$_connection;
    }
}

