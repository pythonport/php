<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/leave.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare teacher object
$leave = new Leave($db);

// set teacher property values
$leave->tid = $_POST['tid'];
$leave->leaveDate = $_POST['leaveDate'];
$leave->leaveDay = $_POST['leaveDay'];
$leave->leaveType = $_POST['leaveType'];
$leave->createdOn = date('Y-m-d H:i:s');

// create the teacher
if($leave->create()){
    $leave_arr=array(
        "status" => true,
        "message" => "Leave data Saved!",
    );
}
else{
    $leave_arr=array(
        "status" => false,
        "message" => "Sorry! Record Already exist.!"
    );
}
print_r(json_encode($leave_arr));
?>