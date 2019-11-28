<?php
session_start();
require_once('Models/Mailbox/MailboxDataSet.php');
require_once('Models/Messages/MessageDataSet.php');

$view = new stdClass();
$messageDataSet = new MessageDataSet();

$outbox = $messageDataSet->getOutboxMail($_SESSION['userID']);
var_dump($outbox);

require_once('Views/outbox.phtml');