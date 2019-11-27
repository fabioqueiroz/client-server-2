<?php
session_start();
require_once('Models/Mailbox/MailboxDataSet.php');
require_once('Models/Messages/MessageDataSet.php');

$view = new stdClass();
$mailboxDataSet = new MailboxDataSet();
$messageDataSet = new MessageDataSet();

$view->isMessageSent = false;
$sentTo = $_GET['postingUser'];

//echo $sentTo;

if(isset($_POST['contact']) && !empty($_POST['contact']) && $_POST['rand-check'] == $_SESSION['rand']) {

    // insert the message in the messages table
    $messageDataSet->createMessage($_POST['contact'], $_SESSION['userID'], $sentTo);

    // get the messageID that was created


    // sent an "out" message for the mailbox ("send from" user)
    $mailboxDataSet->createMailOut($_SESSION['userID'], $_POST['contact'], $sentTo);

    // sent an "out" message for the mailbox ("send to" user)
    $mailboxDataSet->createMailIn($sentTo, $_POST['contact'], $_SESSION['userID']);

    $view->isMessageSent = true;

}

require_once('Views/messages.phtml');