<?php
session_start();
require_once('Models/Categories/CategoryDataSet.php');
require_once('Models/Topics/TopicDataSet.php');

$view = new stdClass();
$categoryDataSet = new CategoryDataSet();
$topicDataSet = new TopicDataSet();

$categories = $categoryDataSet->getAllCategories();
$topics = $topicDataSet->getAllTopics();

require_once('Views/index.phtml');


