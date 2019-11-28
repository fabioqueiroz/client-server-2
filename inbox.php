<?php
session_start();
require_once('Models/Mailbox/MailboxDataSet.php');
require_once('Models/Messages/MessageDataSet.php');

$view = new stdClass();
$mailboxDataSet = new MailboxDataSet();
$messageDataSet = new MessageDataSet();

$inbox = $messageDataSet->getInboxMail($_SESSION['userID']);
//var_dump($inbox);

$ids = $_POST['id'];
//var_dump($ids);

if (isset($_POST['id'])) {
    foreach($ids as $id)
    {
        if(isset($_POST['delete-from-inbox']) && $_POST['delete-rand-check'] == $_SESSION['delete-rand']) {

            $mailboxDataSet->deleteFromMailboxById($id);
            $inbox = $messageDataSet->getInboxMail($_SESSION['userID']);
        }
    }
}

require_once('Views/inbox.phtml');