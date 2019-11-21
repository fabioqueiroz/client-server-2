<?php
session_start();
require_once ('Models/TopicDataSet.php');
require_once ('Models/PostDataSet.php');
require_once('Models/Replies/ReplyDataSet.php');

$view = new stdClass();
$topicDataSet = new TopicDataSet();
$postDataSet = new PostDataSet();
$replyDataSet = new ReplyDataSet();

$topicID ='';
$topics = $topicDataSet->getAllTopics();
$posts = $postDataSet->getAllPosts();
//var_dump($posts);

$replies = $replyDataSet->getAllReplies();
var_dump($replies);

if(isset($_POST['filter']) && !empty($_POST['filter']) && $_SESSION['userID'] != null) {
   $posts = $postDataSet->filterPostsByTitle($_POST['filter']);
   unset($_POST);
   $view->isFiltered = true;

} else {
    $view->erroMessage = true;
}

require_once('Views/forum.phtml');
