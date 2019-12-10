<?php
session_start();
require_once('Models/Categories/CategoryDataSet.php');
require_once('Models/Topics/TopicDataSet.php');

$view = new stdClass();
$categoryDataSet = new CategoryDataSet();
$topicDataSet = new TopicDataSet();

// Get all categories
$categories = $categoryDataSet->getAllCategories();

// Get all topics
$topics = $topicDataSet->getAllTopics();

require_once('Views/index.phtml');


