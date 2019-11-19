<?php
session_start();
require_once('Models/PostDataSet.php');

$view = new stdClass();
$postDataSet = new PostDataSet();

//echo $_POST['title']. ' '. $_POST['topicSubject']. ' '. $_POST['postMessage'];


// test
//require_once('Views/newPost.phtml');
require_once('forum.php');