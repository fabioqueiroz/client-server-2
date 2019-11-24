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

//
//$_SESSION['replyFrom'] = $_GET['replyFrom'];
//$_SESSION['replyTo'] = $_GET['replyTo'];
//$_SESSION['postID'] = $_GET['postID'];
//
//var_dump($_SESSION['postID'] );


if(isset($_POST['reply'])) {
    $replyDataSet->createReply($_POST['reply'], $replyFrom, $replyTo, $postID);
//    $replyDataSet->createReply($_POST['reply'], $_SESSION['replyFrom'], $_SESSION['replyTo'], $_SESSION['postID']);

    echo $_SESSION['replyFrom'] . ' '.$_SESSION['replyTo']. ' '.$_SESSION['postID'];
//    var_dump($_SESSION['postID'] );
//    var_dump($_SESSION);
}

require_once('Views/newReply.phtml');
