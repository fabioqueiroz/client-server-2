<?php
session_start();
require_once('Models/Categories/CategoryDataSet.php');
require_once('Models/Topics/TopicDataSet.php');

$view = new stdClass();
$categoryDataSet = new CategoryDataSet();
$topicDataSet = new TopicDataSet();

require_once('Views/index.phtml');


