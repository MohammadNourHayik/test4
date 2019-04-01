<?php
/**
 * Created by PhpStorm.
 * User: Nour
 * Date: 25/12/2017
 * Time: 03:59 ص
 */

namespace Model;

require_once 'DAL.php';
class M_victim{
    public $id;
    public $gender;
    public $details;
    public $name;
    public function addToExistCrime($incident_id,$criminal_id){
        $victim_id= DAL::query("INSERT INTO victim VALUES (NULL ,'$this->gender','$this->details','$this->name')");
        $ret= DAL::query("INSERT INTO crime VALUES (NULL ,'$incident_id','$criminal_id','$victim_id')");
        return $ret;
    }
    public function add(){
        $victim_id= DAL::query("INSERT INTO victim VALUES (NULL ,'$this->gender','$this->details','$this->name')");
        return $victim_id;
    }
    public function getById(){
        $ret= DAL::query("SELECT * FROM victim WHERE id=$this->id");
        if($row=$ret->fetchobject()){
            $this->gender=$row->gender;
            $this->details=$row->details;
            $this->name=$row->name;
        }
    }

}