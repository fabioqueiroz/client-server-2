<?php
session_start();
require_once('Models/ChatMessages/ChatMessageDataSet.php');

$chatToken = "";

if(isset($_SESSION["chat-token"])) {
    $chatToken = $_SESSION["chat-token"];
}

if(!isset($_GET["chatToken"]) || $_GET["chatToken"] != $chatToken) {

    $errorData = new stdClass();
    $errorData->error = "No data available";

    echo json_encode($errorData);

} else {

    $chatMessageDataSet = new ChatMessageDataSet();
    $receivedMessages = $chatMessageDataSet->getMessagesBySenderId($_REQUEST['userID'], $_REQUEST['senderID']);

    echo json_encode($receivedMessages);
}

//$chatMessageDataSet = new ChatMessageDataSet();
//
//$receivedMessages = $chatMessageDataSet->getMessagesBySenderId($_REQUEST['userID'], $_REQUEST['senderID']);
//
//echo json_encode($receivedMessages);

