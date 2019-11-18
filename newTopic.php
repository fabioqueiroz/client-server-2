<?php
session_start();
require_once ('Models/TopicDataSet.php');

$view = new stdClass();
$topicDataSet = new TopicDataSet();
$postingUser = $_SESSION['userID'];

if(isset($_POST['subject']) && isset($_POST['category']) && isset($_POST['description'])) {
    $result = $topicDataSet->createTopic($_POST['subject'], $_POST['category'], $postingUser, $_POST['description']);
}


require_once('Views/newTopic.phtml');

// using modal
//require_once('forum.php');