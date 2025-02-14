<?php
session_start();
require_once('Models/Posts/PostDataSet.php');
require_once('Models/Topics/TopicDataSet.php');

$view = new stdClass();
$postDataSet = new PostDataSet();
$topicDataSet = new TopicDataSet();

$topicID ='';

// Get all topics
$topics = $topicDataSet->getAllTopics();

// Get all posts
$posts = $postDataSet->getAllPosts();

if(isset($_POST['title']) && isset($_POST['topicSubject']) && isset($_POST['postMessage']) && $_SESSION['userID'] != null) {
    // Get the id from the topic selection
    foreach ($topics as $topic) {
        if($_POST['topicSubject'] == $topic->getTopicSubject()) {
            $topicID = $topic->getTopicID();
        }
    }

    if(strlen($_POST['postMessage']) > 0 && strlen($_POST['postMessage']) <= 300){
        // Prevent the submission of the same values if the page is reloaded
        if(isset($_POST['postMessage']) && $_POST['rand-check'] == $_SESSION['rand']) {
            $postDataSet->createPost(strip_tags(trim(($_POST['title']))), htmlentities(trim(($_POST['postMessage']))), $topicID, $_SESSION['userID']);
            $view->isPostCreated = true;
        }
    }

    else {
        $view->errorMessage = true;
    }
}

require_once('Views/newPost.phtml');