<?php
session_start();
require_once('Models/PostDataSet.php');

$view = new stdClass();
$postDataSet = new PostDataSet();


// test
//require_once('Views/newPost.phtml');
require_once('forum.php');