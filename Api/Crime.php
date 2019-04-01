<?php


namespace Api;

use Model\M_crime;

require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_crime.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/police/Model/M_criminal.php';

class Crime
{
    public static function create($para){
        $crime=new M_crime();
        $crime->locationx=$para['locationx'];
        $crime->locationy=$para['locationy'];
        $crime->location=$para['location'];
        $crime->type=$para['type'];
        $crime->dateTime=$para['dateTime'];
        $crime->user_ssn=$para['userSsn'];
        $crime->criminal->name=$para['criminalName'];
        $crime->criminal->details=$para['criminalDetails'];
        $crime->criminal->gender=$para['criminalGender'];
        $crime->victim->gender=$para['victimGender'];
        $crime->victim->details=$para['victimDetails'];
        $crime->victim->name=$para['victimName'];
        $ret=$crime->add();

        header('Content-type: application/json');
        echo json_encode($ret);



    }
}