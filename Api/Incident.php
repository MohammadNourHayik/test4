<?php
namespace Api;
use Model\M_incident;
use Model\M_user;

require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_incident.php';


class Incident{
    public static function getAllIncidentForAdmin($para){
        $ret=M_incident::getAllIncidentForAdmin($para);
        header('Content-type: application/json');
        echo json_encode($ret);
    }
    public static function findIncident($para){
        $ret= M_incident::findIncident($para);
        header('Content-type: application/json');
        echo json_encode($ret);
    }
    public static function addIncidentToPoliceStation($para){
        M_incident::addIncidentToPoliceStation($para);
    }
    public static function getAllIncidentForPoliceStation($para){
        $ret= M_incident::getAllIncidentForPoliceStation($para);
        header('Content-type: application/json');
        echo json_encode($ret);
    }
    public static function getAllInfoForIncidentByIncidentId($para){
        $ret=M_incident::getAllInfoForIncidentByIncidentId($para);
        header('Content-type: application/json');
        echo json_encode($ret);
    }
    public static function addPoliceOfficerToIncident($para){
        M_incident::addPoliceOfficerToIncident($para);
    }
    public  static  function AdminRejectIncidentById($para){
        M_incident::AdminRejectIncidentById($para);
    }
    public static function findIncidentForPoliceOffecer($para){
        $ret=M_incident::findIncidentForPoliceOffecer($para);
        header('Content-type: application/json');
        echo json_encode($ret);
    }
    public static function FilterIncident($para){
        $ret=M_incident::FilterIncident($para);
        header('Content-type: application/json');
        echo json_encode($ret);
    }
}
?>