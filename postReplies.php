<?php
session_start();
require_once('Models/Replies/ReplyDataSet.php');
require_once ('Models/PostDataSet.php');

$view = new stdClass();
$replyDataSet = new ReplyDataSet();
$postDataSet = new PostDataSet();

$postID = $_GET['postID'];
$postingUser = $_GET['postingUser'];
echo $postID . ' '.$postingUser;

$post = $postDataSet->getPostById($postID);
var_dump($post);

$replies = $replyDataSet->getAllReplies($postingUser);

require_once('Views/postReplies.phtml');