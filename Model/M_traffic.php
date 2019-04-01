<?php


namespace Model;

require_once 'DAL.php';
require_once 'M_incident.php';
class M_traffic extends M_incident {
    public $id;
    public $incident_id;
    public function getByIncidentId(){
        $ret= DAL::query("SELECT * FROM incident WHERE id=$this->incident_id");
        if($row=$ret->fetchobject()){
            $this->incident_id=$row->incident_id;
            $this->code=$row->code;
            $this->details=$row->details;
            $this->locationx=$row->locationx;
            $this->locationy=$row->locationy;
            $this->location=$row->location;
            $this->type=$row->type;
            $this->dateTime=$row->dateTime;
            $this->num_of_taken=$row->num_of_taken;
            $this->user_ssn=$row->user_ssn;
        }else{
            return null;
        }
    }
    public function add(){
        $ret= DAL::query("INSERT INTO incident VALUES (NULL ,0,'$this->details','$this->locationx','$this->locationy','$this->location','$this->type',str_to_date('$this->dateTime','%d-%m-%Y %H:%i:%S'),'$this->user_ssn',0)");
        $ret=  DAL::query("INSERT INTO traffic VALUES (NULL ,'$ret')");
        return $ret;
    }



}