<?php
/**
 * Created by PhpStorm.
 * User: Nour
 * Date: 26/12/2017
 * Time: 12:40 ص
 */

namespace Api;

use Model\DAL;
use Model\M_traffic;

require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_traffic.php';
class Traffic
{
    public static function create($para){
        $traffic=new M_traffic();
        $traffic->locationx=$para['locationx'];
        $traffic->locationy=$para['locationy'];
        $traffic->location=$para['location'];
        $traffic->type=$para['type'];
        $traffic->dateTime=$para['dateTime'];
        $traffic->user_ssn=$para['userSsn'];
        $traffic->details=$para['details'];
        $id= $traffic->add();
        $ret = DAL::query('SELECT incident_id FROM traffic WHERE id='.$id);
        if ($row = $ret->fetchObject()) {
            $arr=array("incident_id"=>$row->incident_id);
            header('Content-type: application/json');
            echo json_encode($arr);
        }


    }
}