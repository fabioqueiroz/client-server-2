<?php
session_start();
require_once('Models/Mailbox/MailboxDataSet.php');
require_once('Models/Messages/MessageDataSet.php');

$view = new stdClass();
$mailboxDataSet = new MailboxDataSet();
$messageDataSet = new MessageDataSet();

$inbox = $messageDataSet->getInboxMail($_SESSION['userID']);
var_dump($inbox);

require_once('Views/inbox.phtml');