<?php
session_start();
require_once ('Models/TopicDataSet.php');

$view = new stdClass();
$topicDataSet = new TopicDataSet();

$topics = $topicDataSet->getAllTopics();
$topicID = '';

require_once('Views/forum.phtml');
