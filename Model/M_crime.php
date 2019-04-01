<?php

namespace Model;

require_once 'DAL.php';
require_once 'M_incident.php';
require_once 'M_victim.php';
require_once 'M_criminal.php';
class M_crime extends M_incident {
    public $id;
    public $incident_id;
    public $criminal;
    public $victim;
    public function __construct()
    {
        $this->victim=new M_victim();
         $this->criminal=new M_criminal();
    }
    public function getByIncidentId(){
        $ret= DAL::query("SELECT * FROM incident WHERE id=$this->incident_id");
        if($row=$ret->fetchobject()){
            $this->details=$row->details;
            $this->locationx=$row->locationx;
            $this->locationy=$row->locationy;
            $this->location=$row->location;
            $this->type=$row->type;
            $this->dateTime=$row->date_time;
            $this->user_ssn=$row->user_ssn;
            $ret= DAL::query("SELECT * FROM crime WHERE incident_id=$this->incident_id");
            if($row=$ret->fetchobject()){
                $this->id=$row->id;
                $criminal= new M_criminal();
                $criminal->id=$row->criminal_id;
                $criminal->getById();
                $this->criminal=$criminal;

                $victim= new M_victim();
                $victim->id=$row->victim_id;
                $victim->getById();
                $this->victim=$victim;
            }
        }else{
            return null;
        }
    }
    public function add(){
        $criminal_id=$this->criminal->add();
        $victim_id=$this->victim->add();
        $incident_id= DAL::query("INSERT INTO incident VALUES (NULL ,0,'$this->details','$this->locationx','$this->locationy','$this->location','$this->type',str_to_date('$this->dateTime','%d-%m-%Y %H:%i:%S'),'$this->user_ssn',0)");
        $ret= DAL::query("INSERT INTO crime VALUES (NULL ,'$incident_id','$criminal_id','$victim_id')");
        $arr['incident_id']=$incident_id;
        $arr['criminal_id']=$criminal_id;
        return $arr;



    }



}