<?PHP
use Model\DAL;
require_once 'DAL.php';

function upload($para){
    $image=$para['image'];
    $incidentId=$para['incidentId'];

    //create unique image file name based on micro time and date
    $now = DateTime::createFromFormat('U.u', microtime(true));
    $id = $now->format('YmdHisu');

    $upload_folder = "upload"; //DO NOT put url (http://example.com/upload)
    $path = "$upload_folder/$id.jpg";

    //Cannot use "== true"
    if(file_put_contents($path, base64_decode($image)) != false){
        echo "uploaded success";
        $id=$id.".jpg";
        DAL::query("INSERT INTO photo VALUES (NULL ,'$id',$incidentId )");
    }
    else{
        echo "uploaded failed";
    }
}
function getPhotoForIncidentById($id){
    $ret=DAL::query("SELECT photo FROM photo WHERE incident_id=$id");
    return $ret;
}

?>