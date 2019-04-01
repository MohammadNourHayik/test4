<?php
namespace route;

use Api\Crime;
use Api\Incident;
use Api\Police_officer;
use Api\Police_station;
use Api\Theft;
use Api\Traffic;
use Api\user;
use Api\Victim;
use Api\Losts;
use Model\M_crime;
use Model\M_criminal;
use Model\M_victim;

include_once "./Api/User.php";
include_once "./Api/Crime.php";
include_once "./Api/Theft.php";
include_once "./Api/Victim.php";
include_once "./Api/Losts.php";
include_once "./Api/Incident.php";
include_once "./Api/Traffic.php";
include_once "./Api/Police_station.php";
include_once "./Api/Police_officer.php";
include_once "./Model/M_criminal.php";
include_once "./Model/M_victim.php";
include_once "./Model/Image_upload.php";

if(!empty($_GET['api'])){
    switch ($_GET['api']){
        case 'create_user': user::create($_GET);
            break;
        case 'login': user::login($_GET);
            break;
        case 'addCrime':Crime::create($_GET);
            break;
        case 'getAllIncidentForAdmin':Incident::getAllIncidentForAdmin($_GET);
            break;


        case 'addPoliceOfficer':Police_officer::add($_GET);
            break;
        case 'addTheft':Theft::create($_GET);
            break;
        case 'addLosts':Losts::create($_GET);
            break;
        case 'addTraffic':Traffic::create($_GET);
            break;


        case 'getAllPoliceStation':Police_station::getAll($_GET);
            break;
        case 'addIncidentToPoliceStation':Incident::addIncidentToPoliceStation($_GET);
            break;
        case 'deletePoliceOfficer':Police_officer::delete($_GET);
            break;
        case 'updatePoliceOfficer':Police_officer::update($_GET);
            break;


        case 'findIncident':Incident::findIncident($_GET);
            break;
        case 'getPoliceOfficersForPoliceStation':Police_station::getPoliceOfficersForPoliceStation($_GET);
            break;
        case 'getPoliceOfficerBySsn':Police_officer::getById($_GET);
            break;
        case 'addPoliceStation':Police_station::add($_GET);
            break;


        case 'addPoliceOfficerToIncident':Incident::addPoliceOfficerToIncident($_GET);
            break;
        case 'AdminRejectIncidentById':Incident::AdminRejectIncidentById($_GET);
            break;
        case 'getAllInfoForIncidentByIncidentId':Incident::getAllInfoForIncidentByIncidentId($_GET);
            break;
        case 'getAllIncidentForPoliceStation':Incident::getAllIncidentForPoliceStation($_GET);
            break;


        case 'FilterIncident':Incident::FilterIncident($_GET);
            break;
        case 'findIncidentForPoliceOffecer':Incident::findIncidentForPoliceOffecer($_GET);
            break;

        case 'UploadPhoto':upload($_POST);
            break;


    }
}
?>