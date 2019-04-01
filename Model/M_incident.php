<?php
namespace Model;
use Api\Police_officer;
use Api\Response;
use Model\M_crime;

require_once 'DAL.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/police/Api/Response.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_crime.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/Image_upload.php';

abstract class  M_incident{
    public $id;
    public $police_station_id;
    public $details;
    public $locationx;
    public $locationy;
    public $location;
    public $type;
    public $dateTime;
    public $user_ssn;
    public abstract function add();
    public abstract function getByIncidentId();
    public static function getAllIncidentForAdmin($para){
        $login=M_user::login($para['ssn'],$para['pass']);
        if($login!=null) {
            if ($login->auth == "Admin") {
                $ret = DAL::query("SELECT id,type FROM incident WHERE police_station_id=0 ORDER BY `date_time` DESC");
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
    public static function findIncident($para){
        $login=M_user::login($para['ssn'],$para['pass']);
        if($login!=null) {
            if ($login->auth == "Admin") {
                $id=$para['id'];
                $ret = DAL::query("SELECT * FROM incident WHERE id=$id");
                $arr = array();
               if ($row = $ret->fetchObject()) {
                   $photos=array();
                   $ret=getPhotoForIncidentById($id);
                   while ($row2=$ret->fetchObject()){
                       $photos[]=$row2->photo;
                   }
                   $row->photos=$photos;
                    $arr["Response"]= $row;
                }

                return $arr;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    public static function addIncidentToPoliceStation($para){
        $login=M_user::login($para['ssn'],$para['pass']);
        if($login!=null) {
            if ($login->auth == "Admin") {
                $idIncident=$para['idIncident'];
                $idPoliceStation=$para['idPoliceStation'];
                 DAL::query("UPDATE incident SET police_station_id=$idPoliceStation WHERE id=$idIncident");
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    public static function getAllIncidentForPoliceStation($para){
        $login=M_user::login($para['ssnPolice'],$para['passPolice']);
        if($login!=null) {
            if ($login->auth == "Police_officer") {
                $idPoliceStation=M_police_officer::getPoliceStationForPoliceOfficer($para['ssnPolice']);
                $ret=DAL::query("SELECT id,type,police_station_id,user_ssn,police_ssn FROM incident WHERE police_station_id=$idPoliceStation and police_ssn=0" );
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
    public static function getAllInfoForIncidentByIncidentId($para){

        $login=M_user::login($para['ssnPolice'],$para['passPolice']);
        if($login!=null) {
            if ($login->auth == "Police_officer") {
                $arr = array();
                switch ($para['type']){
                    case "crime":
                        $crime=new M_crime();
                        $crime->incident_id=$para['incidentId'];
                        $crime->getByIncidentId();
                        $arr = new Response();


                        $photos=array();
                        $ret=getPhotoForIncidentById($para['incidentId']);
                        while ($row2=$ret->fetchObject()){
                            $photos[]=$row2->photo;
                        }
                        $crime->photos=$photos;
                        $arr->Response[]=$crime;
                        break;
                    case "Traffic":


                                $policeId=$para['ssnPolice'];
                                $policeOffec=DAL::query("SELECT police_station_id FROM police_officer WHERE ssn=$policeId");
                                $policeStation="";
                                if($row=$policeOffec->fetchObject()){
                                    $policeStation=$row->police_station_id;
                                }
                                $id=$para['incidentId'];
                                $ret = DAL::query("SELECT id,details,locationx,locationy,location,date_time,user_ssn FROM incident WHERE id=$id AND police_station_id=$policeStation");

                                if ($row = $ret->fetchObject()) {
                                    $photos=array();
                                    $ret=getPhotoForIncidentById($id);
                                    while ($row2=$ret->fetchObject()){
                                        $photos[]=$row2->photo;
                                    }
                                    $row->photos=$photos;
                                    $arr["Response"]= $row;
                                }

                                return $arr;

                    case "LostObjects":

                            $policeId=$para['ssnPolice'];
                            $policeOffec=DAL::query("SELECT police_station_id FROM police_officer WHERE ssn=$policeId");
                            $policeStation="";
                            if($row=$policeOffec->fetchObject()){
                                $policeStation=$row->police_station_id;
                            }
                            $id=$para['incidentId'];
                            $ret = DAL::query("SELECT i.id,i.details,i.locationx,i.locationy,i.location,i.date_time,i.user_ssn ,l.type,l.theft FROM incident i INNER JOIN losts l ON l.incident_id=i.id WHERE i.id=$id AND i.police_station_id=$policeStation");

                            if ($row = $ret->fetchObject()) {
                                $photos=array();
                                $ret=getPhotoForIncidentById($id);
                                while ($row2=$ret->fetchObject()){
                                    $photos[]=$row2->photo;
                                }
                                $row->photos=$photos;
                                $arr["Response"]= $row;
                            }

                            return $arr;
                    break;
                    case "threat":

                                $policeId=$para['ssnPolice'];
                                $policeOffec=DAL::query("SELECT police_station_id FROM police_officer WHERE ssn=$policeId");
                                $policeStation="";
                                if($row=$policeOffec->fetchObject()){
                                    $policeStation=$row->police_station_id;
                                }
                                $id=$para['incidentId'];
                                $ret = DAL::query("SELECT i.id,i.details,i.locationx,i.locationy,i.location,i.date_time,i.user_ssn ,t.threat,t.gender,t.under_threat FROM incident i INNER JOIN theft t ON t.incident_id=i.id WHERE i.id=$id AND i.police_station_id=$policeStation");

                                if ($row = $ret->fetchObject()) {
                                    $photos=array();
                                    $ret=getPhotoForIncidentById($id);
                                    while ($row2=$ret->fetchObject()){
                                        $photos[]=$row2->photo;
                                    }
                                    $row->photos=$photos;
                                    $arr["Response"]= $row;
                                }

                                return $arr;

                        break;
                }

                return $arr;




                }
            } else {
                return false;
            }

    }
    public static function addPoliceOfficerToIncident($para){
        $login=M_user::login($para['ssnPolice'],$para['passPolice']);
        if($login!=null) {
            if ($login->auth == "Police_officer") {
                $ssnPolice=$para['ssnPolice'];
                $incidentId=$para['incidentId'];
                DAL::query("UPDATE incident SET police_ssn=$ssnPolice WHERE id=$incidentId");
            } else {
                return false;
            }
        }else{
            return false;
        }

    }
    public static function AdminRejectIncidentById($para){
        $login=M_user::login($para['ssnAdmin'],$para['passAdmin']);
        if($login!=null) {
            if ($login->auth == "Admin") {
                $id=$para['incidentId'];
                DAL::query("DELETE FROM incident WHERE id=$id");
                $ret=DAL::query("SELECT criminal_id,victim_id FROM crime WHERE incident_id=$id");

                if($row=$ret->fetchObject()){
                    $criminalId=$row->criminal_id;
                    DAL::query("DELETE FROM criminal WHERE id=$criminalId");
                    $victimId=$row->victim_id;
                    DAL::query("DELETE FROM victim WHERE id=$victimId");
                }

                DAL::query("DELETE FROM crime WHERE incident_id=$id");
                DAL::query("DELETE FROM losts WHERE incident_id=$id");
                DAL::query("DELETE FROM theft WHERE incident_id=$id");
                DAL::query("DELETE FROM traffic WHERE incident_id=$id");
                DAL::query("DELETE FROM photo WHERE incident_id=$id");


            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    public static function FilterIncident($para)
    {
        $login = M_user::login($para['ssnPolice'], $para['passPolice']);
        if ($login != null) {
            if ($login->auth == "Police_officer") {
                $arr = array();
                $q="SELECT id,type,police_station_id,user_ssn,police_ssn FROM incident WHERE police_station_id<>0";
                switch ($para['filterType']) {
                    case "crime":
                        $q=$q." AND type='crime'";
                        break;
                    case "Traffic":
                        $q=$q." AND type='Traffic'";
                        break;
                    case "LostObjects":
                        $q=$q." AND type='LostObjects'";
                        break;
                    case "threat":
                        $q=$q." AND type='threat'";
                        break;
                    case "accepted":
                        $q=$q." AND police_ssn<>0";
                        break;
                }

                $ret = DAL::query($q);
                $arr = new Response();
                while ($row = $ret->fetchObject()) {
                    $arr->Response[] = $row;
                }
                return $arr;
            } else {
                return false;
            }
        }

    }


}
?>