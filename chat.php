<?php
session_start();
require_once('Models/ChatMessages/ChatMessageDataSet.php');
require_once('Models/ChatMessages/ChatMessageDataSet.php');
$chatMessageDataSet = new ChatMessageDataSet();
$myInboxCounter = $chatMessageDataSet->messageCounter($_SESSION['userID']);
require_once('Views/chat.phtml');





