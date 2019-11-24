<?php
session_start();
require_once('Models/Replies/ReplyDataSet.php');

$view = new stdClass();
$replyDataSet = new ReplyDataSet();

$replyFrom = $_GET['replyFrom'];
$replyTo = $_GET['replyTo'];
$postID = $_GET['postID'];
echo $replyFrom. ' ' .$replyTo. ' '.$postID;
echo $_POST['reply'];

if(isset($_POST['reply'])) {
    $replyDataSet->createReply($_POST['reply'], $replyFrom, $replyTo, $postID);
}

require_once('Views/newReply.phtml');
