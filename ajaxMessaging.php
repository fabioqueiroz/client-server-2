<?php
require_once('Models/ChatMessages/ChatMessageDataSet.php');
//require_once('Models/Users/UserDataSet.php');

//$userDataSet = new UserDataSet();
$chatMessageDataSet = new ChatMessageDataSet();

//$receivedMessages = $chatMessageDataSet->getReceivedMessages($_REQUEST['userID']);

// getMessagesBySenderId
$receivedMessages = $chatMessageDataSet->getMessagesBySenderId($_REQUEST['userID'], $_REQUEST['senderID']);

//$receivedMessages = $chatMessageDataSet->getMessagesBySenderId($_REQUEST['userID'], $_REQUEST['senderID'], $_REQUEST['senderID'], $_REQUEST['userID']);

echo json_encode($receivedMessages);