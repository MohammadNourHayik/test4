<?php
/**
 * Created by PhpStorm.
 * User: Nour
 * Date: 25/12/2017
 * Time: 05:06 ص
 */

namespace Model;
require_once 'DAL.php';
require_once 'M_incident.php';

class M_losts extends M_incident{
    public $id;
    public $typeLost;
    public $incident_id;
    public $theft;
    public function getByIncidentId(){
        $ret= DAL::query("SELECT * FROM incident WHERE id=$this->incident_id");
        if($row=$ret->fetchobject()){
            $this->details=$row->details;
            $this->locationx=$row->locationx;
            $this->locationy=$row->locationy;
            $this->location=$row->location;
            $this->type=$row->type;
            $this->dateTime=$row->dateTime;
            $this->user_ssn=$row->user_ssn;
            $this->type=$row->type;
        }else{
            return null;
        }
    }
    public function add(){
        $ret= DAL::query("INSERT INTO incident VALUES (NULL ,0,'$this->details','$this->locationx','$this->locationy','$this->location','$this->type',str_to_date('$this->dateTime','%d-%m-%Y %H:%i:%S'),'$this->user_ssn',0)");
        $ret1=  DAL::query("INSERT INTO losts VALUES (NULL ,'$this->typeLost','$ret',$this->theft)");
        return $ret1;

    }


}