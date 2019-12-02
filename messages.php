<?php
session_start();
require_once('Models/Mailbox/MailboxDataSet.php');
require_once('Models/Messages/MessageDataSet.php');

$view = new stdClass();
$mailboxDataSet = new MailboxDataSet();
$messageDataSet = new MessageDataSet();

$view->isMessageSent = false;
$view->wrongLenght = false;
$sentTo = $_GET['postingUser'];

//echo $sentTo;

if(isset($_POST['contact']) && !empty($_POST['contact']) && $_POST['rand-check'] == $_SESSION['rand']) {

    if(strlen($_POST['contact']) > 0 && strlen($_POST['contact']) <= 300) {
        // insert the message in the messages table
        $messageDataSet->createMessage(htmlentities(trim(($_POST['contact']))), $_SESSION['userID'], $sentTo);

        // sent an "out" message to the mailbox ("send from" user)
        $mailboxDataSet->createMailOut($_SESSION['userID'], htmlentities(trim(($_POST['contact']))), $sentTo);

        // sent an "in" message to the mailbox ("send to" user)
        $mailboxDataSet->createMailIn($sentTo, htmlentities(trim(($_POST['contact']))), $_SESSION['userID']);

        $view->isMessageSent = true;
    }
    else {
        $view->wrongLenght = true;
    }

}

require_once('Views/messages.phtml');