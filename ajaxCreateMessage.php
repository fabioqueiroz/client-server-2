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
    $newInputMessage = htmlentities(trim(($_REQUEST['newChatMessage'])));
    $newChatMessage = $chatMessageDataSet ->sendNewMessage($newInputMessage, $_REQUEST['userID'], $_REQUEST['receiverID']);

    echo json_encode($newChatMessage);
}

//$chatMessageDataSet = new ChatMessageDataSet();
//$newInputMessage = htmlentities(trim(($_REQUEST['newChatMessage'])));
//$newChatMessage = $chatMessageDataSet ->sendNewMessage($newInputMessage, $_REQUEST['userID'], $_REQUEST['receiverID']);
//
//echo json_encode($newChatMessage);