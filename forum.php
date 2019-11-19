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


if(isset($_POST['title']) && isset($_POST['topicSubject']) && isset($_POST['postMessage']) && $_SESSION['userID'] != null) {
    // get the id from the topic selection
    foreach ($topics as $topic) {
        if($_POST['topicSubject'] == $topic->getTopicSubject()) {
            $topicID = $topic->getTopicID();
        }
    }
    $postDataSet->createPost($_POST['title'], $_POST['postMessage'], $topicID, $_SESSION['userID']);

} else {
    $view->erroMessage = true;
}

require_once('Views/forum.phtml');
