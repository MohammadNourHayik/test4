<?php
/**
 * Created by PhpStorm.
 * User: Nour
 * Date: 31/12/2017
 * Time: 09:54 م
 */

namespace Api;


use Model\M_police_officer;
use Model\M_user;
require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_police_officer.php';


class Police_officer
{

    public static function add($para){
        $login=M_user::login($para['ssnAdmin'],$para['passAdmin']);
        if($login!=null) {
            if ($login->auth == "Admin") {
        $officer=new M_police_officer();
        $officer->police_station_id=$para['police_station_id'];
        $officer->ssn=$para['ssn'];
        $officer->add();
        M_user::add($para['ssn'],$para['name'],$para['pass'],$para['phone'],"Police_officer");
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    public static function getById($para){
        $ret= M_police_officer::getBySsn($para);
        header('Content-type: application/json');
        echo json_encode($ret);
    }
    public static function update($para){
        $login=M_user::login($para['ssnAdmin'],$para['passAdmin']);
        if($login!=null) {
            if ($login->auth == "Admin") {
                $user=new M_user();
                $user->ssn=$para['ssn'];
                $user->name=$para['name'];
                $user->phone=$para['phone'];
                $user->setPass($para['pass']);
                $user->update();
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    public static function delete($para){

        $login=M_user::login($para['ssnAdmin'],$para['passAdmin']);
        if($login!=null) {
            if ($login->auth == "Admin") {
              M_police_officer::delete($para['ssn']);
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}