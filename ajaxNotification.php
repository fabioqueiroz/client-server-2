<?php
require_once('Models/ChatMessages/ChatMessageDataSet.php');
$chatMessageDataSet = new ChatMessageDataSet();
$inboxCounter = $chatMessageDataSet->messageCounter($_REQUEST['userID']);
echo json_encode($inboxCounter);