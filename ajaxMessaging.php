<?php
require_once('Models/ChatMessages/ChatMessageDataSet.php');
//require_once('Models/Users/UserDataSet.php');

//$userDataSet = new UserDataSet();
$chatMessageDataSet = new ChatMessageDataSet();

$receivedMessages = $chatMessageDataSet->getReceivedMessages($_REQUEST['userID']);

echo json_encode($receivedMessages);