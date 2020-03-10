<?php
//session_start();
//require_once('Models/Mailbox/MailboxDataSet.php');
require_once('Models/Messages/MessageDataSet.php');

//$mailboxDataSet = new MailboxDataSet();
$messageDataSet = new MessageDataSet();

$data = $messageDataSet->getInboxMail($_REQUEST['userID']);

echo json_encode($data);

?>


