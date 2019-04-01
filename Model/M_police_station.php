<?php
namespace Model;
use Api\Response;

require_once 'DAL.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/police/Api/Response.php';
require_once 'M_user.php';



class M_police_station
{
    public $id;
    public $name;
    public $branch;
    public $address;
    public $description;
    public function getById()
    {
        $ret = DAL::query("SELECT * FROM police_station WHERE id=$this->id");
        if ($row = $ret->fetchobject()) {
            $this->name = $row->name;
            $this->branch = $row->branch;
            $this->address = $row->address;
            $this->description = $row->description;
        }
    }
    public static function getAll($para)
    {
        $login=M_user::login($para['ssn'],$para['pass']);
        if($login!=null) {
            if ($login->auth == "Admin") {
                $ret = DAL::query("SELECT * FROM police_station");
                $arr = new Response();
                while ($row = $ret->fetchObject()) {
                    $arr->Response[] = $row;
                }
                return $arr;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    public  function add($para){

        $login=M_user::login($para['ssn'],$para['pass']);
        if($login!=null) {
            if ($login->auth == "Admin") {
                $ret=DAL::query("INSERT INTO police_station VALUES (NULL ,'$this->name','$this->branch','$this->address','$this->description')");

            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    public function getPoliceOfficersForPoliceStation($para){
        $login=M_user::login($para['ssn'],$para['pass']);
        if($login!=null) {
            if ($login->auth == "Admin") {
                $policeStationId=$para['id'];
                $ret=DAL::query("SELECT users.name,users.ssn FROM users INNER JOIN police_officer ON police_officer.ssn=users.ssn WHERE police_officer.police_station_id=$policeStationId");
                $arr = new Response();
                while ($row = $ret->fetchObject()) {
                    $arr->Response[] = $row;
                }
                return $arr;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}