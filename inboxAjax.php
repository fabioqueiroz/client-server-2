<?php
session_start();
require_once('Models/Mailbox/MailboxDataSet.php');
require_once('Models/Messages/MessageDataSet.php');

$mailboxDataSet = new MailboxDataSet();
$messageDataSet = new MessageDataSet();

$inbox = $messageDataSet->getInboxMail($_SESSION['userID']);

echo json_encode($inbox);