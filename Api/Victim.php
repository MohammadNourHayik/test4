<?php
/**
 * Created by PhpStorm.
 * User: Nour
 * Date: 25/12/2017
 * Time: 10:13 م
 */

namespace Api;

use Model\M_victim;

require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_victim.php';

class Victim
{
    public function create($para){
        $v=new M_victim();
        $v->name=$para['victimName'];
        $v->details=$para['victimDetails'];
        $v->gender=$para['victimGender'];
        $v->addToExistCrime($para['incident_id'],$para['criminal_id']);
    }
}