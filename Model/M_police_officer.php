<?php
/**
 * Created by PhpStorm.
 * User: Nour
 * Date: 25/12/2017
 * Time: 03:32 ص
 */

namespace Model;

use Api\Response;

require_once 'DAL.php';
require_once 'M_police_station.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/police/Api/Response.php';

class M_police_officer
{
    public $user_id;
    public $ssn;
    public $police_station_id;

    public static function getBySsn($para)
    {


        $login=M_user::login($para['ssnAdmin'],$para['passAdmin']);
        if($login!=null) {
            if ($login->auth == "Admin") {
                $ssn=$para['ssn'];
                $arr = new Response();
                $ret = DAL::query("SELECT users.ssn,users.name,users.phone,police_station.name  as  police_station_name FROM users INNER JOIN police_officer ON  police_officer.ssn=users.ssn INNER JOIN  police_station ON police_station.id=police_officer.police_station_id WHERE users.ssn=$ssn");
                if ($row = $ret->fetchobject()) {
                    $arr->Response[]=$row;
                    return $arr;
                }
            } else {
                return false;
            }
        }else{
            return false;
        }



    }
    public function add(){

                $ret=DAL::query("INSERT INTO police_officer VALUES (NULL ,'$this->ssn','$this->police_station_id')");
                return $ret;

    }

    public function update($para){
        $login=M_user::login($para['ssnAdmin'],$para['passAdmin']);
        if($login!=null) {
            if ($login->auth == "Admin") {
                $ret=DAL::query("");
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    public static function delete($ssn){
        DAL::query("DELETE FROM police_officer WHERE ssn=$ssn");
        M_user::delete($ssn);
    }

    public static function getPoliceStationForPoliceOfficer($id){
       $ret= DAL::query("SELECT police_station_id FROM police_officer WHERE ssn=$id");
        if ($row = $ret->fetchObject()) {
            return $row->police_station_id;
        }


    }




}
