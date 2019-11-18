<?php
session_start();
require_once ('Models/TopicDataSet.php');

$view = new stdClass();
$topicDataSet = new TopicDataSet();
$postingUser = $_SESSION['userID'];


if(isset($_POST['subject']) && isset($_POST['category']) && isset($_POST['description'])) {
    $categoryID = $topicDataSet->getCategoryID($_POST['category']);
    $result = $topicDataSet->createTopic($_POST['subject'], $categoryID, $postingUser, $_POST['description']);

    $view->isTopicCreated = true;
}

// uncomment to stop using modal
require_once('Views/newTopic.phtml');

// comment out if not using modal
//require_once('forum.php');