<?php


namespace Api;
use Model\DAL;
use Model\M_theft;

require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_theft.php';

class Theft{
    public static function create($para){
        $theft=new M_theft();
        $theft->locationx=$para['locationx'];
        $theft->locationy=$para['locationy'];
        $theft->location=$para['location'];
        $theft->type=$para['type'];
        $theft->dateTime=$para['dateTime'];
        $theft->user_ssn=$para['userSsn'];
        $theft->threat=$para['threat'];
        $theft->gender=$para['gender'];
        $theft->details=$para['details'];
        $theft->under_threat=$para['under_threat'];
       $id=$theft->add();
        $ret = DAL::query('SELECT incident_id FROM theft WHERE id='.$id);
        if ($row = $ret->fetchObject()) {
            $arr=array("incident_id"=>$row->incident_id);
            header('Content-type: application/json');
            echo json_encode($arr);
        }


    }

}