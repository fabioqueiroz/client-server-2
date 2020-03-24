<?php
require_once('Models/ChatMessages/ChatMessageDataSet.php');

$chatMessageDataSet = new ChatMessageDataSet();
$lastMessage = $chatMessageDataSet->getLastReceivedMessage($_REQUEST['userID']);

echo json_encode($lastMessage);