<?php
//session_start();
require_once('Models/Users/UserDataSet.php');

//$chatToken = "";
//
//if(isset($_SESSION["chat-token"])) {
//    $chatToken = $_SESSION["chat-token"];
//}
//
//if(!isset($_GET["chatToken"]) || $_GET["chatToken"] != $chatToken) {
//
//    $errorData = new stdClass();
//    $errorData->error = "No data available";
//
//    echo json_encode($errorData);
//
//} else {
//
//    $userDataSet = new UserDataSet();
//    $users = $userDataSet->getAllUsers();
//
//    echo json_encode($users);
//}

$userDataSet = new UserDataSet();
$users = $userDataSet->getAllUsers();

echo json_encode($users);