<?php
namespace Model;
class DAL{
    /*private $server="192.168.1.23";
    private $user="root";
    private $db="shift";
    private $password="";*/

    public static function query($sqlString){
       $conn = new \PDO('mysql:host=localhost;dbname=mypolicedb', "root","");
        $result = $conn->prepare($sqlString);
        $result->execute();

        if (strpos($sqlString, 'INSERT') !== false) {
            return($conn->lastInsertId());
        }else{
            return($result);
        }

    }
    public static function simpelQuery($sqlString)
    {
        $conn = new \PDO('mysql:host=localhost;dbname=mypolicedb', "root","");
        $result = $conn->prepare($sqlString);
        $result->execute();
        return($result);
    }

}
?>