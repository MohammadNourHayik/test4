<?php
namespace Model;
use Api\user;

require_once 'DAL.php';

class M_user{
    public $ssn;
    public $name;
    protected $pass;
    public $phone;
    public $auth;
    public static function add($ssn,$name,$pass,$phone,$auth){
        $pass=password_hash($pass, PASSWORD_DEFAULT);
                $ret=DAL::simpelQuery("INSERT INTO users VALUES ($ssn,'$name','$pass','$phone','$auth')");
       return $ret ;

    }
    public function setPass($pass){
        $this->pass=password_hash($pass, PASSWORD_DEFAULT);
    }
    public function update(){
        DAL::query("UPDATE users SET name='$this->name',pass='$this->pass',phone='$this->phone' WHERE ssn=$this->ssn");
    }
    public static function login($ssn,$pass){
        $user=M_user::find($ssn);
        if($user!=null) {
            if (password_verify($pass, $user->pass)) {
                return $user;
            } else {
                return false;
            }
        }else{
            return "not_register";
        }
    }
    public static function find($ssn){
       $ret= DAL::query("SELECT * FROM users WHERE ssn=$ssn");
        if($row=$ret->fetchobject()){
            $user=new M_user();
            $user->ssn=$row->ssn;
            $user->name=$row->name;
            $user->pass=$row->pass;
            $user->phone=$row->phone;
            $user->auth=$row->auth;
            return $user;
        }else{
            return null;
        }
    }

    public static function delete($ssn){
        DAL::query("DELETE FROM users WHERE ssn=$ssn");
    }



}
?>