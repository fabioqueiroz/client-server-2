<?php
session_start();
require_once('Models/ChatMessages/ChatMessageDataSet.php');
require_once('Views/chat.phtml');

$chatMessageDataSet = new ChatMessageDataSet();
$receivedMessages = $chatMessageDataSet->getMessagesBySenderId($_REQUEST['userID'], $_REQUEST['senderID']);

echo !empty($receivedMessages) ? "" : json_encode($receivedMessages);

//require_once('Views/chat.phtml');


