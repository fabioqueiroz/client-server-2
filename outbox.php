<?php
session_start();
require_once('Models/Mailbox/MailboxDataSet.php');
require_once('Models/Messages/MessageDataSet.php');

$view = new stdClass();
$messageDataSet = new MessageDataSet();
$mailboxDataSet = new MailboxDataSet();

$outbox = $messageDataSet->getOutboxMail($_SESSION['userID']);
//var_dump($outbox);

$ids = $_POST['id'];
//var_dump($ids);

if (isset($_POST['id'])) {
    foreach($ids as $id)
    {
        if(isset($_POST['delete-from-inbox']) && $_POST['delete-rand-check'] == $_SESSION['delete-rand']) {

            $mailboxDataSet->deleteFromMailboxById($id);
            $outbox = $messageDataSet->getOutboxMail($_SESSION['userID']);
        }
    }
}
require_once('Views/outbox.phtml');