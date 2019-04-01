<?php


namespace Api;
use Model\M_police_officer;
use Model\M_police_station;

require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_police_station.php';


class Police_station{
public static function getAll($para){
    $ret=M_police_station::getAll($para);
    header('Content-type: application/json');
    echo json_encode($ret);
}
public static function getPoliceOfficersForPoliceStation($para){
    $ret=M_police_station::getPoliceOfficersForPoliceStation($para);
    header('Content-type: application/json');
    echo json_encode($ret);
}
public static function add($para){
    $station=new M_police_station();
    $station->branch=$para['branch'];
    $station->description=$para['description'];
    $station->address=$para['address'];
    $station->name=$para['name'];
    $station->add($para);
}

}