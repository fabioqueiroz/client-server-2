<?php
session_start();
require_once('Models/Mailbox/MailboxDataSet.php');
require_once('Models/Messages/MessageDataSet.php');

$view = new stdClass();
$mailboxDataSet = new MailboxDataSet();
$messageDataSet = new MessageDataSet();

// Get all the mail in the inbox
$inbox = $messageDataSet->getInboxMail($_SESSION['userID']);

// Get the id of the post selected in the checkbox
$ids = $_POST['id'];

// Allow the user to remove a message from the inbox
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