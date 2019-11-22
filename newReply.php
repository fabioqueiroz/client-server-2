<?php
session_start();
require_once('Models/Replies/ReplyDataSet.php');

$view = new stdClass();
$replyDataSet = new ReplyDataSet();


$postID = $_GET['postID'];
$postingUser = $_GET['postingUser'];
echo $postID . ' '.$postingUser;

$replies = $replyDataSet->getAllReplies($postingUser);

require_once('Views/newReply.phtml');
