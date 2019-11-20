<?php
session_start();
require_once ('Models/TopicDataSet.php');
require_once ('Models/PostDataSet.php');

$view = new stdClass();
$topicDataSet = new TopicDataSet();
$postDataSet = new PostDataSet();

$topicID ='';
$topics = $topicDataSet->getAllTopics();
$posts = $postDataSet->getAllPosts();
////var_dump($posts);

if(isset($_POST['filter']) && !empty($_POST['filter']) && $_SESSION['userID'] != null) {
   $posts = $postDataSet->filterPostsByTitle($_POST['filter']);
   unset($_POST);

} else {
    $view->erroMessage = true;
}

require_once('Views/forum.phtml');
