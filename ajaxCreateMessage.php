<?php
require_once('Models/ChatMessages/ChatMessageDataSet.php');

$chatMessageDataSet = new ChatMessageDataSet();
$newInputMessage = htmlentities(trim(($_REQUEST['newChatMessage'])));
$newChatMessage = $chatMessageDataSet ->sendNewMessage($newInputMessage, $_REQUEST['userID'], $_REQUEST['receiverID']);

echo json_encode($newChatMessage);