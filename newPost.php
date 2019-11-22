<?php
session_start();
require_once('Models/PostDataSet.php');
require_once('Models/Topics/TopicDataSet.php');


$view = new stdClass();
$postDataSet = new PostDataSet();
$topicDataSet = new TopicDataSet();

$topicID ='';
$topics = $topicDataSet->getAllTopics();
$posts = $postDataSet->getAllPosts();

//var_dump($posts);

if(isset($_POST['title']) && isset($_POST['topicSubject']) && isset($_POST['postMessage']) && $_SESSION['userID'] != null) {
    // get the id from the topic selection
    foreach ($topics as $topic) {
        if($_POST['topicSubject'] == $topic->getTopicSubject()) {
            $topicID = $topic->getTopicID();
        }
    }

    $postDataSet->createPost($_POST['title'], $_POST['postMessage'], $topicID, $_SESSION['userID']);
    $view->isPostCreated = true;

} else {
    $view->errorMessage = true;
}

require_once('Views/newPost.phtml');
//require_once('forum.php');