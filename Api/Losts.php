<?php
/**
 * Created by PhpStorm.
 * User: Nour
 * Date: 25/12/2017
 * Time: 11:45 م
 */

namespace Api;

use Model\DAL;
use Model\M_losts;

require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_losts.php';

class Losts
{
    public static function create($para)
    {
        $losts = new M_losts();
        $losts->locationx = $para['locationx'];
        $losts->locationy = $para['locationy'];
        $losts->location = $para['location'];
        $losts->type = $para['type'];
        $losts->typeLost = $para['typeLost'];
        $losts->dateTime = $para['dateTime'];
        $losts->user_ssn = $para['userSsn'];
        $losts->details = $para['details'];
        $losts->theft = $para['theft'];
        $id = $losts->add();
        $ret = DAL::query('SELECT incident_id FROM losts WHERE id='.$id);
        if ($row = $ret->fetchObject()) {
            $arr=array("incident_id"=>$row->incident_id);
            header('Content-type: application/json');
            echo json_encode($arr);
        }



    }
}