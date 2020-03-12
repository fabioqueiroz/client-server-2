<?php
require_once('Models/ChatMessages/ChatMessageDataSet.php');

$chatMessageDataSet = new ChatMessageDataSet();
$newChatMessage = $chatMessageDataSet ->sendNewMessage($_REQUEST['newChatMessage'], $_REQUEST['userID'], $_REQUEST['receiverID']);

echo json_encode($newChatMessage);