<?php
session_start();
require_once('Models/Replies/ReplyDataSet.php');
require_once ('Models/PostDataSet.php');
require_once ('Models/PostDisplay.php');

$view = new stdClass();
$replyDataSet = new ReplyDataSet();
$postDataSet = new PostDataSet();

$postID = $_GET['postID'];
$postingUser = $_GET['postingUser'];
echo $postID . ' '.$postingUser;
//var_dump($_SESSION);

$post = $postDataSet->getPostById($_GET['postID']);
var_dump($post);

//$replies = $replyDataSet->getAllReplies($_GET['postingUser']);
//var_dump($replies);

$replies = $replyDataSet->getAllRepliesById($_GET['postingUser'], $postID);
var_dump($replies);

//if(isset($_POST['reply'])) {
//    $replyDataSet->createReply($_POST['reply'], $postingUser, 41, $postID);
//}


require_once('Views/postReplies.phtml');