<?php
/**
 * Created by PhpStorm.
 * User: Nour
 * Date: 25/12/2017
 * Time: 03:11 ص
 */

namespace Model;

require_once 'DAL.php';
require_once 'M_incident.php';
require_once 'M_police_officer.php';

class M_criminal
{
    public $id;
    public $name;
    public $details;
    public $gender;
    public $police=array();

    public function getById()
    {
        $ret = DAL::query("SELECT * FROM criminal WHERE id=$this->id");
        if ($row = $ret->fetchobject()) {
            $this->name = $row->name;
            $this->details = $row->details;
            $this->gender = $row->gender;
            $ret = DAL::query("SELECT * FROM criminal_police WHERE criminal_id=$this->id");
            while ($row=$ret->fetchObject()){
                $police_officer=new M_police_officer();
                $police_officer->id=$row->police_id;
                $this->police[]=$police_officer;
            }


        }

    }
    public function add(){
        $ret= DAL::query("INSERT INTO criminal VALUES (NULL ,'$this->name','$this->details','$this->gender')");
        return $ret;
    }

}
