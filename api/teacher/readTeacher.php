<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/teacher.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare teacher object
$teacher = new Teacher($db);
 
// query teacher
$stmt = $teacher->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // doctors array
    $teachers_arr=array();
    $teachers_arr["teachers"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $teacher_item=array(
            "tid" => $tid,
            "tname" => $tname,
            "designation" => $designation
        );
        array_push($teachers_arr["teachers"], $teacher_item);
    }
 
    echo json_encode($teachers_arr["teachers"]);
}
else{
    echo json_encode(array());
}
?>