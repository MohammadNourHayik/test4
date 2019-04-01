<?php
namespace Api;
use Model\M_user;

require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_user.php';

class user{

public static function create($para){
   $ret= M_user::add($para['ssn'],$para['name'],$para['pass'],$para['phone'],"citizen");
   $state=1;

   if($ret->errorCode()==23000){
       $state=0;
   }
    $ret=array('state'=>$state);
    header('Content-type: application/json');
    echo json_encode($ret);

    }
    public static function update($para){
    $user=new M_user();
    $user->ssn=$para['ssn'];
    $user->name=$para['name'];
    $user->phone=$para['phone'];
    $user->setPass($para['pass']);
    $user->update();
}

public static function login($para){
        $ret=M_user::login($para['ssn'],$para['pass']);
        if($ret!=false && $ret!="not_register"){
            $ret=array('state'=>"register",'ssn'=>$ret->ssn,'auth'=>$ret->auth);
        }else{
            if($ret==false) {
                $ret = array('state' => "error_password");
            }else{
                $ret = array('state' => $ret);
            }
        }
    header('Content-type: application/json');
    echo json_encode($ret);
}

}
?>